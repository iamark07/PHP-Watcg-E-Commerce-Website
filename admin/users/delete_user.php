<?php
    include "../config.php";
    $user_id = $_GET['id'];

    $sql = "DELETE FROM user WHERE user_id = {$user_id}";

    if(mysqli_query($conn, $sql)){
        header("Location: $hostname/admin/users/users.php");
    }
    else{
        echo "<p class='text-red-500 text-md text-center'>User Can't Delete</p>";
    }

    mysqli_close($conn);
?>