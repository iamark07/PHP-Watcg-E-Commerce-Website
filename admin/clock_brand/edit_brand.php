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
    <title>Edit Brand</title>
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
                        <li class="text-black"><a href="../kids_watches/watches.php">Kids</a></li>
                        <li class="text-black"><a href="../users/users.php">Users</a></li>
                        <li class="text-black"><a href="../category/category.php">Category</a></li>
                        <li class="text-black"><a href="../brand/brand.php">Watch Brand</a></li>
                        <li class="text-blue-500"><a href="brand.php">Wall Clock Brand</a></li>
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
                            <li class="text-black"><a href="../kids_watches/watches.php">Kids</a></li>
                            <li class="text-black"><a href="../users/users.php">Users</a></li>
                            <li class="text-black"><a href="../category/category.php">Category</a></li>
                            <li class="text-black"><a href="../brand/brand.php">Watch Brand</a></li>
                            <li class="text-blue-500"><a href="brand.php">Wall Clock Brand</a></li>
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


    if (isset($_POST['edit'])) {
        include "../config.php";
        $brand_id = mysqli_real_escape_string($conn, $_POST['brand_id']);
        $brand_input = mysqli_real_escape_string($conn, $_POST['brand_input']);

        $sql = "UPDATE clock_brand SET watch_brand_name = '{$brand_input}' WHERE brand_id = {$brand_id}";

        if (mysqli_query($conn, $sql)) {
            header("Location: $hostname/admin/clock_brand/brand.php");
        }
    }
    ?>
    <main class="flex justify-center items-center flex-col bg-zinc-100 p-5 md:px-20">
        <h2 class="mt-5 text-blue-400 text-2xl text-start">Edit Brand</h2>
        <?php
        if (isset($_GET['id'])) {
            $brand_id = $_GET['id'];
        }
        include "../config.php";

        // Run the query to fetch the user data
        $sql1 = "SELECT * FROM clock_brand WHERE brand_id = {$brand_id}";
        $result1 = mysqli_query($conn, $sql1) or die("Query failed.");

        // Check if the user exists
        if (mysqli_num_rows($result1) > 0) {
            while ($row = mysqli_fetch_assoc($result1)) {
        ?>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="w-full md:w-1/2 grid grid-cols-1 gap-5 mt-5 py-10 px-5 md:px-10 bg-white">
                    <input type="hidden" name="brand_id" value="<?php echo $row['brand_id']; ?>">
                    <input type="text" class="col-span-1 px-5 py-3 border border-zinc-500 text-zinc-500 rounded outline-none" name="brand_input" value="<?php echo $row['watch_brand_name']; ?>" placeholder="Add Brand" required>

                    <input type="submit" value="edit" name="edit" class="col-span-1 px-5 py-3 bg-blue-400 text-white rounded">
                </form>
        <?php
            }
        }

        ?>
    </main>
    <script src="../assets/js/menu_feature.js"></script>
</body>

</html>