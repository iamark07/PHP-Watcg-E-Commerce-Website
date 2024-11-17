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
    <style>
        .table_overflow::-webkit-scrollbar {
            display: none;
        }
    </style>
    <title>Clock Brand</title>
</head>

<body>
    <header class="bg-white relative z-40  !border-gray-300 border-solid border-b">
        <div class="main_header flex justify-between items-center ps-3 pe-5 md:px-5 py-2 md:!py-5 lg:px-5  lg:py-5 md:relative">
            <nav class="hidden lg:block">
                <ul class="animate_text_color flex gap-5">
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
    <main class="bg-zinc-300 w-full h-[100dvh] overflow-auto flex flex-col items-center gap-10 py-20 px-5 md:p-20">
        <!-- Wrapping table and button together -->
        <div class="relative w-full md:w-3/4">

            <?php
            include "../config.php";

            $limit = 3;
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
            // $page = isset($_GET['page']) ? $_GET['page'] : 1;
            $offset = ($page - 1) * $limit;
            $sql = "SELECT * FROM clock_brand ORDER BY brand_id DESC LIMIT {$offset},{$limit}";
            $result = mysqli_query($conn, $sql) or die("query failed");

            if (mysqli_num_rows($result) > 0) {
            ?>
                <div class="arrow flex gap-1 justify-end mt-14 items-center">
                    <span class="text-blue-500">Scroll</span>
                    <i class="ri-arrow-right-line text-blue-500"></i>
                </div>
                <div class="table_overflow overflow-x-auto w-full">
                    <table class="w-full bg-zinc-800 mt-10">
                        <thead>
                            <tr>
                                <td class="text-white font-semibold text-lg border border-zinc-600 text-center p-5">Brand id</td>
                                <td class="text-white font-semibold text-lg border border-zinc-600 text-center p-5">Brand Name</td>
                                <td class="text-white font-semibold text-lg border border-zinc-600 text-center p-5">no of Brand Product</td>
                                <td class="text-white font-semibold text-lg border border-zinc-600 text-center p-5">Edit</td>
                                <td class="text-white font-semibold text-lg border border-zinc-600 text-center p-5">Delete</td>
                            </tr>
                        </thead>
                        <tbody class="bg-zinc-200">
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <td class="text-black text-md border border-zinc-500 text-center p-5"><?php echo $row['brand_id']; ?></td>
                                    <td class="text-black text-md border border-zinc-500 text-center p-5">
                                        <?php echo $row['watch_brand_name']; ?>
                                    </td>
                                    <td class="text-black text-md border border-zinc-500 text-center p-5"><?php echo $row['count_brand_watch']; ?></td>
                                    <td class="text-black font-semibold text-lg border border-zinc-500 text-center p-5">
                                        <a href="edit_brand.php?id=<?php echo $row['brand_id']; ?>"><i class="ri-pencil-line"></i></a>
                                    </td>
                                    <td class="text-black font-semibold text-lg border border-zinc-500 text-center p-5">
                                        <a href="delete_brand.php?id=<?php echo $row['brand_id']; ?>"><i class="ri-delete-bin-2-line"></i></a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- Button placed after the table, but positioned absolutely -->
            <?php
            }
            ?>
            <button class="bg-blue-400 text-white text-lg px-5 py-3 absolute right-0 -top-10"><a href="add_brand.php">Add Brand</a></button>

            <?php


            $sql1 = "SELECT * FROM clock_brand";
            $result1 = mysqli_query($conn, $sql1) or die("query failed");

            if (mysqli_num_rows($result1) > 0) {
                $total_records = mysqli_num_rows($result1);
                $total_pages = ceil($total_records / $limit);

                echo '<div class="pagination mt-10">
        <ul class="flex justify-center gap-3">';

                // Calculate the start and end of the range to display
                $start_page = max(1, $page - 2);
                $end_page = min($total_pages, $start_page + 3);
                // Adjust start page if we're at the end of pagination
                if ($end_page - $start_page < 3) {
                    $start_page = max(1, $end_page - 3);
                }

                if ($page > 1) {
                    echo '<li><a href="brand.php?page=' . ($page - 1) . '" class="text-white bg-blue-400 px-4 py-3 rounded">Prev</a></li>';
                }

                // Generate page number links
                for ($i = $start_page; $i <= $end_page; $i++) {
                    $active = $i == $page ? '!bg-blue-500' : '';
                    echo '<li><a href="brand.php?page=' . $i . '" class="text-white ' . $active . ' bg-blue-400 px-4 py-3 rounded">' . $i . '</a></li>';
                }

                if ($page < $total_pages) {
                    echo '<li><a href="brand.php?page=' . ($page + 1) . '" class="text-white bg-blue-400 px-4 py-3 rounded">Next</a></li>';
                }

                echo '</ul></div>';
            }
            ?>
            <!-- <li><a href="#" class="text-white bg-blue-400 px-4 py-3 rounded">2</a></li>
                    <li><a href="#" class="text-white bg-blue-400 px-4 py-3 rounded">3</a></li> -->
        </div>
    </main>
    <script src="../assets/js/menu_feature.js"></script>
</body>

</html>