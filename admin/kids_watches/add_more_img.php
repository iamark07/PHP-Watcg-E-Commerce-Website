<?php
session_start();
if ($_SESSION["user_role"] == 0) {
    header("Location: {$hostname}/");
}
include "../secure_page.php";
include "../config.php";

// Retrieve watch ID from the URL
$watch_id = $_GET['id'];
$file_upload_success = "";
$file_upload_error = ""; // Variable for error messages

// Fetch the folder name for the specific watch ID from the database
$sql = "SELECT img_folder_name FROM kids_watches WHERE watch_id = {$watch_id}";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$folder_name = $row['img_folder_name'];

// Define the path to the folder where images are saved
$target_directory = "../upload_img/" . $folder_name;

// Ensure the directory exists, if not, create it
if (!is_dir($target_directory)) {
    mkdir($target_directory, 0777, true);
}

// Check how many images already exist in the folder
$files = glob($target_directory . "/watch-*.{jpg,jpeg,png,gif}", GLOB_BRACE);
$next_image_number = count($files) + 1; // Get the next available image number

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['watch_img']) && $_FILES['watch_img']['error'] == 0) {
        $imageFileType = strtolower(pathinfo($_FILES['watch_img']['name'], PATHINFO_EXTENSION));
        $new_image_name = "watch-{$next_image_number}." . $imageFileType;
        $target_file = $target_directory . "/" . $new_image_name;

        // Check if the file is a valid image
        $check = getimagesize($_FILES['watch_img']['tmp_name']);
        if ($check !== false) {
            // Check if an image with the same name already exists
            if (file_exists($target_directory . "/watch-" . $next_image_number . "." . $imageFileType)) {
                $file_upload_error = "<p class='text-red-500'>Image name <strong>" . htmlspecialchars($new_image_name) . "</strong> already exists.</p>";
            } else {
                // Move the uploaded file to the target directory
                if (move_uploaded_file($_FILES['watch_img']['tmp_name'], $target_file)) {
                    // Success: File has been uploaded
                    $file_upload_success = "<p class='text-green-500 text-center'>The file has been uploaded as " . htmlspecialchars($new_image_name) . "</p>";
                } else {
                    echo "<p class='text-red-500'>Sorry, there was an error uploading your file.</p>";
                }
            }
        } else {
            echo "<p class='text-red-500'>File is not an image.</p>";
        }
    } else {
        echo "<p class='text-red-500'>No file was uploaded or there was an upload error.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Add Watch Images</title>
</head>
<body>
    <header class="bg-white relative z-40 !border-gray-300 border-solid border-b">
        <div class="main_header flex justify-between items-center ps-3 pe-5 md:px-5 py-2 md:!py-5 lg:px-5 lg:py-5 md:relative">
            <nav class="hidden lg:block">
                <ul class="animate_text_color flex gap-5">
                    <li class="text-black"><a href="../../index.php">Home</a></li>
                    <?php if ($_SESSION["user_role"] == 1) { ?>
                        <li class="text-black"><a href="../wall_watches/watches.php">Wall Clock</a></li>
                        <li class="text-black"><a href="watches.php">Men</a></li>
                        <li class="text-black"><a href="../women_watches/watches.php">Women</a></li>
                        <li class="text-blue-500"><a href="../kids_watches/watches.php">Kids</a></li>
                        <li class="text-black"><a href="../users/users.php">Users</a></li>
                        <li class="text-black"><a href="../category/category.php">Category</a></li>
                        <li class="text-black"><a href="../brand/brand.php">Watch Brand</a></li>
                        <li class="text-black"><a href="../clock_brand/brand.php">Wall Clock Brand</a></li>
                    <?php } ?>
                </ul>
            </nav>
            <nav class="lg:hidden w-full">
                <div class="menu_wrapper flex menu_slider fixed top-0 -left-full w-full transition-all duration-300 -z-10">
                    <ul class="animate_text_color flex flex-col gap-5 w-1/2 pt-20 pb-5 px-3 bg-zinc-100 h-[100dvh] ">
                        <li class="text-black"><a href="../../index.php">Home</a></li>
                        <?php
                        if ($_SESSION["user_role"] == 1) {
                        ?>
                            <li class="text-black"><a href="../wall_watches/watches.php">Wall Clock</a></li>
                            <li class="text-black"><a href="../watches/watches.php">Men</a></li>
                            <li class="text-black"><a href="../women_watches/watches.php">Women</a></li>
                            <li class="text-blue-500"><a href="watches.php">Kids</a></li>
                            <li class="text-black"><a href="../users/users.php">Users</a></li>
                            <li class="text-black"><a href="../category/category.php">Category</a></li>
                            <li class="text-black"><a href="../brand/brand.php">Watch Brand</a></li>
                            <li class="text-black"><a href="../clock_brand/brand.php">Wall Clock Brand</a></li>
                        <?php
                        }
                        ?>
                        <li class="text-black cursor-pointer"><a href="../logout.php">Log out</a></li>
                    </ul>
                    <span class="inline-block w-1/2 h-[100dvh] close_menu_side_bar" onclick="close_menu_bar()"></span>
                </div>
            </nav>
            <div class="menu_icon w-full flex justify-end lg:hidden">
                <i class="open_menu ri-menu-fold-2-line text-3xl p-1 cursor-pointer" id="open_menu_btn"></i>
            </div>
            <div class="user_section hidden lg:block">
                <ul class="animate_text_color flex gap-5">
                    <li class="text-black cursor-pointer"><a href="../logout.php">Log out</a></li>
                </ul>
            </div>
        </div>
    </header>
    <main class="flex justify-center items-center flex-col bg-zinc-100 p-5 md:px-20">
        <h2 class="mt-5 text-blue-400 text-2xl text-start">Add Watch Images</h2>
        <form action="" method="POST" enctype="multipart/form-data" class="w-full md:w-1/2 grid grid-cols-1 gap-5 mt-5 py-10 px-5 md:px-10 bg-white">
            <input type="file" name="watch_img" class="col-span-1 px-5 py-3 border border-zinc-500 text-zinc-500 rounded outline-none" required>

            <input type="submit" value="Add" name="add" class="col-span-1 px-5 py-3 bg-blue-400 text-white rounded">
            <?php 
                echo $file_upload_success;
                echo $file_upload_error; // Display error messages if any
            ?>
        </form>
    </main>
    <script src="../assets/js/menu_feature.js"></script>
</body>
</html>
