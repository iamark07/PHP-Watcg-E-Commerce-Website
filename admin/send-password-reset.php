<?php
include "config.php"; // Database connection file
require "mailer.php"; // Include the mailer configuration

session_start();
$message = "";

if (isset($_POST['submit'])) {
    $user_email = mysqli_real_escape_string($conn, $_POST['email']);

    // Check if the email exists in the database
    $result = mysqli_query($conn, "SELECT * FROM user WHERE email = '{$user_email}'");
    if (mysqli_num_rows($result) > 0) {
        // Generate a random reset token
        $token = bin2hex(random_bytes(50));
        $expiry_time = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Update user with reset token and expiry time
        $sql = "UPDATE user 
                SET reset_token_hash = '{$token}', reset_token_expires_at = '{$expiry_time}' 
                WHERE email = '{$user_email}'";

        if (mysqli_query($conn, $sql)) {
            // Send email to user with reset link
            $reset_link = "http://yourwebsite.com/reset_password.php?token=" . $token;
            $subject = "Password Reset Request";
            $message_body = "Click the link to reset your password: <a href='" . $reset_link . "'>Reset Password</a>";

            // Send the email
            if (sendResetEmail($user_email, $subject, $message_body)) {
                $message = "Password reset email sent!";
            } else {
                $message = "Failed to send email.";
            }
        } else {
            $message = "Error: " . mysqli_error($conn);
        }
    } else {
        $message = "Email not found!";
    }
}

if ($message) {
    echo "<div class='message'>$message</div>";
}
?>