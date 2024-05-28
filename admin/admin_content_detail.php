<?php
    session_start();
    include('../database/dbconnection.php');
    $contentId = $_GET['content'];
    if(isset($_SESSION['admin']))
    {
        $username=$_SESSION['admin'];
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
    <title>Create Content</title>
    <!-- style link -->
    <link rel="stylesheet" href="../../css/style.css?<?php echo time(); ?>">
</head>
<body>
    <?php
        if(isset($_SESSION['admin'])){
            include('admin_header.php');
        
    ?>
    <div class="admin-container">
        <?php
            $sql = "SELECT * FROM content WHERE content_id='$contentId'";
            $record = mysqli_query($connection,$sql);
            $data = mysqli_fetch_assoc($record);
            echo "<div class='content'>
                <h1>".$data['title']."</h1>
                <div class='content-detail'>    
                    <div class='content-author col-l-6'>".$data['author']."</div>
                    <div class='content-author col-l-6'>".$data['created_at']."</div>       
                </div>
                <img src='".$data['image']."' alt=''>
                <div class='main-content'>".$data['main_content']."</div>
                
            </div>";

        ?>  
    </div>


    <?php
        }else{
            echo "<script>window.location = '../login.php';</script>";
        }
    ?>
<script src='../js/script.js?<?php echo time(); ?>'></script>
</body>
</html>