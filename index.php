<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css link -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- tailwind css link -->
    <!-- <link rel="stylesheet" href="tailwind_config/tailwind_output.css"> -->

    <!-- flowbite tailwind css cdn -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

    <!-- rimix icon cdn link -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />

    <!-- FONT AWESOME CDN LINK-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" />

    <!-- tailwind css -->
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Watch E-Commerce</title>
</head>

<body>
    <main class="bg-gray-50 relative">
        <header class="bg-white relative z-40  !border-gray-300 border-solid border-b">
            <div
                class="sub_header hidden md:flex justify-between px-5 py-3 !border-gray-300 border-solid border-b relative">
                <div class="mobile_no flex gap-2 pe-5  !border-gray-300 border-solid border-e">
                    <i class="ri-phone-line text-lg flex gap-2 items-center"></i>
                    <p>72757816XX</p>
                </div>
                <!-- <nav class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                    <ul class="animate_text_color flex gap-5">
                        <li class="text-blue-500"><a href="index.php">Home</a></li>
                        <li class="text-black"><a href="about.php">About</a></li>
                        <li class="text-black"><a href="service.php">Services</a></li>
                        <li class="text-black"><a href="blogs.php">Blogs</a></li>
                        <li class="text-black"><a href="contact.php">Contact</a></li>
                    </ul>
                </nav> -->
                <div class="social_icon flex gap-5 ps-5 !border-gray-300 border-solid border-s">
                    <a href="#"><i
                            class="ri-facebook-circle-line text-xl transition-all duration-300 hover:text-blue-600"></i></a>
                    <a href="#"><i
                            class="ri-instagram-line text-xl transition-all duration-300 hover:text-pink-600"></i></a>
                    <a href="#"><i
                            class="ri-twitter-x-line text-xl transition-all duration-300 hover:text-gray-500"></i></a>
                    <a href="#"><i
                            class="ri-whatsapp-line text-xl transition-all duration-300 hover:text-green-600"></i></a>
                </div>
            </div>
            <div class="main_header flex justify-between items-center ps-3 pe-5 md:px-5 py-2 md:!py-5 lg:px-5 lg:py-5 md:relative">
                <nav class="hidden md:block">
                    <ul class="animate_text_color flex gap-5">
                        <li class="text-black">
                            <a href="?category=all">All</a>
                        </li>
                        <?php
                        include "admin/config.php";

                        $sql3 = "SELECT * FROM watch_target_audience";
                        $result3 = mysqli_query($conn, $sql3) or die("query failed.");

                        if (mysqli_num_rows($result3) > 0) {
                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                $categoryName = strtolower(str_replace(' ', '-', $row3["target_audience_name"]));
                                if ($categoryName == 'men') {
                                    $target_audience_value = 1;
                                } elseif ($categoryName == 'women') {
                                    $target_audience_value = 2;
                                } elseif ($categoryName == 'kids') {
                                    $target_audience_value = 3;
                                } elseif ($categoryName == 'wall-clock') {
                                    $target_audience_value = 4;
                                }
                                echo '  
                            <li class="text-black">
                                <a href="?category=' . $categoryName . '&watch_cat=' . $target_audience_value . '">' . $row3["target_audience_name"] . '</a>
                            </li>';
                            }
                        }
                        ?>
                    </ul>

                </nav>
                <div class="logo md:absolute md:top-1/2 md:left-1/2 md:-translate-x-1/2 md:-translate-y-1/2">
                    <a href="index.php">
                        <img src="admin/assets/img/website-logo/Logo.png" class="w-36 md:!w-52" alt="">
                    </a>
                </div>
                <div class="user_section hidden md:block">
                    <ul class="animate_text_color flex gap-5">
                        <li class="text-black cursor-pointer flex gap-5">
                            <i class="ri-search-eye-line text-xl" id="search_btn"></i>
                        </li>
                        <?php

                        if (isset($_SESSION["username"])) {
                            echo '<li class="text-black cursor-pointer"><a href="cart.php">Cart</a></li>
                                <li class="text-black cursor-pointer"><a href="admin/logout.php">Log out</a></li>
                                <li class="user_setting_btn text-black cursor-pointer"><i class="ri-settings-5-line text-xl"></i></li>';
                        } else {
                            echo '<li class="text-black cursor-pointer"><a href="admin/index.php">Log in</a></li>';
                        }
                        ?>
                    </ul>
                </div>
                <div class="menu_icon md:hidden flex gap-5">
                    <i class="ri-search-eye-line text-2xl cursor-pointer" id="mob_search_btn"></i>

                    <i class="open_menu ri-menu-fold-2-line text-2xl" id="open_menu_btn"></i>
                </div>
                <div class="menu_slider flex fixed md:hidden top-0 z-50 w-full">
                    <div class="menu_side_baar_container w-2/3">
                        <div class="menu_slider_header p-3 bg-white">
                            <div class="menu_logo flex justify-between">
                                <div class="logo">
                                    <a href="index.php">
                                        <img src="admin/assets/img/website-logo/Logo.png" class="w-36" alt="">
                                    </a>
                                </div>
                                <?php
                                if (isset($_SESSION["username"])) {
                                    echo '<a href="admin/logout.php" class="flex flex-col text-md items-center"><i
                                        class="ri-logout-circle-line text-lg"></i>Log Out</a>';
                                } else {
                                    echo '<a href="admin/index.php" class="flex flex-col text-md items-center"><i class="ri-login-circle-line text-lg"></i>Log In</a>';
                                }

                                ?>
                                <!-- <i class="close_menu ri-menu-unfold-2-line " id="close_menu_btn"></i> -->

                            </div>
                            <div class="mob_user_name text-xl mt-5 mx-3">
                                <span class="flex items-center text-gray-700">
                                    <i class="fa-solid fa-user me-3 rounded-full border border-gray-700 border-solid w-10 h-10 !grid place-items-center"></i>
                                    <?php
                                    if (isset($_SESSION["username"]) && isset($_SESSION["user_id"])) {
                                        $user_id = $_SESSION["user_id"];
                                        $sql8 = "SELECT * FROM user WHERE user_id = $user_id";
                                        $result8 = mysqli_query($conn, $sql8) or die("query failed.");

                                        if (mysqli_num_rows($result8) > 0) {
                                            while ($row8 = mysqli_fetch_assoc($result8)) {

                                                echo $row8['first_name'] . " " . $row8['last_name'];
                                            }
                                        }
                                    } else {
                                        echo 'Login Please!';
                                    }

                                    ?>

                                </span>
                            </div>
                        </div>
                        <div class="mob_nav_container rounded-lg">
                            <nav class="mob_nav">
                                <ul class="flex flex-col gap-2 ps-5 py-5">
                                    <li class="nav_active text-white text-xl"><a href="index.php"><i
                                                class="ri-home-8-line pe-3"></i>Home</a>
                                    </li>
                                    <!-- <li class="text-white text-xl"><a href="about.php"><i
                                                class="ri-store-3-line pe-3"></i>About</a>
                                    </li> -->
                                    <li class="text-white text-xl"><a href="contact.php"><i
                                                class="ri-contacts-book-3-line pe-3"></i>Contact</a></li>

                                    <li class="text-white text-xl"><a href="?category=all"><i class="ri-time-line pe-3"></i>All</a>
                                    </li>
                                    <?php
                                    include "admin/config.php";

                                    $sql7 = "SELECT * FROM watch_target_audience";
                                    $result7 = mysqli_query($conn, $sql7) or die("query failed.");

                                    if (mysqli_num_rows($result7) > 0) {
                                        while ($row7 = mysqli_fetch_assoc($result7)) {
                                            $categoryName = strtolower(str_replace(' ', '-', $row7["target_audience_name"]));
                                            // Set the icon based on the target audience name
                                            $iconClass = "";
                                            if ($row7["target_audience_name"] == "Men") {
                                                $iconClass = "ri-user-6-line";
                                            } elseif ($row7["target_audience_name"] == "Women") {
                                                $iconClass = "ri-user-2-line";
                                            } elseif ($row7["target_audience_name"] == "Kids") {
                                                $iconClass = "ri-user-5-line";
                                            } elseif ($row7["target_audience_name"] == "Wall Clock") {
                                                $iconClass = "ri-time-line";
                                            }
                                            if ($categoryName == 'men') {
                                                $target_audience_value = 1;
                                            } elseif ($categoryName == 'women') {
                                                $target_audience_value = 2;
                                            } elseif ($categoryName == 'kids') {
                                                $target_audience_value = 3;
                                            } elseif ($categoryName == 'wall-clock') {
                                                $target_audience_value = 4;
                                            }

                                            // Display the list item with the correct icon
                                            echo '<li class="text-white text-xl">
                                                    <a href="?category=' . $categoryName . '&watch_cat=' . $target_audience_value . '">
                                                        <i class="' . $iconClass . ' pe-3"></i>' . $row7["target_audience_name"] . '
                                                    </a>
                                                </li>';
                                        }
                                    }
                                    ?>
                                    <!-- <li class="text-white text-xl"><a href="service.php"><i
                                                class="ri-shake-hands-line pe-3"></i>Services</a></li>
                                    <li class="text-white text-xl"><a href="blog.php"><i
                                                class="ri-news-line pe-3"></i>Blogs</a>
                                    </li> -->
                                    <!-- <li class="text-white text-xl cursor-pointer" onclick="filter_option()">
                                        <i class="ri-filter-line me-2 text-lg"></i>Filter
                                    </li>
                                    <li class="text-white text-xl cursor-pointer" onclick="sort_option()">
                                        <i class="ri-sort-asc me-2 text-lg"></i>Sort
                                    </li> -->
                                    <?php
                                    if (isset($_SESSION["username"])) {
                                        echo '<li class="text-white text-xl cursor-pointer">
                                                        <a href="cart.php"><i class="ri-shopping-cart-2-line pe-3"></i>Cart</a>
                                                    </li>
                                                    <li class="mob_user_setting_btn text-white text-xl cursor-pointer">
                                                        <i class="ri-settings-5-line text-xl pe-3"></i>Setting
                                                    </li>
                                                    <ul class="mob_user_setting ms-10 my-2 hidden">';

                                        // session_start(); // This should only be called once, at the beginning of your script
                                        include "admin/config.php";

                                        // Check if the user is logged in
                                        if (isset($_SESSION['user_id'])) {
                                            // Get the logged-in user's ID from the session
                                            $user_id = $_SESSION['user_id'];

                                            // Modify the query to select the logged-in user's details
                                            $sql = "SELECT * FROM user WHERE user_id = '$user_id'";
                                            $result = mysqli_query($conn, $sql) or die("Query failed");

                                            if (mysqli_num_rows($result) > 0) {
                                                // Fetch the user's details
                                                while ($row = mysqli_fetch_assoc($result)) {

                                                    // Correct the usage of PHP inside the `echo` statement
                                                    echo '<li class="text-white text-xl cursor-pointer">
                                                                    <a href="admin/users/edit_user.php?id=' . $row['user_id'] . '">Update Account</a>
                                                                </li>';

                                                    // Check if the user has admin privileges
                                                    if ($_SESSION["user_role"] == 1) {
                                                        echo '<li class="text-white text-xl cursor-pointer">
                                                                    <a href="admin/watches/watches.php">Admin Panel</a>
                                                                </li>';
                                                    }
                                                }
                                            }
                                        } else {
                                            echo "<li>User not logged in.</li>";
                                        }

                                        echo '</ul>
                                                    
                                                    <li class="text-white text-xl cursor-pointer">
                                                        <a href="admin/logout.php">
                                                            <i class="ri-logout-circle-r-line pe-3"></i>Log out
                                                        </a>
                                                    </li>';
                                    } else {
                                        echo '<li class="text-white text-xl cursor-pointer">
                                                        <a href="admin/index.php"><i class="ri-login-circle-line pe-3"></i>Log in</a>
                                                    </li>';
                                    }
                                    ?>


                                </ul>
                            </nav>
                        </div>

                        <div class="absolute bottom-0 text-white p-3 w-full">
                            <div class="mobile_no flex gap-2">
                                <i class="ri-phone-line text-2xl flex gap-2 items-center"></i>
                                <p class="text-xl flex items-center">72757816XX</p>
                            </div>
                        </div>
                    </div>
                    <!-- for close menu side bar -->
                    <div class="close_menu_side_bar w-1/3" onclick="close_menu_bar()"></div>
                </div>
            </div>
        </header>
        <ul class="user_setting bg-white absolute top-[121.33px] opacity-0 pointer-events-none z-10 right-0 flex flex-col gap-1 py-3 !border-gray-300 rounded-bl-lg border-solid border transition-all duration-300">

            <?php
            // session_start(); // Start the session to access session variables
            include "admin/config.php";

            // Check if the user is logged in
            if (isset($_SESSION['user_id'])) {
                // Get the logged-in user's ID from the session
                $user_id = $_SESSION['user_id'];

                // Modify the query to select the logged-in user's details
                $sql = "SELECT * FROM user WHERE user_id = '$user_id'";
                $result = mysqli_query($conn, $sql) or die("Query failed");

                if (mysqli_num_rows($result) > 0) {
                    // Fetch the user's details
                    while ($row = mysqli_fetch_assoc($result)) {
            ?>

                        <li class="text-nowrap text-center cursor-pointer px-3 hover:text-blue-500">
                            <a href="admin/users/edit_user.php?id=<?php echo $row['user_id']; ?>">Update Account</a>
                        </li>
                        <?php
                        // session_start();
                        if ($_SESSION["user_role"] == 1) {
                            echo '<li class="text-nowrap text-center cursor-pointer px-3 hover:text-blue-500">
                            <a href="admin/watches/watches.php">Admin Panel</a>
                        </li>';
                        }
                        ?>

            <?php
                    }
                }
            } else {
                echo "User not logged in.";
            }
            ?>

        </ul>
        <div class="search_box_container hidden md:block bg-white p-5 !border-gray-300 rounded-bl-lg border-solid border-t absolute top-0 right-[150px] -z-10">
            <div class="search_box flex">
                <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <input type="search" name="search" class="search_input px-5 py-2 w-52 rounded-l-lg border border-solid border-gray-300" placeholder="Search Your Item">
                    <input type="submit" class="search_submit_input px-2 py-2 text-white w-16 rounded-r-lg !bg-blue-600" value="Search">
                </form>
            </div>
            <!-- <i class="ri-close-circle-line absolute right-12 top-7 text-4xl"></i> -->
        </div>
        <div class="mob_search_box_container flex justify-center md:hidden bg-white p-5 !border-gray-300 rounded-b-lg border-solid border-t absolute top-0 right-0 -z-10 w-full">
            <div class="search_box flex">
                <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <input type="search" name="search"
                        class="search_input px-4 py-3 w-56 rounded-l-lg border border-solid border-gray-300"
                        placeholder="Search Your Item">
                    <input type="submit" class="search_submit_input px-4 py-3 text-white w-20 rounded-r-lg bg-blue-500"
                        value="Search">
                </form>
            </div>
        </div>
        <section class="slider_container">
            <div id="controls-carousel" class="relative w-full" data-carousel="static">
                <!-- Carousel wrapper -->
                <div class="relative !h-64 sm:!h-72 md:!h-screen overflow-hidden">
                    <!-- Item 1 -->
                    <div class="hidden duration-700 ease-in-out !z-0" data-carousel-item>
                        <img src="admin/assets/img/website-banner/banner-1.jpg"
                            class="absolute block object-cover !h-64 sm:!h-72 md:!h-screen w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                            alt="...">
                    </div>
                    <!-- Item 2 -->
                    <div class="hidden duration-700 ease-in-out !z-0" data-carousel-item="active">
                        <img src="admin/assets/img/website-banner/banner-2.jpg"
                            class="absolute block object-cover !h-64 sm:!h-72 md:!h-screen w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                            alt="...">
                    </div>
                    <!-- Item 3 -->
                    <div class="hidden duration-700 ease-in-out !z-0" data-carousel-item>
                        <img src="admin/assets/img/website-banner/banner-3.jpg"
                            class="absolute block object-cover !h-64 sm:!h-72 md:!h-screen w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                            alt="...">
                    </div>
                    <!-- Item 4 -->
                    <div class="hidden duration-700 ease-in-out !z-0" data-carousel-item>
                        <img src="admin/assets/img/website-banner/banner-4.jpg"
                            class="absolute block object-cover !h-64 sm:!h-72 md:!h-screen w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                            alt="...">
                    </div>
                    <!-- Item 5 -->
                    <div class="hidden duration-700 ease-in-out !z-0" data-carousel-item>
                        <img src="admin/assets/img/website-banner/banner-5.jpg"
                            class="absolute block object-cover !h-64 sm:!h-72 md:!h-screen w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                            alt="...">
                    </div>
                </div>
                <!-- Slider controls -->
                <button type="button"
                    class="absolute top-0 start-0 z-1 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                    data-carousel-prev>
                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 1 1 5l4 4" />
                        </svg>
                        <span class="sr-only">Previous</span>
                    </span>
                </button>
                <button type="button"
                    class="absolute top-0 end-0 z-1 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                    data-carousel-next>
                    <span
                        class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg class="w-4 h-4 text-white rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="sr-only">Next</span>
                    </span>
                </button>
            </div>
        </section>
        <section class="brand-logo_container w-full bg-white py-3 md:py-5">
            <marquee behavior="" direction="">
                <div class="brand_logo flex items-center whitespace-nowrap gap-7 md:gap-16">
                    <div class="logo">
                        <img src="admin/assets/img/brands-logo/sonata.png" alt=""
                            class="min-w-14 h-14 sm:min-w-16 sm:!h-16 md:min-w-24 md:h-24 object-contain">
                    </div>
                    <div class="logo">
                        <img src="admin/assets/img/brands-logo/allen-solly.png" alt=""
                            class="min-w-14 h-14 sm:min-w-16 sm:!h-16 md:min-w-24 md:h-24 object-contain">
                    </div>
                    <div class="logo">
                        <img src="admin/assets/img/brands-logo/boat.png" alt=""
                            class="min-w-14 h-14 sm:min-w-16 sm:!h-16 md:min-w-24 md:h-24 object-contain">
                    </div>
                    <div class="logo">
                        <img src="admin/assets/img/brands-logo/fastrack.png" alt=""
                            class="min-w-14 h-14 sm:min-w-16 sm:!h-16 md:min-w-24 md:h-24 object-contain">
                    </div>
                    <div class="logo">
                        <img src="admin/assets/img/brands-logo/fire-bolt.png" alt=""
                            class="min-w-14 h-14 sm:min-w-16 sm:!h-16 md:min-w-24 md:h-24 object-contain">
                    </div>
                    <div class="logo">
                        <img src="admin/assets/img/brands-logo/Fossil-Logo.png" alt=""
                            class="min-w-14 h-14 sm:min-w-16 sm:!h-16 md:min-w-24 md:h-24 object-contain">
                    </div>
                    <div class="logo">
                        <img src="admin/assets/img/brands-logo/provogue.png" alt=""
                            class="min-w-14 h-14 sm:min-w-16 sm:!h-16 md:min-w-24 md:h-24 object-contain">
                    </div>
                    <div class="logo">
                        <img src="admin/assets/img/brands-logo/ashandroh_logo.png" alt=""
                            class="min-w-14 h-14 sm:min-w-16 sm:!h-16 md:min-w-24 md:h-24 object-contain">
                    </div>
                    <div class="logo">
                        <img src="admin/assets/img/brands-logo/ajanta-logo.png" alt=""
                            class="min-w-14 h-14 sm:min-w-16 sm:!h-16 md:min-w-24 md:h-24 object-contain">
                    </div>
                    <div class="logo">
                        <img src="admin/assets/img/brands-logo/peter-england.png" alt=""
                            class="min-w-14 h-14 sm:min-w-16 sm:!h-16 md:min-w-24 md:h-24 object-contain">
                    </div>
                    <div class="logo">
                        <img src="admin/assets/img/brands-logo/Titan.png" alt=""
                            class="min-w-14 h-14 sm:min-w-16 sm:!h-16 md:min-w-24 md:h-24 object-contain">
                    </div>
                </div>
            </marquee>
        </section>
        <section class="product_section_container mt-10 md:mt-24 md:px-10 lg:px-5 flex gap-5 justify-between">
            <aside class="hidden lg:w-1/4 lg:block lg:py-3 xl:py-5">
                <div class="aside_content w-full sticky top-5 bg-white rounded-lg p-5">
                    <h2 class="text-2xl border-b !border-gray-300 py-1">Filter</h2>
                    <div class="filter_container p-3 rounded-lg overflow-auto">
                        <div class="brand_filter">
                            <h3 class="flex items-center text-lg mt-3">Watch Brands <span class="filter_arrow flex item-center justify-center filter_value_hide_btn"><i
                                        class="ri-arrow-drop-down-line text-2xl mx-2 cursor-pointer"></i></span></h3>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET" class="w-full">
                                <ul class="mt-2 filter_content_values rounded-lg">
                                    <?php
                                    include "admin/config.php";

                                    $sql6 = "SELECT * FROM watch_brand";
                                    $result6 = mysqli_query($conn, $sql6) or die("query failed.");

                                    if (mysqli_num_rows($result6) > 0) {
                                        while ($row6 = mysqli_fetch_assoc($result6)) {

                                            $checked = [];
                                            if (isset($_GET['brand_check'])) {
                                                $checked = $_GET['brand_check'];
                                            }
                                            // Create a unique id for each checkbox
                                            $uniqueId = 'watch_brand_' . $row6["brand_id"]; // Assuming 'id' is a unique identifier in your table

                                            echo '<li class="ms-5 flex items-center cursor-pointer"><input type="checkbox" name="brand_check[]" class="me-2 cursor-pointer"" id="' . $uniqueId . '" value="' . $row6["brand_id"] . '" ' . (in_array($row6["brand_id"], $checked) ? 'checked' : '') . '>
                                                <label for="' . $uniqueId . '" class="cursor-pointer">' . $row6["watch_brand_name"] . '</label>
                                            </li>';
                                        }
                                    }
                                    ?>
                                    <input type="submit" value="Watch Filter" class="border border-solid border-blue-500 text-white outline-none font-medium rounded-lg text-sm px-3 md:px-5 py-2.5 text-center bg-blue-500 mt-5 m-auto cursor-pointer">
                                </ul>
                            </form>
                        </div>
                        <div class="brand_filter">
                            <h3 class="flex items-center text-lg mt-3">Clock Brands <span class="filter_arrow fil_arrow_rotate flex item-center justify-center filter_value_hide_btn"><i
                                        class="ri-arrow-drop-down-line text-2xl mx-2 cursor-pointer"></i></span></h3>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET" class="w-full">
                                <ul class="mt-2 filter_content_values hide_filter_values rounded-lg">
                                    <?php
                                    include "admin/config.php";

                                    $clock_sql = "SELECT * FROM clock_brand";
                                    $clock_result = mysqli_query($conn, $clock_sql) or die("query failed.");

                                    if (mysqli_num_rows($clock_result) > 0) {
                                        while ($clock_row = mysqli_fetch_assoc($clock_result)) {

                                            $checked = [];
                                            if (isset($_GET['clock_brand_check'])) {
                                                $checked = $_GET['clock_brand_check'];
                                            }
                                            // Create a unique id for each checkbox
                                            $uniqueId = 'clock_brand_' . $clock_row["brand_id"]; // Assuming 'id' is a unique identifier in your table

                                            echo '<li class="ms-5 flex items-center cursor-pointer"><input type="checkbox" name="clock_brand_check[]" class="me-2 cursor-pointer"" id="' . $uniqueId . '" value="' . $clock_row["brand_id"] . '" ' . (in_array($clock_row["brand_id"], $checked) ? 'checked' : '') . '>
                                                <label for="' . $uniqueId . '" class="cursor-pointer">' . $clock_row["watch_brand_name"] . '</label>
                                            </li>';
                                        }
                                    }
                                    ?>
                                    <input type="submit" value="Clock Filter" class="border border-solid border-blue-500 text-white outline-none font-medium rounded-lg text-sm px-3 md:px-5 py-2.5 text-center bg-blue-500 mt-5 m-auto cursor-pointer">
                                </ul>
                            </form>
                        </div>

                        <div class="category">
                            <h3 class="flex items-center text-lg mt-3">Category <span class="filter_arrow fil_arrow_rotate flex item-center justify-center filter_value_hide_btn"><i
                                        class="ri-arrow-drop-down-line text-2xl mx-2 cursor-pointer"></i></span></h3>
                            <form action="" class="w-full">
                                <ul class="mt-2 filter_content_values hide_filter_values rounded-lg">
                                    <li class="ms-5 flex items-center">
                                        <input type="checkbox" class="me-2 cursor-pointer" id="all_watch'">
                                        <label for="all_watch" class="cursor-pointer">
                                            <a href="?category=all">All</a>
                                        </label>
                                    </li>

                                    <?php
                                    include "admin/config.php";

                                    $sql5 = "SELECT * FROM watch_target_audience";
                                    $result5 = mysqli_query($conn, $sql5) or die("query failed.");

                                    if (mysqli_num_rows($result5) > 0) {
                                        while ($row5 = mysqli_fetch_assoc($result5)) {

                                            $checked = [];
                                            if (isset($_GET['category_check'])) {
                                                $checked = $_GET['category_check'];
                                            }

                                            // Create a unique id for each checkbox
                                            $uniqueId2 = 'target_audience_' . $row5["target_audience_id"]; // Assuming 'id' is a unique identifier in your table

                                            echo '<li class="ms-5 flex items-center cursor-pointer">
                                                        <input type="checkbox" name="category_check[]" class="me-2 cursor-pointer"" id="' . $uniqueId2 . '"  value="' . $row5["target_audience_id"] . '" ' . (in_array($row5["target_audience_id"], $checked) ? 'checked' : '') . '>
                                                        <label for="' . $uniqueId2 . '" class="cursor-pointer">' . $row5["target_audience_name"] . '</label>
                                            </li>';
                                        }
                                    }
                                    ?>
                                    <input type="submit" value="Category" class="border border-solid border-blue-500 text-white outline-none font-medium rounded-lg text-sm px-3 md:px-5 py-2.5 text-center bg-blue-500 mt-5 m-auto cursor-pointer">
                                </ul>
                            </form>
                        </div>
                    </div>
                </div>
            </aside>
            <div class="md:my-5 w-full lg:w-3/4">
                <div class="sort_option hidden lg:flex w-full sticky z-50 top-5 md:px-5 md:py-3 justify-between items-center bg-white rounded-lg">
                    <h3>Sort By :</h3>
                    <div class="sort_container relative">
                        <h4
                            class="sort_select_btn cursor-pointer rounded-t-md border-blue-500 border-solid border bg-blue-500 text-white px-5 py-2 flex items-center">
                            Select<i class="ri-arrow-drop-down-line text-2xl ms-2 select_down_arrow"></i></h4>
                        <ul class="hidden_sort absolute top-full overflow-hidden border border-solid border-gray-200 rounded-b-md left-0 bg-white w-full opacity-0 pointer-events-none">
                            <li class="p-3 border border-solid border-gray-200 cursor-pointer">
                                <a href="?category=all"><i class="ri-time-line pe-3"></i>All</a>
                            </li>
                            <?php
                            include "admin/config.php";

                            $sql4 = "SELECT * FROM watch_target_audience";
                            $result4 = mysqli_query($conn, $sql4) or die("query failed.");

                            if (mysqli_num_rows($result4) > 0) {
                                while ($row4 = mysqli_fetch_assoc($result4)) {
                                    $categoryName = strtolower(str_replace(' ', '-', $row4["target_audience_name"]));
                                    // Set the icon based on the target audience name
                                    $iconClass = "";
                                    if ($row4["target_audience_name"] == "Men") {
                                        $iconClass = "ri-user-6-line";
                                    } elseif ($row4["target_audience_name"] == "Women") {
                                        $iconClass = "ri-user-2-line";
                                    } elseif ($row4["target_audience_name"] == "Kids") {
                                        $iconClass = "ri-user-5-line";
                                    } elseif ($row4["target_audience_name"] == "Wall Clock") {
                                        $iconClass = "ri-time-line";
                                    }
                                    if ($categoryName == 'men') {
                                        $target_audience_value = 1;
                                    } elseif ($categoryName == 'women') {
                                        $target_audience_value = 2;
                                    } elseif ($categoryName == 'kids') {
                                        $target_audience_value = 3;
                                    } elseif ($categoryName == 'wall-clock') {
                                        $target_audience_value = 4;
                                    }


                                    // Display the list item with the correct icon
                                    echo '<li class="py-3 px-2 border border-solid border-gray-200 cursor-pointer">
                                                <a href="?category=' . $categoryName . '&watch_cat=' . $target_audience_value . '">
                                                    <i class="' . $iconClass . ' pe-2"></i>' . $row4["target_audience_name"] . '
                                                </a>
                                            </li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="mob_filter_sort_container flex lg:hidden sticky top-0 left-0 w-full">
                    <div class="mob_filter_container w-1/2 bg-white p-5  !border-gray-300 border-solid border-e ">
                        <h2 class="text-center" class="filter_btn option_btn" onclick="filter_option()"><i
                                class="ri-filter-line me-2 text-lg"></i>Filter</h2>
                        <div class="hidden lg:hidden mob_filter fixed left-0 w-screen bg-white z-50 h-screen p-5">
                            <h2 class="text-3xl border-b !border-gray-300 py-1">Filter</h2>
                            <div class="filter_container mob_filter_content p-5 rounded-lg overflow-auto">
                                <div class="brand_filter">
                                    <h3 class="flex items-center text-xl mt-3">Watch Brands <span
                                            class="filter_arrow flex item-center justify-center filter_value_hide_btn"><i
                                                class="ri-arrow-drop-down-line text-3xl mx-2"></i></span></h3>
                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET" class="w-full">
                                        <ul class="mt-2 filter_content_values">
                                            <?php
                                            include "admin/config.php";

                                            $sql6 = "SELECT * FROM watch_brand";
                                            $result6 = mysqli_query($conn, $sql6) or die("query failed.");

                                            if (mysqli_num_rows($result6) > 0) {
                                                while ($row6 = mysqli_fetch_assoc($result6)) {

                                                    $checked = [];
                                                    if (isset($_GET['brand_check'])) {
                                                        $checked = $_GET['brand_check'];
                                                    }
                                                    // Create a unique id for each checkbox
                                                    $uniqueId = 'mob_watch_brand_' . $row6["brand_id"]; // Assuming 'id' is a unique identifier in your table
                                                    // Create a unique id for each checkbox
                                                    echo '<li class="ms-5 flex items-center cursor-pointer"><input type="checkbox" name="brand_check[]" class="me-2 cursor-pointer"" id="' . $uniqueId . '" value="' . $row6["brand_id"] . '" ' . (in_array($row6["brand_id"], $checked) ? 'checked' : '') . '>
                                                <label for="' . $uniqueId . '" class="cursor-pointer">' . $row6["watch_brand_name"] . '</label>
                                            </li>';
                                                }
                                            }
                                            ?>


                                            <input type="submit" value="Watch Filter" class="border border-solid border-blue-500 text-white outline-none font-medium rounded-lg text-sm px-3 md:px-5 py-2.5 text-center bg-blue-500 mt-5 m-auto cursor-pointer">

                                        </ul>
                                    </form>
                                </div>
                                <div class="brand_filter">
                                    <h3 class="flex items-center text-xl mt-3">Clock Brands <span
                                            class="filter_arrow flex item-center justify-center filter_value_hide_btn"><i
                                                class="ri-arrow-drop-down-line text-3xl mx-2"></i></span></h3>
                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET" class="w-full">
                                        <ul class="mt-2 filter_content_values">
                                            <?php
                                            include "admin/config.php";

                                            $clock_sql = "SELECT * FROM clock_brand";
                                            $clock_result = mysqli_query($conn, $clock_sql) or die("query failed.");

                                            if (mysqli_num_rows($clock_result) > 0) {
                                                while ($clock_row = mysqli_fetch_assoc($clock_result)) {

                                                    $checked = [];
                                                    if (isset($_GET['clock_brand_check'])) {
                                                        $checked = $_GET['clock_brand_check'];
                                                    }
                                                    // Create a unique id for each checkbox
                                                    $uniqueId = 'mob_clock_brand_' . $clock_row["brand_id"]; // Assuming 'id' is a unique identifier in your table

                                                    echo '<li class="ms-5 flex items-center cursor-pointer"><input type="checkbox" name="clock_brand_check[]" class="me-2 cursor-pointer"" id="' . $uniqueId . '" value="' . $clock_row["brand_id"] . '" ' . (in_array($clock_row["brand_id"], $checked) ? 'checked' : '') . '>
                                                <label for="' . $uniqueId . '" class="cursor-pointer">' . $clock_row["watch_brand_name"] . '</label>
                                            </li>';
                                                }
                                            }
                                            ?>
                                            <input type="submit" value="Clock Filter" class="border border-solid border-blue-500 text-white outline-none font-medium rounded-lg text-sm px-3 md:px-5 py-2.5 text-center bg-blue-500 mt-5 m-auto cursor-pointer">
                                        </ul>
                                    </form>
                                </div>
                                <!-- <div class="price_filter">
                                    <h3 class="flex items-center text-xl mt-3">Price <span
                                            class="filter_arrow flex item-center justify-center filter_value_hide_btn"><i
                                                class="ri-arrow-drop-down-line text-3xl mx-2"></i></span></h3>
                                    <div class="progress_bar_container px-5 filter_content_values">
                                        <div class="price_progress_line mt-3 bg-blue-300 w-full h-1 rounded-lg">
                                            <div class="progress_bar bg-blue-500 w-1/4 h-1 rounded-lg relative">
                                                <div
                                                    class="progress_pointer w-5 h-5 rounded-full bg-white absolute top-1/2 -translate-x-1/2 -translate-y-1/2 cursor-pointer">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress_amount_value w-full flex justify-between mt-2">
                                            <div class="min_val text-lg">Rs. 0</div>
                                            <div class="min_val text-lg">Rs. 10,000</div>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="category">
                                    <h3 class="flex items-center text-xl mt-3">Category <span
                                            class="filter_arrow flex item-center justify-center filter_value_hide_btn"><i
                                                class="ri-arrow-drop-down-line text-3xl mx-2"></i></span></h3>
                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET" class="w-full">
                                        <ul class="mt-2 filter_content_values">
                                            <li class="ms-5 flex items-center">
                                                <input type="checkbox" class="me-2 cursor-pointer" id="all_watch'">
                                                <label for="all_watch" class="cursor-pointer">
                                                    <a href="?category=all">All</a>
                                                </label>
                                            </li>

                                            <?php
                                            include "admin/config.php";

                                            $sql5 = "SELECT * FROM watch_target_audience";
                                            $result5 = mysqli_query($conn, $sql5) or die("query failed.");

                                            if (mysqli_num_rows($result5) > 0) {
                                                while ($row5 = mysqli_fetch_assoc($result5)) {

                                                    $checked = [];
                                                    if (isset($_GET['category_check'])) {
                                                        $checked = $_GET['category_check'];
                                                    }

                                                    // Create a unique id for each checkbox
                                                    $uniqueId2 = 'mob_target_audience_' . $row5["target_audience_id"]; // Assuming 'id' is a unique identifier in your table

                                                    echo '<li class="ms-5 flex items-center cursor-pointer">
                                                        <input type="checkbox" name="category_check[]" class="me-2 cursor-pointer"" id="' . $uniqueId2 . '"  value="' . $row5["target_audience_id"] . '" ' . (in_array($row5["target_audience_id"], $checked) ? 'checked' : '') . '>
                                                        <label for="' . $uniqueId2 . '" class="cursor-pointer">' . $row5["target_audience_name"] . '</label>
                                            </li>';
                                                }
                                            }
                                            ?>
                                            <input type="submit" value="Category" class="border border-solid border-blue-500 text-white outline-none font-medium rounded-lg text-sm px-3 md:px-5 py-2.5 text-center bg-blue-500 mt-5 m-auto cursor-pointer">
                                        </ul>
                                    </form>
                                </div>
                            </div>
                            <div class="filter_btn flex w-full absolute bottom-0 left-0">
                                <button
                                    class="text-lg bg-red-500 text-white w-full p-3  !border-gray-300 border-solid border"
                                    onclick="filter_option()">Cancel</button>
                            </div>
                        </div>
                    </div>
                    <div class="mob_sort_container w-1/2 bg-white p-5  ">
                        <h2 class="text-center" class="sort_btn option_btn" onclick="sort_option()"><i
                                class="ri-sort-asc me-2 text-lg"></i>Sort By</h2>
                        <div
                            class="mob_sort hidden lg:hidden fixed top-16 left-1/2 -translate-x-1/2 bg-white z-50 p-3 w-full justify-center">
                            <div class="sort_container relative">
                                <h4
                                    class="sort_select_btn cursor-pointer rounded-t-md w-56 border-blue-500 border-solid border bg-blue-500 text-white px-5 py-2 flex items-center justify-center">
                                    Select<i class="ri-arrow-drop-down-line text-2xl ms-2 select_down_arrow"></i></h4>
                                <ul class="hidden_sort absolute top-full overflow-hidden border border-solid border-gray-200 rounded-b-md left-0 bg-white w-full opacity-0 pointer-events-none">
                                    <li class="p-3 border border-solid border-gray-200 cursor-pointer">
                                        <a href="?category=all"><i class="ri-time-line pe-3"></i>All</a>
                                    </li>
                                    <?php
                                    include "admin/config.php";

                                    $sql4 = "SELECT * FROM watch_target_audience";
                                    $result4 = mysqli_query($conn, $sql4) or die("query failed.");

                                    if (mysqli_num_rows($result4) > 0) {
                                        while ($row4 = mysqli_fetch_assoc($result4)) {
                                            $categoryName = strtolower(str_replace(' ', '-', $row4["target_audience_name"]));
                                            // Set the icon based on the target audience name
                                            $iconClass = "";
                                            if ($row4["target_audience_name"] == "Men") {
                                                $iconClass = "ri-user-6-line";
                                            } elseif ($row4["target_audience_name"] == "Women") {
                                                $iconClass = "ri-user-2-line";
                                            } elseif ($row4["target_audience_name"] == "Kids") {
                                                $iconClass = "ri-user-5-line";
                                            } elseif ($row4["target_audience_name"] == "Wall Clock") {
                                                $iconClass = "ri-time-line";
                                            }
                                            if ($categoryName == 'men') {
                                                $target_audience_value = 1;
                                            } elseif ($categoryName == 'women') {
                                                $target_audience_value = 2;
                                            } elseif ($categoryName == 'kids') {
                                                $target_audience_value = 3;
                                            } elseif ($categoryName == 'wall-clock') {
                                                $target_audience_value = 4;
                                            }

                                            // Display the list item with the correct icon
                                            echo '<li class="py-3 px-2 border border-solid border-gray-200 cursor-pointer">
                                                <a href="?category=' . $categoryName . '&watch_cat=' . $target_audience_value . '">
                                                    <i class="' . $iconClass . ' pe-2"></i>' . $row4["target_audience_name"] . '
                                                </a>
                                            </li>';
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                include "admin/config.php";

                $limit = 12;
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $offset = ($page - 1) * $limit;

                $category = $_GET['category'] ?? 'all';
                $searchTerm = $_GET['search'] ?? '';


                // Set up the table based on category
                switch ($category) {
                    case 'men':
                        $table = 'watches';
                        $id_column = 'watch_id';
                        break;
                    case 'women':
                        $table = 'women_watches';
                        $id_column = 'watch_id';
                        break;
                    case 'kids':
                        $table = 'kids_watches';
                        $id_column = 'watch_id';
                        break;
                    case 'wall-clock': // Add this case
                        $table = 'wall_watches';
                        $id_column = 'watch_id';
                        break;
                    default:
                        $table = 'all_watches';
                        $id_column = 'save_watch_id';
                }
                if (isset($_GET['watch_cat'])) {
                    $watch_cat = $_GET['watch_cat'];
                }
                ?>
                <div class="products_items_container my-10 md:my-5 !px-3 sm:!px-6 lg:!px-0 justify-center !gap-3 sm:!gap-5 w-full grid grid-cols-2 sm:grid-cols-3">
                    <?php

                    if (isset($_GET['brand_check'])) {
                        $check_brand = [];
                        $check_brand = $_GET['brand_check'];
                        $all_brand_id = 1;
                        foreach ($check_brand as $brand_check) {

                            $sql = "SELECT * FROM all_watches WHERE watch_brand_name IN ($brand_check) AND all_brand_id = {$all_brand_id} ORDER BY save_watch_id DESC LIMIT {$offset}, {$limit}";
                            $result = mysqli_query($conn, $sql);
                    ?>

                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                    <div class="product w-full bg-white rounded-lg shadow">
                                        <a href="product.php?watch_cat=<?php echo $row['target_audience']; ?>&id=<?php echo $row[$id_column]; ?>" class="flex justify-center" target="_blank">
                                            <img class="p-8 rounded-t-lg !w-36 !h-36 sm:!w-48 sm:!h-48 md:!w-52 md:!h-52"
                                                src="admin/upload_img/<?php echo $row['img_folder_name']; ?>/<?php echo $row['watch_img']; ?>" alt="product image" />
                                        </a>
                                        <div class="px-3 md:px-5 pb-3 md:pb-5">
                                            <a href="product.php?watch_cat=<?php echo $row['target_audience']; ?>&id=<?php echo $row[$id_column]; ?>" target="_blank">
                                                <h5 class="whitespace-nowrap overflow-hidden text-ellipsis !text-md sm:!text-lg md:!text-xl font-semibold tracking-tight">
                                                    <?php echo $row['watch_title']; ?>
                                                </h5>
                                            </a>
                                            <div class="flex items-center mt-2.5 mb-5">
                                                <!-- Rating stars -->
                                                <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                                    <?php for ($i = 0; $i < 4; $i++): ?>
                                                        <svg class="!w-3 !h-3 sm:!w-4 sm:!h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                        </svg>
                                                    <?php endfor; ?>
                                                    <svg class="!w-3 !h-3 sm:!w-4 sm:!h-4 text-gray-200 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                    </svg>
                                                </div>
                                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ms-3">4.0</span>
                                            </div>
                                            <div class="flex items-center justify-between">
                                                <span class="pro_amount text-xl sm:text-2xl font-bold">
                                                    <i class="fa-solid fa-indian-rupee-sign md:text-2xl"></i> <?php echo $row['watch_amount']; ?>
                                                </span>
                                                <a href="add_to_cart.php?watch_cat=<?php echo $row['target_audience']; ?>&id=<?php echo $row[$id_column]; ?>" class="animate-btn-color border border-solid border-blue-500 text-white outline-none font-medium rounded-lg text-sm px-3 md:px-5 py-2.5 text-center bg-blue-500">
                                                    Add to cart
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                        <?php
                                }
                            }
                        }

                        ?>
                </div>
                <?php
                    } elseif (isset($_GET['clock_brand_check'])) {
                        $check_brand = [];
                        $check_brand = $_GET['clock_brand_check'];
                        $all_brand_id_two = 2;
                        foreach ($check_brand as $brand_check) {

                            $sql = "SELECT * FROM all_watches WHERE watch_brand_name IN ($brand_check) AND all_brand_id = {$all_brand_id_two} ORDER BY save_watch_id DESC LIMIT {$offset}, {$limit}";
                            $result = mysqli_query($conn, $sql);
                ?>

                    <?php
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <div class="product w-full bg-white rounded-lg shadow">
                                <a href="product.php?watch_cat=<?php echo $row['target_audience']; ?>&id=<?php echo $row[$id_column]; ?>" class="flex justify-center" target="_blank">
                                    <img class="p-8 rounded-t-lg !w-36 !h-36 sm:!w-48 sm:!h-48 md:!w-52 md:!h-52"
                                        src="admin/upload_img/<?php echo $row['img_folder_name']; ?>/<?php echo $row['watch_img']; ?>" alt="product image" />
                                </a>
                                <div class="px-3 md:px-5 pb-3 md:pb-5">
                                    <a href="product.php?watch_cat=<?php echo $row['target_audience']; ?>&id=<?php echo $row[$id_column]; ?>" target="_blank">
                                        <h5 class="whitespace-nowrap overflow-hidden text-ellipsis !text-md sm:!text-lg md:!text-xl font-semibold tracking-tight">
                                            <?php echo $row['watch_title']; ?>
                                        </h5>
                                    </a>
                                    <div class="flex items-center mt-2.5 mb-5">
                                        <!-- Rating stars -->
                                        <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                            <?php for ($i = 0; $i < 4; $i++): ?>
                                                <svg class="!w-3 !h-3 sm:!w-4 sm:!h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                    <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                                </svg>
                                            <?php endfor; ?>
                                            <svg class="!w-3 !h-3 sm:!w-4 sm:!h-4 text-gray-200 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                            </svg>
                                        </div>
                                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ms-3">4.0</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="pro_amount text-xl sm:text-2xl font-bold">
                                            <i class="fa-solid fa-indian-rupee-sign md:text-2xl"></i> <?php echo $row['watch_amount']; ?>
                                        </span>
                                        <a href="add_to_cart.php?watch_cat=<?php echo $row['target_audience']; ?>&id=<?php echo $row[$id_column]; ?>" class="animate-btn-color border border-solid border-blue-500 text-white outline-none font-medium rounded-lg text-sm px-3 md:px-5 py-2.5 text-center bg-blue-500">
                                            Add to cart
                                        </a>
                                    </div>
                                </div>
                            </div>
                <?php
                                }
                            }
                        }

                ?>
            </div>
            <?php
                    } elseif (isset($_GET['category_check'])) {
                        $check_category = [];
                        $check_category = $_GET['category_check'];
                        $all_brand_id_two = 2;
                        foreach ($check_category as $category_check) {

                            $sql = "SELECT * FROM all_watches WHERE target_audience IN ($category_check) ORDER BY save_watch_id DESC LIMIT {$offset}, {$limit}";
                            $result = mysqli_query($conn, $sql);
            ?>

                <?php
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <div class="product w-full bg-white rounded-lg shadow">
                            <a href="product.php?watch_cat=<?php echo $row['target_audience']; ?>&id=<?php echo $row[$id_column]; ?>" class="flex justify-center" target="_blank">
                                <img class="p-8 rounded-t-lg !w-36 !h-36 sm:!w-48 sm:!h-48 md:!w-52 md:!h-52"
                                    src="admin/upload_img/<?php echo $row['img_folder_name']; ?>/<?php echo $row['watch_img']; ?>" alt="product image" />
                            </a>
                            <div class="px-3 md:px-5 pb-3 md:pb-5">
                                <a href="product.php?watch_cat=<?php echo $row['target_audience']; ?>&id=<?php echo $row[$id_column]; ?>" target="_blank">
                                    <h5 class="whitespace-nowrap overflow-hidden text-ellipsis !text-md sm:!text-lg md:!text-xl font-semibold tracking-tight">
                                        <?php echo $row['watch_title']; ?>
                                    </h5>
                                </a>
                                <div class="flex items-center mt-2.5 mb-5">
                                    <!-- Rating stars -->
                                    <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                        <?php for ($i = 0; $i < 4; $i++): ?>
                                            <svg class="!w-3 !h-3 sm:!w-4 sm:!h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                            </svg>
                                        <?php endfor; ?>
                                        <svg class="!w-3 !h-3 sm:!w-4 sm:!h-4 text-gray-200 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                        </svg>
                                    </div>
                                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ms-3">4.0</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="pro_amount text-xl sm:text-2xl font-bold">
                                        <i class="fa-solid fa-indian-rupee-sign md:text-2xl"></i> <?php echo $row['watch_amount']; ?>
                                    </span>
                                    <a href="add_to_cart.php?watch_cat=<?php echo $row['target_audience']; ?>&id=<?php echo $row[$id_column]; ?>" class="animate-btn-color border border-solid border-blue-500 text-white outline-none font-medium rounded-lg text-sm px-3 md:px-5 py-2.5 text-center bg-blue-500">
                                        Add to cart
                                    </a>
                                </div>
                            </div>
                        </div>
            <?php
                                }
                            }
                        }

            ?>
            </div>
        <?php
                    } else {
                        // Adjust SQL query based on whether there is a search term
                        if ($searchTerm) {
                            $sql = "SELECT * FROM {$table} WHERE watch_title LIKE '%$searchTerm%' ORDER BY {$id_column} DESC LIMIT {$offset}, {$limit}";
                        }
                        // elseif ($check_brand) {
                        //     $sql = "SELECT * FROM all_watches WHERE watch_brand_name = {$check_brand} ORDER BY save_watch_id DESC LIMIT {$offset}, {$limit}";
                        // }
                        elseif ($table == 'all_watches') {
                            $sql = "SELECT * FROM {$table} ORDER BY all_watch_id DESC LIMIT {$offset}, {$limit}";
                        } else {
                            $sql = "SELECT {$table}.watch_id, {$table}.watch_title, {$table}.watch_description, {$table}.category, {$table}.watch_date, all_watches.save_watch_id, all_watches.target_audience, {$table}.watch_amount, {$table}.img_folder_name, {$table}.watch_img FROM {$table}
                            LEFT JOIN all_watches ON all_watches.save_watch_id = {$table}.watch_id WHERE all_watches.target_audience = {$watch_cat}
                            ORDER BY {$id_column} DESC LIMIT {$offset}, {$limit}";
                        }

                        $result = mysqli_query($conn, $sql);

        ?>
            <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <div class="product w-full bg-white rounded-lg shadow">
                        <a href="product.php?watch_cat=<?php echo $row['target_audience']; ?>&id=<?php echo $row[$id_column]; ?>" class="flex justify-center" target="_blank">
                            <img class="p-8 rounded-t-lg !w-36 !h-36 sm:!w-48 sm:!h-48 md:!w-52 md:!h-52"
                                src="admin/upload_img/<?php echo $row['img_folder_name']; ?>/<?php echo $row['watch_img']; ?>" alt="product image" />
                        </a>
                        <div class="px-3 md:px-5 pb-3 md:pb-5">
                            <a href="product.php?watch_cat=<?php echo $row['target_audience']; ?>&id=<?php echo $row[$id_column]; ?>" target="_blank">
                                <h5 class="whitespace-nowrap overflow-hidden text-ellipsis !text-md sm:!text-lg md:!text-xl font-semibold tracking-tight">
                                    <?php echo $row['watch_title']; ?>
                                </h5>
                            </a>
                            <div class="flex items-center mt-2.5 mb-5">
                                <!-- Rating stars -->
                                <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                    <?php for ($i = 0; $i < 4; $i++): ?>
                                        <svg class="!w-3 !h-3 sm:!w-4 sm:!h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                        </svg>
                                    <?php endfor; ?>
                                    <svg class="!w-3 !h-3 sm:!w-4 sm:!h-4 text-gray-200 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                        <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                    </svg>
                                </div>
                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ms-3">4.0</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="pro_amount text-xl sm:text-2xl font-bold">
                                    <i class="fa-solid fa-indian-rupee-sign md:text-2xl"></i> <?php echo $row['watch_amount']; ?>
                                </span>
                                <a href="add_to_cart.php?watch_cat=<?php echo $row['target_audience']; ?>&id=<?php echo $row[$id_column]; ?>" class="animate-btn-color border border-solid border-blue-500 text-white outline-none font-medium rounded-lg text-sm px-3 md:px-5 py-2.5 text-center bg-blue-500">
                                    Add to cart
                                </a>
                            </div>
                        </div>
                    </div>
            <?php
                            }
                        } else {
                            echo "<p>No watches available.</p>";
                        }
            ?>
            </div>

        <?php

                        if (isset($_GET['category']) && isset($_GET['watch_cat'])) {
                            $page_category = $_GET['category'];
                            $watch_cat = $_GET['watch_cat'];
                        }
                        // Pagination code
                        if ($searchTerm) {
                            $sql2 = "SELECT * FROM {$table} WHERE watch_title LIKE '%$searchTerm%'";
                        }
                        // elseif ($check_brand) {
                        //     $sql2 = "SELECT * FROM {$table} WHERE watch_title LIKE '%$check_brand%'";
                        // }
                        else {
                            $sql2 = "SELECT * FROM {$table}";
                        }
                        $result2 = mysqli_query($conn, $sql2) or die("query failed");

                        if (mysqli_num_rows($result2) > 0) {
                            $total_records = mysqli_num_rows($result2);
                            $total_pages = ceil($total_records / $limit);

                            echo '<div class="pagination mt-10"><ul class="flex justify-center gap-3">';

                            // Calculate the start and end of the range to display
                            $start_page = max(1, $page - 2);
                            $end_page = min($total_pages, $start_page + 3);

                            // Adjust start page if we're at the end of pagination
                            if ($end_page - $start_page < 3) {
                                $start_page = max(1, $end_page - 3);
                            }

                            // "Prev" button
                            if ($page > 1) {
                                if ($table == 'all_watches') {
                                    echo '<li><a href="index.php?page=' . ($page - 1) . '&search=' . $searchTerm . '" class="text-white bg-blue-500 px-4 py-3 rounded">Prev</a></li>';
                                } else {
                                    echo '<li><a href="index.php?category=' . $page_category . '&watch_cat=' . $watch_cat . '&page=' . ($page - 1) . '&search=' . $searchTerm . '" class="text-white bg-blue-500 px-4 py-3 rounded">Prev</a></li>';
                                }
                            }

                            // Display page numbers
                            for ($i = $start_page; $i <= $end_page; $i++) {
                                $active = $i == $page ? "!bg-blue-500" : "";
                                if ($table == 'all_watches') {
                                    echo '<li><a href="index.php?page=' . $i . '&search=' . $searchTerm . '" class="text-white ' . $active . ' bg-blue-400 px-4 py-3 rounded">' . $i . '</a></li>';
                                } else {
                                    echo '<li><a href="index.php?category=' . $page_category . '&watch_cat=' . $watch_cat . '&page=' . $i . '&search=' . $searchTerm . '" class="text-white ' . $active . ' bg-blue-400 px-4 py-3 rounded">' . $i . '</a></li>';
                                }
                            }

                            // "Next" button
                            if ($page < $total_pages) {
                                if ($table == 'all_watches') {
                                    echo '<li><a href="index.php?page=' . ($page + 1) . '&search=' . $searchTerm . '" class="text-white bg-blue-500 px-4 py-3 rounded">Next</a></li>';
                                } else {
                                    echo '<li><a href="index.php?category=' . $page_category . '&watch_cat=' . $watch_cat . '&page=' . ($page + 1) . '&search=' . $searchTerm . '" class="text-white bg-blue-500 px-4 py-3 rounded">Next</a></li>';
                                }
                            }

                            echo '</ul></div>';
                        }
                    }
        ?>





        </div>
        </section>
        <section class="offer"></section>
        <footer class="bg-white mt-10 px-8">
            <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
                <div class="md:flex md:justify-between">
                    <!-- <div class="mb-6 md:mb-0">
                        <a href="index.php" class="flex items-center">
                            <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 me-3" alt="FlowBite Logo" />
                            <span
                                class="self-center text-2xl font-semibold whitespace-nowrap text-black">Tick Tock</span>
                        </a>
                    </div> -->
                    <div class="grid sm:grid-cols-3 md:grid-cols-4 gap-8 sm:gap-6">
                        <div>
                            <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase">CONTACT
                                INFORMATION
                            </h2>
                            <h3 class="text-md">Address:</h3>
                            <h4 class="text-md">Town Hall Ghazipur, 233001 Uttar Pradesh</h4>
                            <h3 class="text-md">Phone:</h3>
                            <h4 class="text-md">72757816XX</h4>
                            <h3 class="text-md">Email:</h3>
                            <h4 class="text-md">arbazxyz@gmail.com</h4>
                        </div>
                        <div>
                            <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase">CUSTOM CARE
                            </h2>
                            <ul class="flex flex-col gap-2 text-gray-500 dark:text-gray-400 font-medium">
                                <li>
                                    <a href="https://flowbite.com/" class="hover:underline">My Account</a>
                                </li>
                                <li>
                                    <a href="https://tailwindcss.com/" class="hover:underline">Shop</a>
                                </li>
                                <li>
                                    <a href="https://tailwindcss.com/" class="hover:underline">Wishlist</a>
                                </li>
                                <li>
                                    <a href="https://tailwindcss.com/" class="hover:underline">Contacts</a>
                                </li>
                                <li>
                                    <a href="https://tailwindcss.com/" class="hover:underline">Terms & Conditions</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase">Company
                            </h2>
                            <ul class="flex flex-col gap-2 text-gray-500 dark:text-gray-400 font-medium">
                                <li>
                                    <a href="https://github.com/themesberg/flowbite" class="hover:underline ">About
                                        Us</a>
                                </li>
                                <li>
                                    <a href="https://discord.gg/4eeurUVvTy" class="hover:underline">Delivery</a>
                                </li>
                                <li>
                                    <a href="https://discord.gg/4eeurUVvTy" class="hover:underline">Payment</a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase">Catagory</h2>
                            <ul class="flex flex-col gap-2 text-gray-500 dark:text-gray-400 font-medium">
                                <li>
                                    <a href="?category=all" class="hover:underline">All</a>
                                </li>
                                <?php
                                include "admin/config.php";

                                $sql3 = "SELECT * FROM watch_target_audience";
                                $result3 = mysqli_query($conn, $sql3) or die("query failed.");

                                if (mysqli_num_rows($result3) > 0) {
                                    while ($row3 = mysqli_fetch_assoc($result3)) {
                                        $categoryName = strtolower(str_replace(' ', '-', $row3["target_audience_name"]));
                                        if ($categoryName == 'men') {
                                            $target_audience_value = 1;
                                        } elseif ($categoryName == 'women') {
                                            $target_audience_value = 2;
                                        } elseif ($categoryName == 'kids') {
                                            $target_audience_value = 3;
                                        } elseif ($categoryName == 'wall-clock') {
                                            $target_audience_value = 4;
                                        }

                                        echo '  
                            <li>
                                <a href="?category=' . $categoryName . '&watch_cat=' . $target_audience_value . '" class="hover:underline">' . $row3["target_audience_name"] . '</a>
                            </li>';
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
                <div class="sm:flex sm:items-center sm:justify-between">
                    <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <a
                            href="https://flowbite.com/" class="hover:underline">Arkdeveloper™</a>. All Rights Reserved.
                    </span>
                    <div class="flex mt-4 sm:justify-center sm:mt-0">
                        <div class="social_icon flex gap-5 sm:ps-5 sm:!border-gray-300 sm:border-solid sm:border-s">
                            <a href="#"><i
                                    class="ri-facebook-circle-line text-xl transition-all duration-300 hover:text-blue-600"></i></a>
                            <a href="#"><i
                                    class="ri-instagram-line text-xl transition-all duration-300 hover:text-pink-600"></i></a>
                            <a href="#"><i
                                    class="ri-twitter-x-line text-xl transition-all duration-300 hover:text-gray-500"></i></a>
                            <a href="#"><i
                                    class="ri-whatsapp-line text-xl transition-all duration-300 hover:text-green-600"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </main>

    <!-- flowbite tailwind css cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

    <!-- script link -->
    <script src="assets/js/script.js"></script>
</body>

</html>