<?php
    include "../config.php";
    $brand_id = $_GET['id'];

    $sql = "DELETE FROM watch_brand WHERE brand_id = {$brand_id}";

    if(mysqli_query($conn, $sql)){
        header("Location: $hostname/admin/brand/brand.php");
    }
    else{
        echo "<p class='text-red-500 text-md text-center'>Brand Can't Delete</p>";
    }

    mysqli_close($conn);
?>