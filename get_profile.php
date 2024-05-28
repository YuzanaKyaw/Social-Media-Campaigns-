<?php
    
    include('database/dbconnection.php');
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/style.css?<?php echo time(); ?>">
</head>

<body>
    <?php
        if(isset($_SESSION['user']))
        {
            $username=$_SESSION['user'];
            $sql = "SELECT * FROM user WHERE username='$username'";
            $data = mysqli_query($connection,$sql);
            $record = mysqli_fetch_assoc($data); 
        }else if(isset($_SESSION['admin'])){
            $username=$_SESSION['admin'];
            $sql = "SELECT * FROM user WHERE username='$username'";
            $data = mysqli_query($connection,$sql);
            $record = mysqli_fetch_assoc($data); 
    ?>
    <div class="profile-container">
            <div class="col-l-4 col-m-5 col-s-12">
                <?php
                    if(empty($record['image'])){
                        echo "<img src='https://t3.ftcdn.net/jpg/03/58/90/78/360_F_358907879_Vdu96gF4XVhjCZxN2kCG0THTsSQi8IhT.jpg'>";
                    }else{
                        echo "<img src='".substr($record['image'],3)."'>";
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
                    <div class="col-l-4">Contact Number:</div>
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
                <input type="submit" class="btn btnEdit" value="Edit Profile">
            </div>
    </div>

    <?php
        }else{
            echo "<script>window.location = 'login.php';</script>";
        }
    ?>
    <script src="../js/script.js"></script>
</body>

</html>