<?php
include "config.php"; // Include your database configuration file
session_start();

$message = "";

if (isset($_POST['submit'])) {
    $user_email = mysqli_real_escape_string($conn, $_POST['email']);
    
    // Generate a random reset token
    $token = bin2hex(random_bytes(50));
    
    // Set the expiry time (1 hour from now)
    $expiry_time = date('Y-m-d H:i:s', strtotime('+1 hour'));
    
    // Update the user record with reset token and expiry time
    $sql = "UPDATE user 
            SET reset_token = '{$token}', reset_expiry = '{$expiry_time}' 
            WHERE email = '{$user_email}'";
    
    if (mysqli_query($conn, $sql)) {
        // Send email to user with reset link
        $reset_link = "http://yourwebsite.com/reset_password.php?token=" . $token;
        $subject = "Password Reset Request";
        $message = "Click on this link to reset your password: " . $reset_link;
        $headers = "From: no-reply@yourwebsite.com";
        
        if (mail($user_email, $subject, $message, $headers)) {
            $message = "Password reset email sent!";
        } else {
            $message = "Failed to send email.";
        }
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- rimix icon cdn link -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />

    <!-- FONT AWESOME CDN LINK-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet" />

    <!-- tailwind css -->
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Password Reset</title>
</head>
<body>
    <div class="container w-full flex flex-col items-center justify-center bg-gray-200 p-5 md:p-20 h-screen">
        <h2 class="text-blue-500 text-3xl mb-5">Reset Password</h2>
        <form action="send-password-reset.php" method="POST" class="bg-white p-10">
            <div class="input_boxes flex flex-col mt-3 relative">
                <input type="email" name="email" placeholder="Enter your email" class="border border-gray-300 border-solid w-72 md:!w-80 xl:!w-96 rounded-sm p-3" required>
            </div>
            <div class="input_boxes flex flex-col mt-3 relative">
                <input type="submit" name="submit" value="Send Reset Link" class="cursor-pointer bg-blue-400 text-white w-72 md:!w-80 xl:!w-96 rounded-sm p-3">
            </div>
        </form>
        <?php
        if ($message) {
            echo "<div class='message'>$message</div>";
        }
        ?>
    </div>
</body>
</html>
