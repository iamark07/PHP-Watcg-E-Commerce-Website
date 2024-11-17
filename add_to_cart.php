<?php
session_start();
include "admin/config.php"; // Include your database configuration

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page or show an error message
    header("Location: {$hostname}/admin/index.php"); // Replace with your login page
    exit();
}

// Get the watch ID and source table from the URL
$watch_id = $_GET['id'] ?? null; // Use null coalescing operator to avoid undefined index warning
$watch_cat = $_GET['watch_cat'] ?? null;
$user_id = $_SESSION['user_id']; // The logged-in user's ID

if ($watch_id && $watch_cat) {
    include "admin/config.php";
    
    // Ensure the save_watch_id exists in all_watches with the specified source_table
    $check_sql = "SELECT all_watch_id FROM all_watches WHERE save_watch_id = ? AND target_audience = ?";
    $check_stmt = mysqli_prepare($conn, $check_sql);
    mysqli_stmt_bind_param($check_stmt, 'is', $watch_id, $watch_cat);
    mysqli_stmt_execute($check_stmt);
    $check_result = mysqli_stmt_get_result($check_stmt);

    if (mysqli_num_rows($check_result) > 0) {
        // Fetch the corresponding all_watch_id
        $row = mysqli_fetch_assoc($check_result);
        $all_watch_id = $row['all_watch_id']; // Get the all_watch_id

        // Check if the item is already in the user's cart
        $cart_check_sql = "SELECT cart_quantity FROM cart WHERE cart_user_id = ? AND cart_watch_id = ?";
        $cart_check_stmt = mysqli_prepare($conn, $cart_check_sql);
        mysqli_stmt_bind_param($cart_check_stmt, 'ii', $user_id, $all_watch_id);
        mysqli_stmt_execute($cart_check_stmt);
        $cart_check_result = mysqli_stmt_get_result($cart_check_stmt);

        if (mysqli_num_rows($cart_check_result) > 0) {
            // Item already in cart, update quantity
            $row = mysqli_fetch_assoc($cart_check_result);
            $new_quantity = $row['cart_quantity'] + 1; // Increase quantity by 1

            $update_sql = "UPDATE cart SET cart_quantity = ? WHERE cart_user_id = ? AND cart_watch_id = ?";
            $update_stmt = mysqli_prepare($conn, $update_sql);
            mysqli_stmt_bind_param($update_stmt, 'iii', $new_quantity, $user_id, $all_watch_id);

            if (mysqli_stmt_execute($update_stmt)) {
                // Successfully updated quantity
                header("Location: {$hostname}/cart.php");
            } else {
                // Handle error while updating
                echo "Error updating cart quantity: " . mysqli_error($conn);
            }
        } else {
            // Item not in cart, insert new record
            $insert_sql = "INSERT INTO cart (cart_user_id, cart_watch_id, cart_quantity) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $insert_sql);
            $quantity = 1; // Set a default quantity
            mysqli_stmt_bind_param($stmt, 'iii', $user_id, $all_watch_id, $quantity);

            if (mysqli_stmt_execute($stmt)) {
                // Successfully added to cart
                header("Location: {$hostname}/cart.php");
            } else {
                // Handle error while inserting
                echo "Error adding item to cart: " . mysqli_error($conn);
            }
        }
    } else {
        echo "Error: The selected watch does not exist.";
    }
} else {
    echo "Error: No watch ID provided.";
}
?>
