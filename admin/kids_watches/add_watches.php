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

    <!-- remix icon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
    <!-- tailwind css -->
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Add Watch</title>
</head>

<body>
    <header class="bg-white relative z-40 !border-gray-300 border-solid border-b">
        <div
            class="main_header flex justify-between items-center ps-3 pe-5 md:px-5 py-2 md:!py-5 lg:px-5  lg:py-5 md:relative">
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

    <?php
    // Initialize the variable before it's used
    $user_exist = "";

    if (isset($_POST['add'])) {
        // include "../config.php";

        // $fname = mysqli_real_escape_string($conn, $_POST['first_name']);
        // $lname = mysqli_real_escape_string($conn, $_POST['last_name']);
        // $username = mysqli_real_escape_string($conn, $_POST['username']);
        // $password = mysqli_real_escape_string($conn, md5($_POST['password']));
        // $role = mysqli_real_escape_string($conn, $_POST['select_user']);

        // $sql = "SELECT username FROM user WHERE username = '{$username}'";
        // $result = mysqli_query($conn, $sql) or die("query failed.");

        // if (mysqli_num_rows($result) > 0) {
        //     $user_exist = "<p class='text-red-500 text-md text-center'>Username already exists</p>";
        // } else {
        //     $sql1 = "INSERT INTO user (first_name, last_name, username, password, role)
        //     VALUES('{$fname}', '{$lname}','{$username}','{$password}','{$role}')";

        //     if (mysqli_query($conn, $sql1)) {
        //         header("Location: $hostname/admin/watches.php");
        //     }
        // }
    }
    ?>

    <main class="flex justify-center items-center flex-col bg-zinc-100 p-5 md:px-20">
        <h2 class="mt-5 text-blue-400 text-2xl text-start">Add Watch</h2>
        <form action="save_new_watch.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()" class="w-full md:w-1/2 grid grid-cols-1 gap-5 mt-5 py-10 px-5 md:px-10 bg-white">
            <input type="text" name="watch_name" placeholder="Watch Name" class="col-span-1 px-5 py-3 border border-zinc-500 text-zinc-500 rounded outline-none">
            <span id="watch_name_error" class="text-red-500"></span>

            <textarea type="text" name="watch_desc" placeholder="Watch Description" class="col-span-1 px-5 py-3 border border-zinc-500 text-zinc-500 rounded outline-none h-32"></textarea>
            <span id="watch_desc_error" class="text-red-500"></span>

            <select name="select_brand" class="col-span-1 px-5 py-3 border border-zinc-500 text-zinc-500 rounded outline-none">
                <option selected disabled>Select Brand</option>
                <?php
                include "../config.php";
                $sql2 = "SELECT * FROM watch_brand";
                $result2 = mysqli_query($conn, $sql2) or die("query failed.");
                if (mysqli_num_rows($result2) > 0) {
                    while ($row2 = mysqli_fetch_assoc($result2)) {
                        echo "<option value='{$row2['brand_id']}'>{$row2['watch_brand_name']}</option>";
                    }
                }
                ?>
            </select>
            <span id="select_brand_error" class="text-red-500"></span>

            <select name="select_target_audience" class="col-span-1 px-5 py-3 border border-zinc-500 text-zinc-500 rounded outline-none">
                <option selected disabled>For</option>
                <?php
                $sql2 = "SELECT * FROM watch_target_audience";
                $result2 = mysqli_query($conn, $sql2) or die("query failed.");
                if (mysqli_num_rows($result2) > 0) {
                    while ($row2 = mysqli_fetch_assoc($result2)) {
                        echo "<option value='{$row2['target_audience_id']}'>{$row2['target_audience_name']}</option>";
                    }
                }
                ?>
            </select>
            <span id="select_target_audience_error" class="text-red-500"></span>

            <select name="select_category" class="col-span-1 px-5 py-3 border border-zinc-500 text-zinc-500 rounded outline-none">
                <option selected disabled>Select Category</option>
                <?php
                $sql1 = "SELECT * FROM category";
                $result1 = mysqli_query($conn, $sql1) or die("query failed.");
                if (mysqli_num_rows($result1) > 0) {
                    while ($row1 = mysqli_fetch_assoc($result1)) {
                        echo "<option value='{$row1['category_id']}'>{$row1['category_product_name']}</option>";
                    }
                }
                ?>
            </select>
            <span id="select_category_error" class="text-red-500"></span>

            <input type="text" name="watch_amount" placeholder="Enter Amount" class="col-span-1 px-5 py-3 border border-zinc-500 text-zinc-500 rounded outline-none">
            <span id="watch_amount_error" class="text-red-500"></span>

            <input type="file" name="watch_img" class="col-span-1 px-5 py-3 border border-zinc-500 text-zinc-500 rounded outline-none">
            <span id="watch_img_error" class="text-red-500"></span>

            <input type="hidden" name="add" value="submitted">
            <input type="submit" value="Add" class="col-span-1 px-5 py-3 bg-blue-400 text-white rounded">
        </form>
    </main>

    <script>
        function validateForm() {
            let isValid = true;

            // Clear previous error messages
            document.getElementById("watch_name_error").innerText = "";
            document.getElementById("watch_desc_error").innerText = "";
            document.getElementById("select_brand_error").innerText = "";
            document.getElementById("select_target_audience_error").innerText = "";
            document.getElementById("select_category_error").innerText = "";
            document.getElementById("watch_amount_error").innerText = "";
            document.getElementById("watch_img_error").innerText = "";

            // Validate Watch Name
            const watchName = document.forms[0]["watch_name"].value.trim();
            if (watchName === "") {
                document.getElementById("watch_name_error").innerText = "Watch Name is required.";
                isValid = false;
            }

            // Validate Watch Description
            const watchDesc = document.forms[0]["watch_desc"].value.trim();
            if (watchDesc === "") {
                document.getElementById("watch_desc_error").innerText = "Watch Description is required.";
                isValid = false;
            }

            // Validate Select Brand
            const selectBrand = document.forms[0]["select_brand"].value;
            if (selectBrand === "Select Brand") {
                document.getElementById("select_brand_error").innerText = "Please select a brand.";
                isValid = false;
            }

            // Validate Target Audience
            const selectTargetAudience = document.forms[0]["select_target_audience"].value;
            if (selectTargetAudience === "For") {
                document.getElementById("select_target_audience_error").innerText = "Please select a target audience.";
                isValid = false;
            }

            // Validate Category
            const selectCategory = document.forms[0]["select_category"].value;
            if (selectCategory === "Select Category") {
                document.getElementById("select_category_error").innerText = "Please select a category.";
                isValid = false;
            }

            // Validate Amount
            const watchAmount = document.forms[0]["watch_amount"].value.trim();
            if (watchAmount === "" || isNaN(watchAmount) || parseFloat(watchAmount) <= 0) {
                document.getElementById("watch_amount_error").innerText = "Please enter a valid amount.";
                isValid = false;
            }

            // Validate File Upload
            const watchImg = document.forms[0]["watch_img"].value;
            const allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
            if (watchImg === "") {
                document.getElementById("watch_img_error").innerText = "Please upload an image.";
                isValid = false;
            } else if (!allowedExtensions.test(watchImg)) {
                document.getElementById("watch_img_error").innerText = "Only .jpg, .jpeg, .png, and .gif formats are allowed.";
                isValid = false;
            }

            return isValid;
        }
    </script>
    <script src="../assets/js/menu_feature.js"></script>
</body>

</html>