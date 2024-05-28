<?php
    session_start();
    include('../database/dbconnection.php');
    if(isset($_SESSION['admin'])){
        $username = $_SESSION['admin'];
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
    <div class="admin-container contact">
       <div class="card-container">
            <?php
                $sql = "SELECT * FROM contact ORDER BY id DESC";
                $record = mysqli_query($connection,$sql);
                $row = mysqli_num_rows($record);
                if($row>0){
                    for($i=0; $i<$row; $i++){
                        $data = mysqli_fetch_assoc($record);
                        $id = $data['id'];
                        echo "<div class='admin-card'>
                        <div class='col-l-12 col-m-12 col-s-12'>
                            <div class='content-detail'>    
                                <div class='content-author col-l-12 col-m-12 col-s-12'> FROM ".$data['fname']." ".$data['lname']."</div>
                                <div class='content-date col-l-12 col-m-12 col-s-12'>".$data['email']."</div>
                            </div>
                            <div class='description'>
                                ".$data['message']."
                                
                            </div>
                        </div>
                    </div>";    
                    }
                }

            ?>
            
       </div>     
    </div>


    <?php
        }else{
            echo "<script>window.location = '../login.php';</script>";
        }
    ?>
<script src='../js/script.js?<?php echo time(); ?>'></script>
</body>
</html>