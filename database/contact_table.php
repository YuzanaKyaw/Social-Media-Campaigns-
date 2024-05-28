<?php
    include('dbconnection.php');

    $sql = "CREATE TABLE contact(
        id int auto_increment primary key,
        fname varchar(50),
        lname varchar(50),
        email varchar(120),
        phone varchar(20),
        message text
    )";

    if(mysqli_query($connection,$sql)){
        echo "Create Successfully!";
    }else{
        echo "Connection error!";
    }

?>



