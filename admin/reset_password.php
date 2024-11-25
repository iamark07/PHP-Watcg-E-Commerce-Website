<?php
include "config.php";
session_start();

$message = "";
$log = "";

// Check if token is in the URL
if (isset($_GET['token'])) {
    $token = mysqli_real_escape_string($conn, $_GET['token']);

    // Retrieve the record with the given token
    $result = mysqli_query($conn, "SELECT * FROM user WHERE reset_token_hash = '{$token}'");

    if (mysqli_num_rows($result) > 0) {
        // Fetch the user's data
        $row = mysqli_fetch_assoc($result);
        $expiry_time = $row['reset_token_expires_at'];

        // Check if the token has expired (1 hour validity)
        if (strtotime($expiry_time) > time()) {
            // Token is still valid, proceed with password reset
            if (isset($_POST['submit'])) {
                $new_password = mysqli_real_escape_string($conn, $_POST['password']);
                $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

                // Check if passwords match
                if ($new_password === $confirm_password) {
                    // Hash the password and update in the database
                    $hashed_password = md5($new_password);

                    $sql = "UPDATE user SET password = '{$hashed_password}', reset_token_hash = NULL, reset_token_expires_at = NULL WHERE reset_token_hash = '{$token}'";

                    if (mysqli_query($conn, $sql)) {
                        $message = "Password reset successful!";
                        $log = '<p class="mt-5">Now You Can <a href="' . $hostname . '/admin/" class="px-3 py-2 bg-blue-500 text-white">Login</a></p>';
                    } else {
                        $message = "Error: " . mysqli_error($conn);
                    }
                } else {
                    $message = "Passwords do not match!";
                }
            }
        } else {
            // Token has expired
            $message = "Your reset token has expired!";
        }
    } else {
        $message = "Invalid token!";
    }
} else {
    header("Location: $hostname/admin/"); // Redirect if token is missing
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Reset Password</title>
</head>

<body>
    <div class="container w-full flex flex-col items-center justify-center bg-gray-200 p-5 md:p-20 h-screen">
        <h2 class="text-blue-500 text-3xl mb-5">Set New Password</h2>
        <form action="" method="POST" class="bg-white p-10">
            <div class="input_boxes flex flex-col mt-3 relative">
                <input type="password" name="password" placeholder="New Password" class="border border-gray-300 border-solid w-72 md:w-80 xl:w-96 rounded-sm p-3" required>
            </div>
            <div class="input_boxes flex flex-col mt-3 relative">
                <input type="password" name="confirm_password" placeholder="Confirm Password" class="border border-gray-300 border-solid w-72 md:w-80 xl:w-96 rounded-sm p-3" required>
            </div>
            <div class="input_boxes flex flex-col mt-3 relative">
                <input type="submit" name="submit" value="Reset Password" class="cursor-pointer bg-blue-400 text-white w-72 md:w-80 xl:w-96 rounded-sm p-3">
            </div>
        </form>
        <?php
        if ($message) {
            echo "<div class='message'>$message</div>";
            echo $log;
        }
        ?>
    </div>
</body>
</html>