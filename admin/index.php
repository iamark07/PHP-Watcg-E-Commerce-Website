<?php
    include "config.php";
    session_start();
    if(isset($_SESSION["username"])){
        header("Location: $hostname/admin/watches/watches.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css link -->
    <link rel="stylesheet" href="assets/css/login.css">

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

    <title>Log in</title>
</head>

<body>
    <main class="bg-gray-50 relative">
        <div class="form_container flex w-full">
            <div class="form_wrapper flex w-full">
                <div class="form_banner bg_blur_section hidden lg:flex justify-center items-center">
                    <img src="assets/img/website-banner/banner-8.jpg" class=" w-full  h-screen object-cover" alt="">
                </div>
                <div class="login_form bg_blur_section bg-white">
                <?php 
                        $user_not_match = "";
                        if(isset($_POST['login'])){
                            include "config.php";

                            $username = mysqli_real_escape_string($conn, $_POST['username']);
                            $password = md5($_POST['password']);

                            // echo $password;
                            // die();

                            $sql = "SELECT user_id, username, role FROM user WHERE  (username = '{$username}' OR mobile = '{$username}')  AND password = '{$password}'";
                            
                            $result = mysqli_query($conn , $sql) or die("Query Failed.");

                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_assoc($result)){
                                    $_SESSION["user_id"] = $row["user_id"];
                                    $_SESSION["username"] = $row["username"];
                                    $_SESSION["user_role"] = $row["role"];

                                    
                                    header("Location: {$hostname}/");
                                    
                                }
                            }
                            else{
                                $user_not_match = "<div class='text-red-500 mt-5'>Username or Mobile or Password are not matched</div>";
                            }
                        }
                    ?>
                    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" class="py-7 px-10 flex-col items-center justify-center h-screen log_form hide_login_form w-full">
                        <a href="index.php" class="mb-5">
                            <img src="assets/img/website-logo/Logo.png" class="w-52" alt="">
                        </a>
                        <h1 class="text-center text-3xl mb-7">Login</h1>
                        <div class="input_boxes flex flex-col mt-3">
                            <input type="text" placeholder="username or mobile" name="username" class="border border-gray-300 border-solid w-72 md:!w-80 xl:!w-96 rounded-sm p-3">
                        </div>
                        <div class="input_boxes flex flex-col mt-3 relative">
                            <input type="password" id="pass" placeholder="Enter Password" name="password" class="border border-gray-300 border-solid w-72 md:!w-80 xl:!w-96 rounded-sm p-3">
                            <i class="ri-eye-off-line text-lg pass_icon_show absolute top-1/2 right-5 -translate-y-1/2 cursor-pointer" onclick="show_pass()"></i>
                            <i class="ri-eye-line text-lg pass_icon_hide show_pass_icon absolute top-1/2 right-5 -translate-y-1/2 hidden cursor-pointer" onclick="hide_pass()"></i>
                        </div>
                        <p class="text-right mt-3 w-full">
                            <a href="forget_password.php" class="text-blue-500">Forget Password ?</a>
                        </p>
                        <div class="submit_btn mt-5 flex gap-3">
                            <input type="submit" value="Login" name="login" class="bg-blue-500 border border-solid border-blue-500 text-white py-3 px-8 rounded-sm cursor-pointer">
                            <span class="bg-white border border-solid border-blue-500 text-blue-500 py-3 px-8 cursor-pointer" onclick="close_log_form()">Cancel</span>
                        </div>
                        
                    </form>
                    
                    <div class="sign_in_account h-screen flex flex-col justify-center items-center">
                        <a href="index.php" class="mt-5">
                            <img src="admin/assets/img/website-logo/Logo.png" class="w-52" alt="">
                        </a>
                        <h3 class="mt-16 text-2xl">Welcome Back!</h3>
                        <button class="bg-blue-500 text-white cursor-pointer w-72 p-3 rounded-sm mt-10" onclick="show_log_form()">Login</button>
                        <?php 
                            echo $user_not_match;
                        ?>
                        <span class="flex mt-5 text-lg">Don't have an account?<a href="register.php" class="text-blue-500 font-bold ms-2 cursor-pointer">Register Here</a></span>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <script src="assets/js/login.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>