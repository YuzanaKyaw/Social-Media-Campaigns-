<?php
    include('dbconnection.php');
    $sql = "CREATE TABLE content(
        content_id int auto_increment primary key,
        title varchar(80),
        category_id int ,        
        author varchar(70),
        main_content longText,
        image text,
        keyword varchar(100),
        reference text,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        CONSTRAINT FK_ContentCategory foreign key(category_id) 
        references category(category_id)
        
    )";
    if(mysqli_query($connection,$sql)){
        echo "Creation Successfully!";
    }else{
        echo "Database connection error!";
    }
?>



