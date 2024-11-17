<?php
session_start();
if ($_SESSION["user_role"] == 0) {
    header("Location: {$hostname}/");
}
include "../secure_page.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- rimix icon -->
    <link
        href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"
        rel="stylesheet" />
    <!-- tailwind css -->
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Edit Watch</title>
</head>

<body>
    <header class="bg-white relative z-40  !border-gray-300 border-solid border-b">
        <div class="main_header flex justify-between items-center ps-3 pe-5 md:px-5 py-2 md:!py-5 lg:px-5  lg:py-5 md:relative">
            <nav class="hidden lg:block">
                <ul class="animate_text_color flex gap-5">
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
        <h2 class="mt-5 text-blue-400 text-2xl text-start">Edit Watch</h2>
        <?php
        if (isset($_GET['id']) && isset($_GET['watch_cat'])) {
            $watches_id = $_GET['id'];
            $watch_cat = $_GET['watch_cat'];
        }
        include "../config.php";

        $sql = "SELECT kids_watches.watch_id, kids_watches.watch_title, kids_watches.watch_description, kids_watches.category AS watches_category, kids_watches.watch_img, kids_watches.watch_brand_name, kids_watches.watch_amount, kids_watches.img_folder_name, all_watches.save_watch_id, all_watches.target_audience, all_watches.category AS all_category, watch_target_audience.target_audience_name,  category.category_id, category.category_product_name, 
        user.username FROM kids_watches
        LEFT JOIN all_watches ON all_watches.save_watch_id = kids_watches.watch_id
        LEFT JOIN watch_target_audience ON watch_target_audience.target_audience_id = all_watches.all_watch_id
        LEFT JOIN category ON kids_watches.category = category.category_id
        LEFT JOIN watch_brand ON kids_watches.watch_brand_name = watch_brand.brand_id
        LEFT JOIN user ON kids_watches.Author = user.user_id
        WHERE kids_watches.watch_id = {$watches_id} AND target_audience = {$watch_cat}";

        $result = mysqli_query($conn, $sql) or die("Query failed.");

        // Check if the user exists
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <form id="edit-watch-form" action="save-edit-watch.php" method="POST" enctype="multipart/form-data" class="w-full md:w-1/2 grid grid-cols-1 gap-5 mt-5 py-10 px-5 md:px-10 bg-white" onsubmit="return validateForm()">
                    <input type="hidden" name="watch_id" value="<?php echo $row['watch_id']; ?>">
                    <input type="hidden" name="all_watch_id" value="<?php echo $row['save_watch_id']; ?>">
                    <input type="hidden" name="watch_cat" value="<?php echo $row['target_audience']; ?>">

                    <input type="text" name="watch_name" value="<?php echo $row['watch_title']; ?>" placeholder="Watch Name" class="col-span-1 px-5 py-3 border border-zinc-500 text-zinc-500 rounded outline-none">
                    <div id="watch_name_error" class="text-red-500"></div>

                    <textarea name="watch_desc" placeholder="Watch Description" class="col-span-1 px-5 py-3 border border-zinc-500 text-zinc-500 rounded outline-none h-32"><?php echo $row['watch_description']; ?></textarea>
                    <div id="watch_desc_error" class="text-red-500"></div>

                    <select name="select_brand" class="col-span-1 px-5 py-3 border border-zinc-500 text-zinc-500 rounded outline-none">
                        <option value="Select Brand">Select Brand</option>
                        <?php
                        include "../config.php";
                        $sql1 = "SELECT * FROM watch_brand";
                        $result1 = mysqli_query($conn, $sql1) or die("query failed.");
                        if (mysqli_num_rows($result1) > 0) {
                            while ($row1 = mysqli_fetch_assoc($result1)) {
                                $selected = ($row["watch_brand_name"] == $row1['brand_id']) ? "selected" : "";
                                echo "<option {$selected} value='{$row1['brand_id']}'>{$row1['watch_brand_name']}</option>";
                            }
                        }
                        ?>
                    </select>
                    <input type="hidden" name="original_brand" value="<?php echo $row['watch_brand_name']; ?>">
                    <div id="select_brand_error" class="text-red-500"></div>

                    <!-- <select name="select_target_audience" class="col-span-1 px-5 py-3 border border-zinc-500 text-zinc-500 rounded outline-none">
                        <option value="For">For</option>
                        <?php
                        include "../config.php";
                        $sql1 = "SELECT * FROM watch_target_audience";
                        $result1 = mysqli_query($conn, $sql1) or die("query failed.");
                        if (mysqli_num_rows($result1) > 0) {
                            while ($row1 = mysqli_fetch_assoc($result1)) {
                                $selected = ($row["target_audience"] == $row1['target_audience_id']) ? "selected" : "";
                                echo "<option {$selected} value='{$row1['target_audience_id']}'>{$row1['target_audience_name']}</option>";
                            }
                        }
                        ?>
                    </select>
                    <div id="select_target_audience_error" class="text-red-500"></div> -->

                    <!-- <select name="select_watch" class="col-span-1 px-5 py-3 border border-zinc-500 text-zinc-500 rounded outline-none">
                        <?php
                        include "../config.php";
                        $sql1 = "SELECT * FROM category";
                        $result1 = mysqli_query($conn, $sql1) or die("query failed.");
                        if (mysqli_num_rows($result1) > 0) {
                            while ($row1 = mysqli_fetch_assoc($result1)) {
                                $selected = ($row["watches_category"] == $row1['category_id']) ? "selected" : "";
                                echo "<option {$selected} value='{$row1['category_id']}'>{$row1['category_product_name']}</option>";
                            }
                        }
                        ?>
                    </select>
                    <div id="select_category_error" class="text-red-500"></div> -->

                    <input type="text" name="watch_amount" value="<?php echo $row['watch_amount']; ?>" placeholder="Enter Amount" class="col-span-1 px-5 py-3 border border-zinc-500 text-zinc-500 rounded outline-none">
                    <div id="watch_amount_error" class="text-red-500"></div>

                    <div class="flex gap-5">
                        <img src="../upload_img/<?php echo $row['img_folder_name']; ?>/<?php echo $row['watch_img']; ?>" alt="Watch Image" class="w-20">
                        <p class="text-sm h-full flex items-end"><?php echo $row['watch_img']; ?></p>
                    </div>
                    <input type="file" name="new_watch_img" class="col-span-1 px-5 py-3 border border-zinc-500 text-zinc-500 rounded outline-none">
                    <div id="watch_img_error" class="text-red-500"></div>

                    <input type="hidden" name="old_watch_img" value="<?php echo $row['watch_img']; ?>">
                    <input type="hidden" name="edit" value="submitted">
                    <input type="submit" value="Edit" class="col-span-1 px-5 py-3 bg-blue-400 text-white rounded">
                </form>

        <?php
            }
        } else {
            echo "result not found";
        }
        ?>
    </main>

    <script>
        function validateForm() {
            // Clear previous error messages
            document.getElementById('watch_name_error').innerText = '';
            document.getElementById('watch_desc_error').innerText = '';
            document.getElementById('select_brand_error').innerText = '';
            document.getElementById('select_target_audience_error').innerText = '';
            document.getElementById('select_category_error').innerText = '';
            document.getElementById('watch_amount_error').innerText = '';
            document.getElementById('watch_img_error').innerText = '';

            // Get form field values
            const watchName = document.forms['edit-watch-form'].watch_name.value.trim();
            const watchDesc = document.forms['edit-watch-form'].watch_desc.value.trim();
            const brand = document.forms['edit-watch-form'].select_brand.value;
            const targetAudience = document.forms['edit-watch-form'].select_target_audience.value;
            const category = document.forms['edit-watch-form'].select_watch.value;
            const watchAmount = document.forms['edit-watch-form'].watch_amount.value.trim();
            const newWatchImg = document.forms['edit-watch-form'].new_watch_img.value;

            let valid = true; // Flag to track overall form validity

            // Validate Watch Name
            if (watchName.length < 3) {
                document.getElementById('watch_name_error').innerText = 'Watch name must be at least 3 characters.';
                valid = false; // Set valid to false if there's an error
            }

            // Validate Watch Description
            if (watchDesc.length < 10) {
                document.getElementById('watch_desc_error').innerText = 'Watch description must be at least 10 characters.';
                valid = false;
            }

            // Validate Brand Selection
            if (brand === 'Select Brand') {
                document.getElementById('select_brand_error').innerText = 'Please select a brand.';
                valid = false;
            }

            // Validate Target Audience Selection
            if (targetAudience === 'For') {
                document.getElementById('select_target_audience_error').innerText = 'Please select a target audience.';
                valid = false;
            }

            // Validate Category Selection
            if (category === '') {
                document.getElementById('select_category_error').innerText = 'Please select a category.';
                valid = false;
            }

            // Validate Watch Amount (must be a number)
            if (isNaN(watchAmount) || watchAmount <= 0) {
                document.getElementById('watch_amount_error').innerText = 'Please enter a valid amount.';
                valid = false;
            }

            // Validate Image Upload (if a new image is uploaded)
            if (newWatchImg) {
                const validExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
                if (!validExtensions.exec(newWatchImg)) {
                    document.getElementById('watch_img_error').innerText = 'Please upload a valid image file (jpg, jpeg, png, gif).';
                    valid = false;
                }
            }

            // If all validations pass, submit the form
            if (valid) {
                console.log('Form validation passed. Submitting form...');
                return true; // Allow form submission
            }
            return false; // Prevent form submission
        }
    </script>
    <script src="../assets/js/menu_feature.js"></script>
</body>

</html>