<?php
    include('../database/dbconnection.php');

    $content_id = $_GET['id'];
    echo $content_id;

    $sql = "DELETE FROM content WHERE content_id='$content_id'";

    if(mysqli_query($connection,$sql)){
        echo "<script>
            alert('Delete Successfully!');
            window.location='content_lists.php';
        </script>";
    }else{
        echo "<script>alert('Database connection error!Try again!);</script>";
    }


?>