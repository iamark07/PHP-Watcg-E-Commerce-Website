<?php
include "../config.php";

if (isset($_FILES['watch_img'])) {
    $errors = array();

    $file_name = $_FILES['watch_img']['name'];
    $file_size = $_FILES['watch_img']['size'];
    $file_tmp = $_FILES['watch_img']['tmp_name'];
    $file_type = $_FILES['watch_img']['type'];

    // Fixing the explode() and end() issue
    $temp = explode('.', $file_name);
    $file_ext = strtolower(end($temp)); // Ensure the extension is lowercase

    $extension = array("jpeg", "jpg", "png");

    // Validate file extension
    if (!in_array($file_ext, $extension)) {
        $errors[] = "This extension file is not allowed, please choose a jpg or png image file.";
    }

    // Validate file size
    if ($file_size > 4194304) {
        $errors[] = "File size must be 4MB or lower.";
    }

    if (empty($errors)) {
        // Check if file with the same name already exists
        $upload_dir = "../upload_img/";

        // Get the title and replace spaces with hyphens
        $title = mysqli_real_escape_string($conn, $_POST['watch_name']);
        $clean_title = str_replace(" ", "-", $title); // Replace spaces with hyphens

        // Create a folder path based on the title
        $folder_path = $upload_dir . $clean_title;

        // Check if folder already exists
        if (is_dir($folder_path)) {
            $errors[] = "A folder for this watch already exists. Please choose a different watch name.";
        } else {
            // Create the directory with 0777 permissions
            mkdir($folder_path, 0777, true);

            // Rename the file to "watch-1"
            $new_file_name = "watch-1." . $file_ext;

            // Move the file into the folder
            if (!move_uploaded_file($file_tmp, $folder_path . '/' . $new_file_name)) {
                $errors[] = "Failed to move uploaded file.";
            }
        }
    }

    // Handle errors if any
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo '<div style="color:red;">' . $error . '</div>';
        }
        die(); // Stop execution if there are errors
    }
}

// Start the session
session_start();

// Prepare data for SQL insertion
$description = mysqli_real_escape_string($conn, $_POST['watch_desc']);
$brand = mysqli_real_escape_string($conn, $_POST['select_brand']);
$target_audience = mysqli_real_escape_string($conn, $_POST['select_target_audience']);
$category = mysqli_real_escape_string($conn, $_POST['select_category']);
$date = date("Y-m-d"); // Use Y-m-d for consistency in database
$amount = mysqli_real_escape_string($conn, $_POST['watch_amount']);
$author = $_SESSION['user_id'];

// Use the folder path and new file name in the SQL query
$sql = "INSERT INTO wall_watches (watch_title, watch_description, watch_brand_name, category, watch_date, Author, watch_img, watch_amount, img_folder_name)
        VALUES ('{$title}', '{$description}', {$brand}, {$category}, '{$date}', {$author}, '{$new_file_name}', '{$amount}', '{$clean_title}');";

// Execute the main insert query for wall_watches
if (mysqli_query($conn, $sql)) {
    $watch_id = mysqli_insert_id($conn); // Get the ID of the inserted watch

    // Combine the insert into all_watches and the update queries into one statement
    $source_table = 'wall_clock'; // Example for wall watches. Adjust based on the actual source.
    $all_brand_id = 2;
    $sql_all_watches = "
    INSERT INTO all_watches (save_watch_id, source_table, watch_title, watch_description, watch_brand_name, target_audience, category, watch_date, Author, watch_img, watch_amount, img_folder_name, all_brand_id)
    VALUES ({$watch_id}, '{$source_table}', '{$title}', '{$description}', {$brand}, '{$target_audience}', {$category}, '{$date}', {$author}, '{$new_file_name}', '{$amount}', '{$clean_title}' ,{$all_brand_id});
        UPDATE category SET count_category_items = count_category_items + 1 WHERE category_id = {$category};
        UPDATE clock_brand SET count_brand_watch = count_brand_watch + 1 WHERE brand_id = {$brand};
        UPDATE watch_target_audience SET count_target_audience = count_target_audience + 1 WHERE target_audience_id = {$target_audience};
    ";

    // Execute the combined queries
    if (mysqli_multi_query($conn, $sql_all_watches)) {
        // If everything is successful, redirect to watches.php
        header("Location: {$hostname}/admin/wall_watches/watches.php");
        exit; // Make sure to exit after redirection
    } else {
        echo '<div class="text-red-500">Query for all_watches or updates Failed</div>';
    }
} else {
    echo '<div class="text-red-500">Query for watches Failed</div>';
}

// Close the database connection
mysqli_close($conn);
