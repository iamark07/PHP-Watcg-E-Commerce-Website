<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css link -->
    <link rel="stylesheet" href="assets/css/product.css">

    <!-- tailwind css link -->
    <!-- <link rel="stylesheet" href="tailwind_config/tailwind_output.css"> -->

    <!-- flowbite tailwind css cdn -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" /> -->

    <!-- rimix icon cdn link -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />

    <!-- FONT AWESOME CDN LINK-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" />

    <!-- tailwind css -->
    <script src="https://cdn.tailwindcss.com"></script>
    <?php
    if (isset($_GET['id']) && isset($_GET['watch_cat'])) {
        $watches_id = $_GET['id'];
        $watch_cat = $_GET['watch_cat'];
    }
    include "admin/config.php";

    $sql2 = "SELECT * FROM all_watches WHERE save_watch_id = {$watches_id} AND target_audience = {$watch_cat}";
    $result2 = mysqli_query($conn, $sql2) or die("query failed.");

    if (mysqli_num_rows($result2) > 0) {
        while ($row2 = mysqli_fetch_assoc($result2)) {
    ?>
            <title><?php echo $row2["watch_title"]; ?></title>

    <?php }
    } ?>
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
                        <li class="text-black"><a href="index.php">Home</a></li>
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
                            <a href="index.php?category=all">All</a>
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
                                <a href="index.php?category=' . $categoryName . '&watch_cat=' . $target_audience_value . '">' . $row3["target_audience_name"] . '</a>
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
                        <!-- <li class="text-black cursor-pointer flex gap-5">
                            <i class="ri-search-eye-line text-xl" id="search_btn"></i>
                        </li> -->
                        <?php
                        // session_start();
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
                    <!-- <i class="ri-search-eye-line text-2xl cursor-pointer" id="mob_search_btn"></i> -->

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
                                    <li class="text-white text-xl"><a href="index.php"><i
                                                class="ri-home-8-line pe-3"></i>Home</a>
                                    </li>
                                    <!-- <li class="text-white text-xl"><a href="about.php"><i
                                                class="ri-store-3-line pe-3"></i>About</a>
                                    </li> -->
                                    <li class="text-white text-xl"><a href="contact.php"><i
                                                class="ri-contacts-book-3-line pe-3"></i>Contact</a></li>

                                    <li class="text-white text-xl"><a href="index.php?category=all"><i class="ri-time-line pe-3"></i>All</a>
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
                                                    <a href="index.php?category=' . $categoryName . '&watch_cat=' . $target_audience_value . '">
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
        <?php
        if (isset($_GET['id']) && isset($_GET['watch_cat'])) {
            $watches_id = $_GET['id'];
            $watch_cat = $_GET['watch_cat'];
        }

        include "admin/config.php";

        // Query to fetch the product from 'all_watches' based on 'save_watch_id' and 'source_table'
        $sql2 = "SELECT * FROM all_watches WHERE save_watch_id = {$watches_id} AND target_audience = '{$watch_cat}'";
        $result2 = mysqli_query($conn, $sql2) or die("query failed.");

        if (mysqli_num_rows($result2) > 0) {
            while ($row2 = mysqli_fetch_assoc($result2)) {

        ?>
                <section class="product_section p-5 lg:p-10 w-full bg-white">
                    <div class="product_detail_container flex flex-col lg:flex-row lg:justify-center gap-5 lg:gap-10 w-full">
                        <div class="product_img_wrapper w-full">
                            <div class="product_img sticky top-10 md:p-10 flex justify-center items-center !border-gray-300 border-solid border">
                                <img src="admin/upload_img/<?php echo $row2['img_folder_name']; ?>/<?php echo $row2['watch_img']; ?>" alt="product image" class="full_side_img w-full h-72 lg:w-80 lg:h-80 object-contain" alt="">
                            </div>
                        </div>
                        <!-- <div class="show_side_img_container bg_blur_section fixed top-0 left-0 z-50 w-full h-screen hide_full_img items-center justify-center">
                            <div class="show_side_img relative bg-white p-5 rounded-md">
                                <img src="" class="full_side_img w-64 h-64 sm:w-80 sm:h-80 md:w-96 md:h-96 object-contain"
                                    alt="">
                                <i class="ri-close-circle-line absolute -top-10 -right-5 sm:-right-10 text-white text-3xl cursor-pointer"
                                    onclick="close_full_img()"></i>
                            </div>
                        </div> -->
                        <div class="pro_all_side_img flex w-full lg:hidden gap-5">
                            <div class="pro_side_img">
                                <img src="admin/upload_img/<?php echo $row2['img_folder_name']; ?>/watch-1.jpg"
                                    class="w-24 h-24 object-contain rounded-sm cursor-pointer border-gray-200 hover:border-blue-500 border-solid border-2"
                                    alt="">
                            </div>
                            <div class="pro_side_img">
                                <img src="admin/upload_img/<?php echo $row2['img_folder_name']; ?>/watch-2.jpg"
                                    class="w-24 h-24 object-contain rounded-sm cursor-pointer border-gray-200 hover:border-blue-500 border-solid border-2"
                                    alt="">
                            </div>
                            <div class="pro_side_img">
                                <img src="admin/upload_img/<?php echo $row2['img_folder_name']; ?>/watch-3.jpg"
                                    class="w-24 h-24 object-contain rounded-sm cursor-pointer border-gray-200 hover:border-blue-500 border-solid border-2"
                                    alt="">
                            </div>
                            <div class="pro_side_img">
                                <img src="admin/upload_img/<?php echo $row2['img_folder_name']; ?>/watch-4.jpg"
                                    class="w-24 h-24 object-contain rounded-sm cursor-pointer border-gray-200 hover:border-blue-500 border-solid border-2"
                                    alt="">
                            </div>
                        </div>
                        <div class="product_detail !w-full">
                            <div class="breadcrumb">
                                <ul class="flex gap-3 text-md">
                                    <li>
                                        <a href="index.php" class="text-black">Home</a>
                                    </li>/
                                    <li>
                                        <a href="product.php" class="breadcrumb_active text-blue-500">Product</a>
                                    </li>
                                </ul>
                            </div>
                            <h2 class="pro_name mt-3 text-3xl font-semibold tracking-tight text-gray-900 capitalize"><?php echo $row2["watch_title"]; ?></h2>
                            <div class="pro_ratings text-white bg-green-500 py-1 px-2 mt-3 rounded-lg w-fit">4.2<i
                                    class="ri-star-s-fill ms-1"></i>
                            </div>
                            <div class="pro_color flex mt-5">
                                <p class="in_stock text-lg text-green-500">In Stock</p>
                            </div>
                            <div class="pro_amount mt-5">
                                <span class="pro_amount text-4xl font-bold text-gray-900"><i
                                        class="fa-solid fa-indian-rupee-sign text-3xl me-2"></i><?php echo $row2["watch_amount"]; ?>
                                </span>
                                <!-- <span
                    class="befor_pro_amount pro_amount line-through ms-3 lg:ms-5 text-2xl lg:text-xl text-gray-500"><i
                        class="fa-solid fa-indian-rupee-sign text-lg"></i> 1,699</span> -->
                            </div>
                            <p class="pro_desc text-lg text-justify mt-3">
                                <?php echo $row2["watch_description"]; ?>
                            </p>
                            <div class="pro_all_side_img hidden w-full lg:flex gap-5 mt-10">
                                <div class="pro_side_img">
                                    <img src="admin/upload_img/<?php echo $row2['img_folder_name']; ?>/watch-1.jpg"
                                        class="w-24 h-24 object-contain rounded-sm cursor-pointer border-gray-200 hover:border-blue-500 border-solid border-2"
                                        alt="">
                                </div>
                                <div class="pro_side_img">
                                    <img src="admin/upload_img/<?php echo $row2['img_folder_name']; ?>/watch-2.jpg"
                                        class="w-24 h-24 object-contain rounded-sm cursor-pointer border-gray-200 hover:border-blue-500 border-solid border-2"
                                        alt="">
                                </div>
                                <div class="pro_side_img">
                                    <img src="admin/upload_img/<?php echo $row2['img_folder_name']; ?>/watch-3.jpg"
                                        class="w-24 h-24 object-contain rounded-sm cursor-pointer border-gray-200 hover:border-blue-500 border-solid border-2"
                                        alt="">
                                </div>
                                <div class="pro_side_img">
                                    <img src="admin/upload_img/<?php echo $row2['img_folder_name']; ?>/watch-4.jpg"
                                        class="w-24 h-24 object-contain rounded-sm cursor-pointer border-gray-200 hover:border-blue-500 border-solid border-2"
                                        alt="">
                                </div>
                            </div>
                            <div class="buy_add_cart_btn fixed lg:static bottom-0 left-0 w-full grid grid-cols-2 lg:flex lg:gap-5 mt-5">
                                <a href="add_to_cart.php?watch_cat=<?php echo $row2['target_audience']; ?>&id=<?php echo $row2['save_watch_id']; ?>">
                                    <button
                                        class="animate-btn-color bg-blue-500 border border-solid border-blue-500 text-white w-full lg:!w-52 p-4">Buy</button>
                                </a>
                                <a href="add_to_cart.php?watch_cat=<?php echo $row2['target_audience']; ?>&id=<?php echo $row2['save_watch_id']; ?>">
                                    <button class="bg-white border border-solid border-blue-500 text-blue-500 w-full lg:!w-52 p-4">Add
                                        To Cart</button>
                                </a>
                            </div>
                            <div class="specification mt-14">
                                <h2 class="text-3xl font-bold">Specification</h2>
                                <ul class="mt-5 w-full lg:w-96 flex flex-col gap-3">
                                    <li class="grid gap-5 grid-cols-2 text-md">
                                        <span class="font-bold">Water Resistant</span>
                                        <span>Yes</span>
                                    </li>
                                    <li class="grid gap-5 grid-cols-2 text-md">
                                        <span class="font-bold">Display Type</span>
                                        <span>Analog</span>
                                    </li>
                                    <li class="grid gap-5 grid-cols-2 text-md">
                                        <span class="font-bold">Style Code</span>
                                        <span>AS000010A</span>
                                    </li>
                                    <li class="grid gap-5 grid-cols-2 text-md">
                                        <span class="font-bold">Occasion</span>
                                        <span>Casual</span>
                                    </li>
                                    <li class="grid gap-5 grid-cols-2 text-md">
                                        <span class="font-bold">Watch Type</span>
                                        <span>Wrist Watch</span>
                                    </li>
                                    <li class="grid gap-5 grid-cols-2 text-md">
                                        <span class="font-bold">Strap Color</span>
                                        <span>Silver</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="ask_ques_container">
                                <div class="ask_ques flex mt-14 w-full">
                                    <input type="text" placeholder="Ask Your Questions" class="w-full lg:w-96 p-3 rounded-s-lg">
                                    <input type="submit" class="py-3 px-5 bg-blue-500 rounded-r-lg text-white">
                                </div>
                                <h2 class="text-3xl font-bold mt-14">Qusestion And Answers</h2>
                                <div class="show_ques_container mt-8 flex flex-col gap-3">
                                    <div class="show_ques bg-gray-100 rounded-lg p-3">
                                        <div class="user text-md"><i class="ri-user-3-fill me-2"></i>User Name</div>
                                        <div class="ques mt-3 text-lg md:text-xl">
                                            <p>Q: <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum,
                                                    expedita.</span></p>
                                        </div>
                                        <div class="answer mt-3 text-lg md:text-xl">A: <span class="text-md md:text-lg ">Lorem
                                                ipsum dolor sit amet.</span></div>
                                    </div>
                                    <div class="show_ques bg-gray-100 rounded-lg p-3">
                                        <div class="user text-md"><i class="ri-user-3-fill me-2"></i>User Name</div>
                                        <div class="ques mt-3 text-lg md:text-xl">
                                            <p>Q: <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum,
                                                    expedita.</span></p>
                                        </div>
                                        <div class="answer mt-3 text-lg md:text-xl">A: <span class="text-md md:text-lg ">Lorem
                                                ipsum dolor sit amet.</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="review_container">
                                <h2 class="text-3xl font-bold mt-14">Reviews</h2>
                                <div class="show_review_container mt-8 flex flex-col gap-5">
                                    <div
                                        class="show_review_img_container bg_blur_section fixed top-0 left-0 z-50 w-full h-screen review_hide_full_img items-center justify-center">
                                        <div class="show_side_img show_review_img relative bg-white p-5 rounded-md">
                                            <img src=""
                                                class="full_review_img w-64 h-64 sm:w-80 sm:h-80  md:w-96 md:h-96 rounded-md object-contain"
                                                alt="">
                                            <i class="ri-close-circle-line absolute -top-10 -right-5 sm:-right-10 text-white text-3xl cursor-pointer"
                                                onclick="close_review_full_img()"></i>
                                        </div>
                                    </div>
                                    <div class="show_review border border-gray-200 border-solid p-3">
                                        <p class="text-base mt-2"><i class="ri-user-3-fill me-2"></i>User Name</p>
                                        <p class="text-md mt-2">Awesome Product <i></i></p>
                                        <div class="review_pro_img flex gap-3 mt-2">
                                            <img src="admin/upload_img/<?php echo $row2['img_folder_name']; ?>/watch-1.jpg"
                                                class="review_img w-20  h-20 object-contain border border-solid border-gray-200 cursor-pointer"
                                                alt="">
                                            <img src="admin/upload_img/<?php echo $row2['img_folder_name']; ?>/watch-2.jpg"
                                                class="review_img w-20  h-20 object-contain border border-solid border-gray-200 cursor-pointer"
                                                alt="">
                                            <img src="admin/upload_img/<?php echo $row2['img_folder_name']; ?>/watch-3.jpg"
                                                class="review_img w-20  h-20 object-contain border border-solid border-gray-200 cursor-pointer"
                                                alt="">
                                            <!-- <img src="admin/upload_img/<?php echo $row2['img_folder_name']; ?>/watch-4.jpg"
                                                class="review_img w-20  h-20 object-contain border border-solid border-gray-200 cursor-pointer"
                                                alt=""> -->
                                        </div>
                                    </div>
                                    <div class="show_review border border-gray-200 border-solid p-3">
                                        <p class="text-base mt-2"><i class="ri-user-3-fill me-2"></i>User Name</p>
                                        <p class="text-md mt-2">Nice Product<i></i></p>
                                        <div class="review_pro_img flex gap-3 mt-2">
                                            <img src="admin/upload_img/<?php echo $row2['img_folder_name']; ?>/watch-2.jpg"
                                                class="review_img w-20 h-20 object-contain border border-solid border-gray-200  cursor-pointer"
                                                alt="">
                                            <img src="admin/upload_img/<?php echo $row2['img_folder_name']; ?>/watch-4.jpg"
                                                class="review_img w-20 h-20 object-contain border border-solid border-gray-200  cursor-pointer"
                                                alt="">
                                            <img src="admin/upload_img/<?php echo $row2['img_folder_name']; ?>/watch-3.jpg"
                                                class="review_img w-20 h-20 object-contain border border-solid border-gray-200  cursor-pointer"
                                                alt="">
                                            <!-- <img src="admin/upload_img/<?php echo $row2['img_folder_name']; ?>/watch-1.jpg"
                                                class="review_img w-20 h-20 object-contain border border-solid border-gray-200  cursor-pointer"
                                                alt=""> -->
                                        </div>
                                    </div>
                                    <button
                                        class="animate-btn-color bg-blue-500 p-5 border border-solid border-blue-500 text-white"
                                        onclick="add_review_btn()">Add Your Review</button>
                                    <div
                                        class="add_review_container close_add_review fixed top-0 left-0 z-50 w-full h-screen flex-col justify-center items-center bg_blur_section">
                                        <div
                                            class="add_review bg-white p-5 w-72 sm:w-96 md:w-1/2 flex flex-col justify-center items-start sm:p-10 rounded-md">
                                            <textarea name="" id=""
                                                class="rounded-md w-full h-52 outline-none border border-gray-300 border-solid"
                                                placeholder="Enter Your Review"></textarea>
                                            <input type="file" class="mt-5 rounded-sm">
                                            <div class="review_ratings flex gap-3 mt-5 text-xl">
                                                <i class="ri-star-s-fill text-yellow-300 cursor-pointer"></i>
                                                <i class="ri-star-s-fill text-yellow-300 cursor-pointer"></i>
                                                <i class="ri-star-s-fill text-yellow-300 cursor-pointer"></i>
                                                <i class="ri-star-s-fill text-yellow-300 cursor-pointer"></i>
                                                <i class="ri-star-s-fill text-yellow-300 cursor-pointer"></i>
                                            </div>
                                            <div class="review_save_cancel mt-5 flex gap-3">
                                                <input type="submit" value="Save"
                                                    class="cursor-pointer bg-blue-500 border border-solid border-blue-500 p-2 sm:p-3 w-20 sm:w-24 rounded-sm text-white">
                                                <button
                                                    class="close_review_btn cursor-pointer bg-white border border-solid border-blue-500 p-2 sm:p-3 w-20 sm:w-24 rounded-sm text-blue-500"
                                                    onclick="close_add_review()">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
        <?php
            }
        }
        ?>

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
                                    <a href="index.php?category=all" class="hover:underline">All</a>
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
                                <a href="index.php?category=' . $categoryName . '&watch_cat=' . $target_audience_value . '" class="hover:underline">' . $row3["target_audience_name"] . '</a>
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
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script> -->

    <!-- script link -->
    <script src="assets/js/pro_detail.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>