<?php

    session_start();
    include('database/dbconnection.php');
    if(isset($_SESSION['user'])){
        $username = $_SESSION['user'];
        $sql = "SELECT * FROM user WHERE username='$username'";
        $data = mysqli_query($connection,$sql);
        $record = mysqli_fetch_assoc($data); 
    }
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <!-- style css link -->
    <link rel="stylesheet" href="css/style.css?<?php echo time(); ?>">
    <!-- font awesome cdn link -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"
    /> -->
</head>

<body>
    <header>
        <?php
            include('header.php')
        ?>
    </header>
    
    <div class="container">
       
    <?php
        if(isset($_SESSION['user']))
        {
           
        
    ?>
    <div class="">
        <div class="profile-container">
            <div class="col-l-4 col-m-5 col-s-12">
                <?php
                    if(empty($record['image'])){
                        echo "<img src='https://t3.ftcdn.net/jpg/03/58/90/78/360_F_358907879_Vdu96gF4XVhjCZxN2kCG0THTsSQi8IhT.jpg'>";
                    }else{
                        echo "<img src='".$record['image']."'>";
                    }

                ?>
            </div>
            <div class="col-l-8 col-m-7 col-s-12">
                <div class="profile-data">
                    <div class="col-l-4">Name:</div>
                    <div class="info" class="col-l-8"><?php echo $record['fname']." ".$record['lname'] ?></div>
                </div>
                <div class="profile-data">
                    <div class="col-l-4">Email:</div>
                    <div class="info" class="col-l-8"><?php echo $record['email'] ?></div>
                </div>
                <div class="profile-data">
                    <div class="col-l-4">Phone Number:</div>
                    <div class="info" class="col-l-8"><?php echo $record['phone_number'] ?></div>
                </div>
                <div class="profile-data">
                    <div class="col-l-4">Country:</div>
                    <div class="info" class="col-l-8"><?php echo $record['country'] ?></div>
                </div>
                <div class="profile-data">
                    <div class="col-l-4">Gender:</div>
                    <div class="info" class="col-l-8"><?php echo $record['gender'] ?></div>
                </div>
                <div class="profile-data">
                    <a href="user_profile_edit.php" class="btn btnEdit"><i class="fa-solid fa-pen"></i>Edit Profile</a>
                </div>
                
            </div>
    </div>
    </div>
    

    <?php
        }else{
            echo "<script>window.location = 'login.php';</script>";
        }
    ?>
    </div>
    

    


    <script type="text/javascript" 
        src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>
    <script>
        document.getElementById('you_here').innerHTML = "<p>You are at <b>Popular social media</b></p>";
    </script>

</body>

</html>