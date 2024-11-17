<?php
    include "../config.php";
    $category_id = $_GET['id'];

    $sql = "DELETE FROM category WHERE category_id = {$category_id}";

    if(mysqli_query($conn, $sql)){
        header("Location: $hostname/admin/category/category.php");
    }
    else{
        echo "<p class='text-red-500 text-md text-center'>Category Can't Delete</p>";
    }

    mysqli_close($conn);
?>