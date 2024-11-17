<?php
include "../config.php";

$watch_id = $_GET['id'];
$all_watch_id = $_GET['all_watch_id'];
$watch_cat = $_GET['watch_cat'];
$cat_id = $_GET['catid'];
$brand_id = $_GET['brand_id'];
$target_audience_id = $_GET['target_audience_id'];

// Fetch watch details to get the folder name
$sql1 = "SELECT * FROM wall_watches WHERE watch_id = {$watch_id};";
$result = mysqli_query($conn, $sql1);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "<p class='text-red-500 text-md text-center'>Watch not found.</p>";
    exit;
}

// Define the folder path
$folder_path = "../upload_img/" . $row["img_folder_name"];

// Function to delete directory and contents
function deleteDirectory($dir) {
    if (!is_dir($dir)) return false;
    $files = array_diff(scandir($dir), ['.', '..']);
    foreach ($files as $file) {
        $path = "$dir/$file";
        is_dir($path) ? deleteDirectory($path) : unlink($path);
    }
    return rmdir($dir);
}

// Delete the folder and its contents
if (deleteDirectory($folder_path)) {
    // Delete from wall_watches and all_watches tables
    $sql_delete_watches = "DELETE FROM wall_watches WHERE watch_id = {$watch_id}";
    $sql_delete_all_watches = "DELETE FROM all_watches WHERE save_watch_id = {$all_watch_id} AND target_audience = {$watch_cat}";

    if (mysqli_query($conn, $sql_delete_watches) && mysqli_query($conn, $sql_delete_all_watches)) {
        
        // Update category count
        $sql_update_category = "UPDATE category SET count_category_items = count_category_items - 1 WHERE category_id = {$cat_id}";
        if (!mysqli_query($conn, $sql_update_category)) {
            echo "Category update error: " . mysqli_error($conn);
        }

        // Update brand count
        $sql_update_brand = "UPDATE clock_brand SET count_brand_watch = count_brand_watch - 1 WHERE brand_id = {$brand_id}";
        if (!mysqli_query($conn, $sql_update_brand)) {
            echo "Brand update error: " . mysqli_error($conn);
        }

        // Update target audience count
        $sql_update_target_audience = "UPDATE watch_target_audience SET count_target_audience = count_target_audience - 1 WHERE target_audience_id = {$target_audience_id}";
        if (!mysqli_query($conn, $sql_update_target_audience)) {
            echo "Target audience update error: " . mysqli_error($conn);
        }

        // Redirect on success
        header("Location: $hostname/admin/wall_watches/watches.php");

    } else {
        echo "<p class='text-red-500 text-md text-center'>Watch delete failed: " . mysqli_error($conn) . "</p>";
    }

} else {
    echo "<p class='text-red-500 text-md text-center'>Failed to delete the folder.</p>";
}

mysqli_close($conn);
?>
