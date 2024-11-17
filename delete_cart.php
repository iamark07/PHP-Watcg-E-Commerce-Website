<?php
    include "admin/config.php";
    $cart_id = $_GET['del_id'];

    $sql = "DELETE FROM cart WHERE cart_id = {$cart_id}";

    if(mysqli_query($conn, $sql)){
        header("Location: $hostname/cart.php");
    }
    else{
        echo "<p class='text-red-500 text-md text-center'>Cart Can't Delete</p>";
    }

    mysqli_close($conn);