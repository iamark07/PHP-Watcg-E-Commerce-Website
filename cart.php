<?php
session_start();
include "admin/config.php"; // Include your database configuration

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page or show an error message
    header("Location: {$hostname}/admin/index.php"); // Replace with your login page
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css link -->
    <link rel="stylesheet" href="assets/css/cart.css">

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

    <title>Cart</title>
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
            <div
                class="main_header flex justify-between items-center ps-3 pe-5 md:px-5 py-2 md:!py-5 lg:px-5 lg:py-5 md:relative">
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

                        if (isset($_SESSION["username"])) {
                            echo '<li class="text-blue-500 cursor-pointer"><a href="cart.php">Cart</a></li>
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
        <div class="breadcrumb mt-5 mx-5">
            <ul class="flex gap-3 text-md">
                <li>
                    <a href="index.php" class="text-gray-500">Home</a>
                </li>/
                <li>
                    <a href="cart.php" class="breadcrumb_active text-blue-500">Cart</a>
                </li>
            </ul>
        </div>
        <section class="cart_section p-6 md:p-10">
            <h1 class="text-center hidden md:block text-4xl font-bold">Cart</h1>
            <div class="cart_container flex !flex-col lg:!flex-row justify-center gap-10 md:mt-14">
                <div class="cart_items_wrapper w-full">
                    <?php
                    // session_start();
                    $user_id = $_SESSION['user_id'];

                    // Fetch cart items for the logged-in user
                    $sql = "SELECT cart.cart_quantity, cart.cart_id, all_watches.save_watch_id, all_watches.watch_title, all_watches.all_watch_id, all_watches.watch_amount, all_watches.target_audience, all_watches.img_folder_name, all_watches.watch_img
                    FROM cart
                    JOIN all_watches ON cart.cart_watch_id = all_watches.all_watch_id
                    WHERE cart.cart_user_id = ?
                    ORDER BY cart.cart_id DESC";

                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, 'i', $user_id);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    $totalAmount = 0; // Initialize total amount
                    ?>

                    <div class="cart_all_detail flex flex-col gap-5">
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                // Calculate the total amount based on quantity and item price
                                $itemTotal = $row['watch_amount'] * $row['cart_quantity'];
                                $totalAmount += $itemTotal; // Add to the total amount
                        ?>
                                <div class="cart_item cart_shadow relative p-7 md:p-10 bg-white rounded-lg">
                                    <a href="delete_cart.php?del_id=<?php echo $row['cart_id']; ?>">
                                        <div class="delete_cart_item_wrapper absolute flex items-center justify-center top-2 right-2 sm:!top-5 sm:!right-5 z-10 w-8 sm:!w-10 h-8 sm:!h-10 rounded-full cart_shadow cursor-pointer">
                                            <i class="ri-delete-bin-2-line delete_cart_item text-red-500 text-md sm:text-xl"></i>
                                        </div>
                                    </a>
                                    <div class="cart_product_container flex gap-10">
                                        <div class="cart_img flex items-center justify-center">
                                            <a href="product.php?watch_cat=<?php echo $row['target_audience']; ?>&id=<?php echo $row['save_watch_id']; ?>">
                                                <img src="admin/upload_img/<?php echo $row['img_folder_name']; ?>/<?php echo $row['watch_img']; ?>"
                                                    class="w-20 h-20 sm:!w-28 sm:!h-28 md:!w-40 md:!h-40 object-contain" alt="">
                                            </a>
                                        </div>
                                        <div class="cart_pro_detail_wrapper w-full mt-3 lg:mt-0">
                                            <div class="cart_pro_detail flex justify-between">
                                                <a href="product.php?watch_cat=<?php echo $row['target_audience']; ?>&id=<?php echo $row['save_watch_id']; ?>">
                                                    <h2 class="text-md sm:!text-2xl md:text-3xl font-bold"><?php echo $row['watch_title']; ?></h2>
                                                </a>
                                            </div>
                                            <h3 class="cart_item_amount flex items-center mt-3">
                                                <span class="pro_amount flex gap-2 items-center text-xl md:!text-4xl font-bold text-gray-900 item-price"
                                                    data-price="<?php echo $row['watch_amount']; ?>">
                                                    <i class="fa-solid fa-indian-rupee-sign text-lg md:!text-2xl"></i>
                                                    <?php echo number_format($row['watch_amount']); ?>
                                                </span>
                                            </h3>
                                            <p class="mt-1 lg:!mt-2 in_stock text-md sm:text-xl text-green-500">In Stock</p>
                                        </div>
                                    </div>
                                    <div class="cart_adjust_container flex justify-between gap-3 mt-5">
                                        <div class="item_quantity_wrapper flex cart_shadow w-fit bg-white">
                                            <i class="decrease_item ri-subtract-line text-lg p-2 inline-block border border-solid border-gray-300 cursor-pointer rounded-s"></i>
                                            <span class="no_of_item item_quantity text-lg py-2 px-5 border-y border-solid border-gray-300 inline-block"><?php echo $row['cart_quantity']; ?></span>
                                            <i class="increase_item ri-add-line text-lg p-2 inline-block border border-solid border-gray-300 cursor-pointer rounded-r"></i>
                                        </div>
                                        <a href="user_address.php">
                                            <button class="animate-btn-color rounded-sm bg-blue-500 text-white text-lg h-fit py-2 px-8 md:!px-10">
                                                <i class="ri-shopping-bag-4-line me-2"></i>Buy
                                            </button>
                                        </a>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo "<p>No items in the cart.</p>";
                        }
                        ?>
                    </div>
                </div>
                <!-- Total Order Amount Container -->
                <div class="total_order_amount_container">
                    <div class="total_order_amount cart_shadow bg-white w-full lg:!w-96 p-5 rounded-lg sticky top-14">
                        <h2 class="text-xl font-bold">Total Cart</h2>
                        <div class="total_order_amount mt-3">
                            <div class="total mt-10 pt-5 border-t border-solid border-gray-300">
                                <p class="flex text-2xl justify-between">Total
                                    <span class="pro_amount flex items-center gap-2 text-green-500" id="totalAmount" style="font-size: 30px;">
                                        <i class="fa-solid fa-indian-rupee-sign" style="font-size: 24px;"></i> <?php echo $totalAmount; ?>
                                    </span>
                                </p>
                            </div>
                        </div>
                        <div class="cart_proceed_back flex gap-3 mt-10">
                            <a href="user_address.php">
                                <button class="animate-btn-color w-32 p-3 bg-blue-500 text-white rounded-sm border border-solid border-blue-500">Proceed</button>
                            </a>
                            <a href="index.php">
                                <button class="w-32 p-3 bg-white text-blue-500 rounded-sm border border-solid border-blue-500">Cancel</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="assets/js/cart.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>