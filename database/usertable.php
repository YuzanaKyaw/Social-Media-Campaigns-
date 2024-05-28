<?php
    include('dbconnection.php');
    $sql = "CREATE TABLE user(
        id int auto_increment primary key,
        fname varchar(50),
        lname varchar(50),
        email varchar(120),
        gender varchar(10),
        phone_number varchar(20),
        country varchar(50),
        username varchar(50),
        password varchar(225),
        role varchar(10),
        image text,
        remark text
    )";

    if(mysqli_query($connection,$sql)){
        echo "Table Created successfully!";
    }else echo "Database conneciton error!";


?>




