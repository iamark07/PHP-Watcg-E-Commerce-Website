<?php
session_start();
include "../secure_page.php";
include "../config.php";

$user_exist = "";

// Check if the form has been submitted
if (isset($_POST['edit'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $fname = mysqli_real_escape_string($conn, $_POST['first_name']);
    $lname = mysqli_real_escape_string($conn, $_POST['last_name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));

    // Check if the 'select_user' key exists (only for admin role)
    $role = isset($_POST['select_user']) ? mysqli_real_escape_string($conn, $_POST['select_user']) : null;

    // Check if the entered username already exists for another user
    $sql = "SELECT username FROM user WHERE username = '{$username}' AND user_id != {$user_id}";
    $result = mysqli_query($conn, $sql) or die("Query failed.");
    
    if (mysqli_num_rows($result) > 0) {
        $user_exist = "<p class='text-red-500 text-md'>Username already exists</p>";
    } else {
        // Prepare the update query
        $update_sql = "UPDATE user SET first_name = '{$fname}', last_name = '{$lname}', username = '{$username}', password = '{$password}', mobile = '{$mobile}', email = '{$email}'";

        // Include role if set
        if ($role !== null) {
            $update_sql .= ", role = '{$role}'";
            $_SESSION['user_role'] = $role; // Update session to reflect the current role
        }

        $update_sql .= " WHERE user_id = {$user_id}";

        // Execute the update
        $update_result = mysqli_query($conn, $update_sql);

        if ($update_result) {
            header("Location: {$hostname}/"); // Redirect after successful update
        } else {
            echo "<p class='text-red-500 text-md text-center'>Update failed. Please try again.</p>";
        }
    }
}
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
    <title>Edit User</title>
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
                        <li class="text-blue-500"><a href="users.php">Users</a></li>
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
                            <li class="text-black"><a href="../kids_watches/watches.php">Kids</a></li>
                            <li class="text-blue-500"><a href="users.php">Users</a></li>
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
        <h2 class="mt-5 text-blue-400 text-2xl text-start">Edit User</h2>

        <?php
        $user_id1 = "";
        if (isset($_GET['id'])) {
            $user_id1 = $_GET['id'];
        }

        // Run the query to fetch the user data
        $sql1 = "SELECT * FROM user WHERE user_id = {$user_id1}";
        $result1 = mysqli_query($conn, $sql1) or die("Query failed.");

        // Check if the user exists
        if (mysqli_num_rows($result1) > 0) {
            while ($row = mysqli_fetch_assoc($result1)) {
    ?>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $user_id1; ?>" method="POST" class="w-full md:w-1/2 grid grid-cols-1 gap-5 mt-5 py-10 px-5 md:px-10 bg-white" id="edit-form">
                    <div class="input_boxes flex flex-col mt-3">
                        <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                        <div class="text-red-500 text-md" id="fname-error"></div>
                    </div>
                    <div class="input_boxes flex flex-col mt-3">
                        <input type="text" name="first_name" placeholder="First Name" class="col-span-1 px-5 py-3 border border-zinc-500 text-zinc-500 rounded outline-none" value="<?php echo $row['first_name']; ?>">
                        <div class="text-red-500 text-md" id="fname-error"></div>
                    </div>
                    <div class="input_boxes flex flex-col mt-3">
                        <input type="text" name="last_name" placeholder="Last Name" class="col-span-1 px-5 py-3 border border-zinc-500 text-zinc-500 rounded outline-none" value="<?php echo $row['last_name']; ?>">
                        <div class="text-red-500 text-md" id="lname-error"></div>
                    </div>
                    <div class="input_boxes flex flex-col mt-3">
                        <input type="text" name="username" placeholder="Username" class="col-span-1 px-5 py-3 border border-zinc-500 text-zinc-500 rounded outline-none" value="<?php echo $row['username']; ?>">
                        <div class="text-red-500 text-md" id="username-error"></div>
                        <!-- Display error message here -->
                        <?php echo $user_exist; ?>
                    </div>
                    <div class="input_boxes flex flex-col mt-3">
                        <input type="text" placeholder="Mobile Number" name="mobile" class="col-span-1 px-5 py-3 border border-zinc-500 text-zinc-500 rounded outline-none" value="<?php echo $row['mobile']; ?>">
                        <div class="text-red-500 text-md" id="mobile-error"></div>
                    </div>
                    <div class="input_boxes flex flex-col mt-3">
                        <input type="email" placeholder="Enter Email" name="email" class="col-span-1 px-5 py-3 border border-zinc-500 text-zinc-500 rounded outline-none" value="<?php echo $row['email']; ?>">
                        <div class="text-red-500 text-md" id="email-error"></div>
                    </div>
                    <div class="input_boxes flex flex-col mt-3">
                        <input type="password" name="password" placeholder="Set Password" class="col-span-1 px-5 py-3 border border-zinc-500 text-zinc-500 rounded outline-none" value="">
                        <div class="text-red-500 text-md" id="password-error"></div>
                    </div>
                    <?php
                    if ($_SESSION["user_role"] == 1) {
                        echo '<div class="input_boxes flex flex-col mt-3">
                                        <select name="select_user" id="" class="col-span-1 px-5 py-3 border border-zinc-500 text-zinc-500 rounded outline-none">';

                        if ($row["role"] == 1) {
                            echo '  <option disabled>Select</option>
                                            <option value="0">Normal User</option>
                                            <option value="1" selected>Admin</option>';
                        }

                        echo '</select>
                                <div class="text-red-500 text-md" id="role-error"></div>
                                </div>';
                    }
                    ?>

                    

                    <input type="hidden" name="edit" value="submitted">

                    <input type="submit" value="Edit" class="col-span-1 px-5 py-3 bg-blue-400 text-white rounded">
                </form>
                <?php
        }
    }
    ?>
        
    </main>
    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/menu_feature.js"></script>

</body>

</html>