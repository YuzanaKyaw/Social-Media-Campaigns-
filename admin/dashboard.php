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
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/style.css?<?php echo time(); ?>">
</head>

<body>
    <?php
        if(isset($_SESSION['admin']))
        {
            $username = $_SESSION['admin'];
            include('admin_header.php');
    ?>
    <div class="admin-container">

            <div class="dashboard">
                <div class="col-l-3 col-m-6 col-s-10 dashboard-card">
                    <h2><i class="fa-solid fa-users"></i>User</h2>
                    <!-- <div class="">Both members and admin of SocilHub</div> -->
                    <div class='content-detail'>
                        <div class='content-author col-l-6'>Members</div>
                        <?php
                            $user_sql = "SELECT count('id') as user FROM user WHERE role='user'";
                            $numUser = mysqli_query($connection,$user_sql);
                            $numUser = mysqli_fetch_assoc($numUser);
                            echo "<div class='content-author col-l-6'>".$numUser['user']."</div>";
                            // echo $numUser;

                        ?>
                        
                    </div>
                    <div class='content-detail'>
                        <div class='content-author col-l-6'>Admin</div>
                        <?php
                            $admin_sql = "SELECT count('id') as numAdmin FROM user  WHERE role='admin'";
                            $numAdmin = mysqli_query($connection,$admin_sql);
                            $numAdmin = mysqli_fetch_assoc($numAdmin);
                            echo "<div class='content-author col-l-6'>".$numAdmin['numAdmin']."</div>";
                            

                        ?>
                    </div>
                    <div class='content-detail'>
                        <div class='content-author col-l-6'>Total</div>
                        <div class='content-author col-l-6'><?php echo $numUser['user']+$numAdmin['numAdmin']; ?></div>
                    </div>
                </div>
                <div class="col-l-3 col-m-6 col-s-10 dashboard-card">
                    <h2><i class="fa-solid fa-layer-group"></i>Category</h2>
                    <div class='content-detail'>
                        <div class='content-author col-l-6'>Type</div>
                        <?php
                            $user_sql = "SELECT count('id') as numCategory FROM category";
                            $numCategory = mysqli_query($connection,$user_sql);
                            $numCategory = mysqli_fetch_assoc($numCategory);
                            echo "<div class='content-author col-l-6'>".$numCategory['numCategory']."</div>";

                        ?>
                    </div>
                    <div class='content-detail'>
                        <div class='content-author col-l-6'>Total</div>
                        <div class='content-author col-l-6'><?php echo $numCategory['numCategory']; ?></div>
                    </div>
                        
                </div>
                
                
                <div class="col-l-3 col-m-6 col-s-10 dashboard-card">
                    <h2><i class="fa-solid fa-comment"></i>Contact Message</h2>
                    <div class='content-detail'>
                        <div class='content-author col-l-6'>Message</div>
                        <?php
                            $user_sql = "SELECT count(*) as msg FROM contact";
                            $numMsg = mysqli_query($connection,$user_sql);
                            $numMsg = mysqli_fetch_assoc($numMsg);
                            echo "<div class='content-author col-l-6'>".$numMsg['msg']."</div>";

                        ?>
                    </div>
                    <div class='content-detail'>
                        <div class='content-author col-l-6'>Total</div>
                        <div class='content-author col-l-6'><?php echo $numMsg['msg']; ?></div>
                    </div>
                </div>
                
                <div class="col-l-3 col-m-6 col-s-10 dashboard-card">
                    <h2><i class="fa-regular fa-newspaper"></i>Content</h2>
                    <div class='content-detail'>
                        <div class='content-author col-l-6'>Content</div>
                        <?php
                            $user_sql = "SELECT count(*) as info FROM content";
                            $numContent = mysqli_query($connection,$user_sql);
                            $numContent = mysqli_fetch_assoc($numContent);
                            echo "<div class='content-author col-l-6'>".$numContent['info']."</div>";

                        ?>
                    </div>
                    
                    <div class='content-detail'>
                        <div class='content-author col-l-6'>Total</div>
                        <div class='content-author col-l-6'><?php echo $numContent['info']; ?></div>
                    </div>
                </div>
                
            </div>



        <div class="">

            <table class="table">
                <tr>
                    <th>No</th>
                    <th>User Info</th>
                    
                </tr>
                <?php
                $sql = "SELECT * FROM user WHERE role='user'";

                $record = mysqli_query($connection,$sql);
                
                
                for($i=0; $i<mysqli_num_rows($record); $i++){
                    $data = mysqli_fetch_assoc($record);
                    if(empty($data['image'])){
                        $img = "image/user_profile/default_user_profile.jpg";
                    }else{
                        $img = $data['image'];
                    }
                    $id = $data['id'];
                    echo "
                    <tr>
                        <td>".($i+1)."</td>
                        <td>
                            <div class='user-info'>
                                <img src='../$img' alt=''>
                                <small><b>Name:</b>".$data['fname']." ".$data['lname']."</small>
                                <small><b>Email:</b>".$data['email']."</small>
                                <small><b>Phone:</b>".$data['phone_number']."</small>
                                <small><b>Country:</b>".$data['country']."</small>
                                <small><b>Country:</b>".$data['gender']."</small>
                            </div>
                        </td>
                        
                        
                    </tr>
                    ";
                }

                ?>


            </table>
        </div>

    </div>

    <?php
        }else{
            echo "<script>window.location = '../login.php';</script>";
        }
    ?>
    <script src="../js/script.js"></script>
</body>

</html>