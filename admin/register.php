<?php
include "config.php";
// session_start();
// if(isset($_SESSION["username"])){
//     header("Location: $hostname/admin/watches/watches.php");
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css link -->
    <link rel="stylesheet" href="assets/css/register.css">

    <!-- rimix icon cdn link -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />

    <!-- FONT AWESOME CDN LINK-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" />

    <!-- tailwind css -->
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Register</title>
</head>

<body>
    <?php
    // Initialize the variable before it's used
    $user_exist = "";
    $admin_key_error = "";  // To store admin key error message

    if (isset($_POST['add'])) {
        include "config.php";
        echo "Form submitted successfully";

        $fname = mysqli_real_escape_string($conn, $_POST['first_name']);
        $lname = mysqli_real_escape_string($conn, $_POST['last_name']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));
        $role = mysqli_real_escape_string($conn, $_POST['select_user']);

        // Check if username already exists
        $sql = "SELECT username FROM user WHERE username = '{$username}'";
        $result = mysqli_query($conn, $sql) or die("Query failed.");

        if (mysqli_num_rows($result) > 0) {
            $user_exist = "<p class='text-red-500 text-md text-center'>Username already exists</p>";
        } else {
            // Admin registration key check
            if ($role == '1') {  // If user selected admin role
                $admin_key = mysqli_real_escape_string($conn, $_POST['admin_key']);
                $correct_key = 'Admin786';  // Define your secret key here

                if ($admin_key !== $correct_key) {
                    $admin_key_error = "<p class='text-red-500 text-md text-center'>Invalid admin registration key.</p>";
                }
            }

            // If no error with admin key, insert into database
            if (empty($admin_key_error)) {
                $sql1 = "INSERT INTO user (first_name, last_name, username, password, role, mobile, email)
            VALUES('{$fname}', '{$lname}','{$username}','{$password}','{$role}','{$mobile}','{$email}')";


                if (mysqli_query($conn, $sql1)) {
                    // Redirect based on the user role
                    header("Location: $hostname/admin/");
                }
            }
        }
    }
    ?>
    <main class="bg-gray-50 relative">
        <div class="form_container flex w-full">
            <div class="form_wrapper flex w-full">
                <div class="form_banner bg_blur_section hidden lg:flex justify-center items-center">
                    <img src="assets/img/website-banner/banner-7.jpg" class=" w-full h-full object-cover" alt="">
                </div>
                <div class="register_form bg_blur_section h-screen overflow-auto bg-white">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="py-5 px-10 flex-col items-center reg_form hide_register_form" id="register-form">
                        <h1 class="text-center text-3xl mb-3">Register</h1>
                        <div class="input_boxes flex flex-col mt-3">
                            <input type="text" placeholder="First Name" name="first_name" class="border border-gray-300 border-solid w-72 md:!w-80 xl:!w-96 rounded-sm p-3">
                            <div class="text-red-500 text-md" id="fname-error"></div>
                        </div>
                        <div class="input_boxes flex flex-col mt-3">
                            <input type="text" placeholder="Last Name" name="last_name" class="border border-gray-300 border-solid w-72 md:!w-80 xl:!w-96 rounded-sm p-3">
                            <div class="text-red-500 text-md" id="lname-error"></div>
                        </div>
                        <div class="input_boxes flex flex-col mt-3">
                            <input type="text" placeholder="Username" name="username" class="border border-gray-300 border-solid w-72 md:!w-80 xl:!w-96 rounded-sm p-3">
                            <div class="text-red-500 text-md" id="username-error"></div>
                        </div>
                        <div class="input_boxes flex flex-col mt-3">
                            <input type="text" placeholder="Mobile Number" name="mobile" class="border border-gray-300 border-solid w-72 md:!w-80 xl:!w-96 rounded-sm p-3">
                            <div class="text-red-500 text-md" id="mobile-error"></div>
                        </div>
                        <div class="input_boxes flex flex-col mt-3">
                            <input type="email" placeholder="Enter Email" name="email" class="border border-gray-300 border-solid w-72 md:!w-80 xl:!w-96 rounded-sm p-3">
                            <div class="text-red-500 text-md" id="email-error"></div>
                        </div>
                        <div class="input_boxes flex flex-col mt-3">
                            <div class="pass_con relative">
                                <input type="password" id="pass" name="password" placeholder="Enter Password" class="border border-gray-300 border-solid w-72 md:!w-80 xl:!w-96 rounded-sm p-3">
                                <i class="ri-eye-off-line text-lg pass_icon_show absolute top-1/2 right-5 -translate-y-1/2 cursor-pointer"></i>
                                <i class="ri-eye-line text-lg pass_icon_hide show_pass_icon absolute top-1/2 right-5 -translate-y-1/2 hidden cursor-pointer"></i>
                            </div>
                            <div class="text-red-500 text-md" id="password-error"></div>
                        </div>

                        <div class="input_boxes flex flex-col mt-3 relative">
                            <select name="select_user" id="select-user" class="border border-gray-300 border-solid w-72 md:!w-80 xl:!w-96 rounded-sm p-3 cursor-pointer">
                                <option selected disabled>Select</option>
                                <option value="0">Normal User</option>
                                <option value="1">Admin</option>
                            </select>
                            <div class="text-red-500 text-md" id="role-error"></div>
                        </div>

                        <!-- Admin key input (hidden initially) -->
                        <div class="input_boxes flex flex-col mt-3 relative" id="admin-key" style="display:none;">
                            <input type="password" name="admin_key" placeholder="Enter Admin Key" class="border border-gray-300 border-solid w-72 md:!w-80 xl:!w-96 rounded-sm p-3">
                        </div>

                        <!-- Display error messages here -->
                        <div id="error-messages" class="mt-4"></div>
                        <?php echo $user_exist; ?>
                        <?php echo $admin_key_error; ?>

                        <!-- Hidden input to ensure $_POST['add'] is set -->
                        <input type="hidden" name="add" value="submitted">

                        <div class="submit_btn mt-5 flex gap-3">
                            <input type="submit" value="Register" class="bg-blue-500 border border-solid cursor-pointer border-blue-500 text-white py-3 px-8 rounded-sm">
                            <span class="bg-white border border-solid border-blue-500 text-blue-500 py-3 px-8 cursor-pointer" onclick="close_register_form()">Cancel</span>
                        </div>
                    </form>
                    <div class="creat_account h-screen flex flex-col justify-center items-center">
                        <a href="index.php" class="mt-5">
                            <img src="assets/img/website-logo/Logo.png" class="w-52" alt="">
                        </a>
                        <h3 class="mt-16 text-2xl">Create an account</h3>
                        <button class="bg-blue-500 text-white w-72 p-3 rounded-sm mt-10" onclick="show_reg_form()">Create</button>
                        <span class="flex mt-5 text-lg">Already have an account?<a href="index.php" class="text-blue-500 font-bold ms-2 cursor-pointer">Log in</a></span>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="assets/js/register.js"></script>
    <script src="assets/js/script.js"></script>

</body>

</html>