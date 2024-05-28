<?php
    include('../database/dbconnection.php');

    $category_id = $_GET['id'];
    echo $category_id;
    $sql = "DELETE FROM category WHERE category_id='$category_id'";

    if(mysqli_query($connection,$sql)){
        echo "<script>
            alert('Delete Successfully!');
            window.location='create_category.php';
        </script>";
    }else{
        echo "<script>alert('Database connection error!Try again!);</script>";
    }


?>