<?php
    session_start();
    include('../database/dbconnection.php');
    if(isset($_SESSION['admin'])){
        $username=$_SESSION['admin'];
        $sql = "SELECT * FROM user WHERE username='$username'";
        $data = mysqli_query($connection,$sql);
        $record = mysqli_fetch_assoc($data); 
    }
    $id = $record['id'];
    $oldHashPwd = $record['password'];

    if(isset($_POST['changePwd'])){
        
        $oldPwd = trim($_POST['oldPwd']);
        $newPwd = trim($_POST['newPwd']);
        $cPwd = trim($_POST['cPwd']);
        
        
        // $agree = $_POST['agree'];


        
        if(empty($oldPwd)){
            $error['oldPwd'] = "Old password is required!";
        }else if(empty($newPwd)){
            $error['$newPwd'] = "New password is required!";
        }else if(empty($cPwd)){
            $error['cPwd'] = "Confirmed password is required!";
        }else{

            if(password_verify($oldPwd,$oldHashPwd)){
                if($newPwd!=$cPwd){
                    $error['match'] = "Password and confirm password must be match!";
                }else if(strlen($newPwd)<8){
                    $error['msg'] = "Password must contain 8 character!";
                }else{
                    $hash_pwd = password_hash($newPwd,PASSWORD_DEFAULT);
                    $sql = "UPDATE user SET password='$hash_pwd' WHERE id='$id'";
                
                    if(mysqli_query($connection,$sql)){
                        echo "<script>
                            alert('Update Password Successfully!! Login Again');
                            window.location = '../logout.php';
                        </script>";
                    
                }
                }
            }else{
                $error['wrongPwd'] = "You enter Wrong old password";
            }    
            
        }
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
    
    <div class="form-container">
            <div class="sub-header col-l-12 col-m-12 col-s-12">
                <h2>Login</h2>
            </div>
            <form action="" method="post">
                
                <div class="form-content">
                    <label>Old Password</label>
                    <input type="password" class="form-input" name="oldPwd" placeholder="Enter old password">
                    <?php
                        if(isset($error['oldPwd'])){
                            echo "<div class='error-msg'>".$error['oldPwd']."</div>";
                        }else if(isset($error['wrongPwd'])){
                            echo "<div class='error-msg'>".$error['wrongPwd']."</div>";
                        }
                    ?>
                </div>
                <div class="form-content">
                <label>Password</label>
                <input type="password" class="form-input" placeholder="Enter Password" name="newPwd">
                <?php
                    if(isset($error['pwd'])){
                        echo "<div class='error-msg'>".$error['pwd']."</div>";
                    }
                    if(isset($error['msg'])){
                        echo "<div class='error-msg'>".$error['msg']."</div>";
                    }
                ?>
            </div>
            <div class="form-content">
                <label>Comfimed Password</label>
                <input type="password" class="form-input" placeholder="Enter Comfimed Password" name="cPwd">
                <?php
                    if(isset($error['cPwd'])){
                        echo "<div class='error-msg'>".$error['cpwd']."</div>";
                    }
                    if(isset($error['match'])){
                        echo "<div class='error-msg'>".$error['match']."</div>";
                    }
                    
                ?>
            </div>


                <div class="from-content col-l-12 col-m-12 col-s-12">
                    <button type="submit" class="btn btnRegister" name="changePwd">Change Password</button>
                </div>
                
            </form>
    </div>

    <?php
        }else{
            echo "<script>window.location = '../login.php';</script>";
        }
    ?>
<script src='../js/script.js?<?php echo time(); ?>'></script>
</body>
</html>