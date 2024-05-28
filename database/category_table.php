<?php
    include('dbconnection.php');

    $sql = "CREATE TABLE category (
        category_id int auto_increment primary key,
        category_name varchar(75)
    )";

    if(mysqli_query($connection,$sql)){
        echo "Create Successfully!";
    }else{
        echo "Database connection error!";
    }

?>




