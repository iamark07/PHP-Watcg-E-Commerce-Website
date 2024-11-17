<?php
include "../config.php";

// Retrieve and sanitize input data
$watch_id = (int)$_POST["watch_id"];
$all_watch_id = (int)$_POST["all_watch_id"];
$watch_cat = (int)$_POST["watch_cat"];
$watch_name = mysqli_real_escape_string($conn, $_POST["watch_name"]);
$watch_desc = mysqli_real_escape_string($conn, $_POST["watch_desc"]);
$watch_amount = (float)$_POST["watch_amount"];
// $target_audience = (int)$_POST["select_target_audience"];
$brand = (int)$_POST["select_brand"];
$original_brand = (int)$_POST["original_brand"];
$original_target_audience = (int)$_POST["original_target_audience"];
$original_category = (int)$_POST["original_category"];
$category = (int)$_POST["select_watch"];

// Fetch img_folder_name and current image extension from both watches and all_watches tables
$folder_query = "SELECT img_folder_name, watch_img FROM kids_watches WHERE watch_id = $watch_id
                UNION ALL
                SELECT img_folder_name, watch_img 
                FROM all_watches 
                WHERE save_watch_id = $all_watch_id AND target_audience = {$watch_cat}";

$folder_result = mysqli_query($conn, $folder_query);
$folder_row = mysqli_fetch_assoc($folder_result);
$img_folder_name = $folder_row['img_folder_name'];
$current_watch_img = $folder_row['watch_img'];

// Set default file extension to the existing one
$file_ext = pathinfo($current_watch_img, PATHINFO_EXTENSION) ?: 'jpg'; // default to 'jpg' if no extension

// Image upload handling
$upload_dir = "../upload_img/" . $img_folder_name . "/";
$file_name = "watch-1"; // Name the file as 'watch-1'

// Create the upload directory if it doesn't exist
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// Check if the watch title has changed
$new_folder_name = strtolower(str_replace(' ', '-', $watch_name)); // Create a new folder name based on the watch name

if ($new_folder_name !== $img_folder_name) {
    // Rename the directory if the folder name has changed
    $new_upload_dir = "../upload_img/" . $new_folder_name . "/";

    // Rename the old folder to the new folder name
    rename($upload_dir, $new_upload_dir);
    $upload_dir = $new_upload_dir; // Update the upload directory path to the new one
    $img_folder_name = $new_folder_name; // Update the folder name variable
}

if (!empty($_FILES['new_watch_img']['name'])) {
    $errors = array();
    $file_ext = strtolower(pathinfo($_FILES['new_watch_img']['name'], PATHINFO_EXTENSION));
    $allowed_extensions = array("jpeg", "jpg", "png");

    if (!in_array($file_ext, $allowed_extensions)) {
        $errors[] = "This extension file is not allowed. Please choose a jpg or png image.";
    }

    if ($_FILES['new_watch_img']['size'] > 4194304) {
        $errors[] = "File size must be 4MB or lower.";
    }

    if (empty($errors)) {
        $new_file_path = $upload_dir . $file_name . '.' . $file_ext;

        // Delete the old watch-1 image if it exists
        foreach (glob($upload_dir . "watch-1.*") as $old_image_path) {
            unlink($old_image_path);
        }

        // Move the uploaded file as 'watch-1'
        move_uploaded_file($_FILES['new_watch_img']['tmp_name'], $new_file_path);
    } else {
        print_r($errors);
        die();
    }
}

// Construct the full filename with extension
$full_image_name = $file_name . '.' . $file_ext;

// Update the watch details in the watches table
$sql = "UPDATE kids_watches SET 
            watch_title = '$watch_name', 
            watch_description = '$watch_desc', 
            watch_brand_name = $brand,
            watch_amount = $watch_amount, 
            watch_img = '$full_image_name', 
            img_folder_name = '$img_folder_name' 
        WHERE watch_id = $watch_id;";

// Update the watch details in the all_watches table
$sql .= " UPDATE all_watches SET  
            watch_title = '$watch_name', 
            watch_description = '$watch_desc', 
            watch_brand_name = $brand,
            watch_amount = $watch_amount, 
            watch_img = '$full_image_name',
            img_folder_name = '$img_folder_name',
            source_table = 'kids_watches',
            all_brand_id = 1
        WHERE save_watch_id = $all_watch_id AND target_audience = {$watch_cat};";

// Check if brand has changed
if ($brand !== $original_brand) {
    $sql .= " UPDATE watch_brand SET count_brand_watch = count_brand_watch + 1 WHERE brand_id = $brand;";
    $sql .= " UPDATE watch_brand SET count_brand_watch = count_brand_watch - 1 WHERE brand_id = $original_brand;";
}
// Check if audience has changed
// if ($target_audience !== $original_target_audience) {
//     $sql .= " UPDATE watch_target_audience SET count_target_audience = count_target_audience + 1 WHERE target_audience_id = $target_audience;";
//     $sql .= " UPDATE watch_target_audience SET count_target_audience = count_target_audience - 1 WHERE target_audience_id = $original_target_audience;";
// }
// Check if category has changed
// if ($category !== $original_category) {
//     $sql .= " UPDATE category SET count_category_items = count_category_items + 1 WHERE category_id = $category;";
//     $sql .= " UPDATE category SET count_category_items = count_category_items - 1 WHERE category_id = $original_category;";
// }

// Execute the queries
if (mysqli_multi_query($conn, $sql)) {
    header("Location: $hostname/admin/kids_watches/watches.php");
} else {
    echo "Query failed: " . mysqli_error($conn);
}
?>
