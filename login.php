<?php
    session_start();
    include('database/dbconnection.php');
    $counter = 0;
    if(isset($_POST['login'])){
            
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        if(isset($_SESSION['login_counter'])){
            $counter = $_SESSION['login_counter'];
            if($counter==2){
                echo "<script>window.location='login_fail.php'</script>";
                setcookie('loginFail','fail',time()+600);
            }
        }
        if(empty($username)){
            $error['username'] = "Username is required!";
        }else if(empty($password)){
            $error['pwd'] = "Password is required!";
        }
        else{
            if(isset($_POST['g-recaptcha-response']))
            $captcha=$_POST['g-recaptcha-response'];

            if(!$captcha){
                echo "<script>alert('Please check the reCaptcha form!');</script>";
                echo "<script>window.location='login.php';</script>";
            }
            $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LdnyoIpAAAAAC_cvLz13pUjJZBfTJzVWjSnc98Y&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);


            if($response['success'] == false)
            {
                echo "<script>alert('You are a spammer!');</script>";
                echo "<script>window.location='login.php';</script>";
            }
            $query = "SELECT * FROM user WHERE username = '$username'";
            $data = mysqli_query($connection,$query);
            if(mysqli_num_rows($data)>0){
                $record = mysqli_fetch_assoc($data);
                $hash_pwd = $record['password'];
                // echo $hash_pwd. " " . mysqli_num_rows($data);
                if(password_verify($password,$hash_pwd)){
                    // echo "password mathch ".$record['role'];
                    if($record['role'] == 'admin'){
                        $_SESSION['admin'] = $username;
                        echo "<script>
                                alert('Login Successfully!!')
                                window.location = 'admin/dashboard.php';
                            </script>";
                    }else{
                        $_SESSION['user'] = $username;
                        echo "<script>
                                alert('Login Successfully!!')
                                window.location = 'index.php';
                            </script>";
                        
                        // echo "login success";
                    }
                }else{
                    echo  "<script>alert('Incorrect username and password!')</script>";
                    $counter++;
                    $_SESSION['login_counter'] = $counter;
                }
            }else{
                $counter++;
                $_SESSION['login_counter'] = $counter;
                echo  "<script>alert('Incorrect username and password!')</script>";
            }
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/style.css?<?php time(); ?>">

    <!-- Google recaptcha  
    <script src="https://www.google.com/recaptcha/enterprise.js?render=6LemNYEpAAAAAO7fnhIWzMD5oZoGzDfXuxRpasUj"></script>
  Your code -->

    <!-- reCAPTCHA  key -->
    <script src='https://www.google.com/recaptcha/api.js'></script>

</head>
<body>
        <?php
            if(isset($_COOKIE['loginFail'])){
                echo "<div class='form-container'>
                <div class='sub-header col-l-12 col-m-12 col-s-12'>
                        <h1>Login Fail</h1>
                </div>
                <div id='login-fail-timer'><h2>Suspicous Login! Block for 10 minutes. Try again later.</h2></div>
            </div>";
            }else{

        ?>
        <div class="form-container">
            <div class="sub-header col-l-12 col-m-12 col-s-12">
                <h2>Login</h2>
            </div>
            <form action="login.php" method="post">
                <div class="form-content">
                    <label>Username</label>
                    <input type="text" class="form-input" name="username" value="<?php if(isset($_POST['login'])){ echo $_POST['username'];}  ?>" placeholder="Enter username">
                    <?php
                        if(isset($error['username'])){
                            echo "<div class='error-msg'>".$error['username']."</div>";
                        }
                    ?>
                </div>
                <div class="form-content">
                    <label>Password</label>
                    <input type="password" class="form-input" name="password" placeholder="Enter Password">
                    <?php
                        if(isset($error['pwd'])){
                            echo "<div class='error-msg'>".$error['pwd']."</div>";
                        }
                    ?>
                </div>

                <div class="form-content">
                    <div class="g-recaptcha" data-sitekey="6LdnyoIpAAAAAJCTozKqw5YVACH1SvQml_enh-4l"></div>
                </div>

                <div class="from-content col-l-12 col-m-12 col-s-12">
                    <button type="submit" class="btn btnRegister" name="login">Login</button>
                </div>
                <div class="form-content">
                    <span><small>You don't have an account? <a href="register.php">Register here</a></small></span>
                </div>
            </form>
        </div>

        <?php
            }
        ?>
    <?php

        


    ?>
</body>
<!-- <script>
  function onClick(e) {
    e.preventDefault();
    grecaptcha.enterprise.ready(async () => {
      const token = await grecaptcha.enterprise.execute('6LemNYEpAAAAAO7fnhIWzMD5oZoGzDfXuxRpasUj', {action: 'LOGIN'});
    });
  }
</script> -->

    <script src="https://www.google.com/recaptcha/enterprise.js?render=6LcxtZIjAAAAAEw_lBkQC1yJ14VtIdHYY5o8xm0U"></script>

</html>