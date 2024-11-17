<?php
include "config.php"; // Include your database configuration file
session_start();

$message = "";

// Check if the token is set
if (isset($_GET['token'])) {
    $token = mysqli_real_escape_string($conn, $_GET['token']);

    // Check if the token exists and is not expired
    $sql = "SELECT * FROM user WHERE reset_token = '{$token}' AND reset_expiry > NOW()";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Form for resetting the password
        if (isset($_POST['reset'])) {
            $new_password = md5($_POST['password']); // Hash the new password

            // Update the password and clear the reset token and expiry
            $update_sql = "UPDATE user SET password = '{$new_password}', reset_token = NULL, reset_expiry = NULL WHERE reset_token = '{$token}'";
            if (mysqli_query($conn, $update_sql)) {
                $message = "Your password has been reset successfully!";
            } else {
                $message = "Error: " . mysqli_error($conn);
            }
        }
    } else {
        $message = "Invalid or expired token.";
    }
} else {
    $message = "No token provided.";
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
    <title>Reset Password</title>
</head>
<body>
    <div class="container w-full flex flex-col items-center justify-center bg-gray-200 p-5 md:p-20 h-screen">
        <h2 class="text-blue-500 text-3xl mb-5">Reset Password</h2>
        <?php
        if ($message) {
            echo "<div class='message'>$message</div>";
        }
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF'] . '?token=' . $token; ?>" method="POST" class="bg-white p-10">
            <div class="input_boxes flex flex-col mt-3 relative">
                <input type="password" name="password" placeholder="Enter new password" class="border border-gray-300 border-solid w-72 md:!w-80 xl:!w-96 rounded-sm p-3" required>
            </div>
            <div class="input_boxes flex flex-col mt-3 relative">
                <input type="submit" name="reset" value="Reset Password" class="cursor-pointer bg-blue-400 text-white w-72 md:!w-80 xl:!w-96 rounded-sm p-3">
            </div>
        </form>
    </div>
</body>
</html>
