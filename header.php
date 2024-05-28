<?php
    include('database/dbconnection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- style css link -->
    <link rel="stylesheet" href="css/style.css?<?php echo time(); ?>">
    <script type="text/javscript" src="/script.js"></script>
    <!-- font awesome cdn link -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"
    /> -->
</head>

<body>
    <header>
    <?php
            if(empty($_SESSION['user']))
            {
        ?>
        <div class="heading">
            <div class="logo col-l-6 col-m-6 col-s-6">
                <img src="image/slide-show/smc-logo.jpg" class="logo-img" alt="logo"><span>Social Hub</span>
            </div>
            
            <div class="btn-group col-l-6 col-m-6 col-s-6">
                
            <div class="register_login_gp">
                    <a href="register.php" class="btn">Register</a>
                    <a href="login.php" class="btn">Log In</a>
                </div>
                <div id="google_translate_element"></div>

            </div>

        </div>

        <?php
            }else{
        ?>
        <div class="heading">
            <div class="logo col-l-6 col-m-6 col-s-6">
                <img src="image/slide-show/smc-logo.jpg" class="logo-img" alt="logo"><span>Social Hub</span>
            </div>
            <div class="btn-group col-l-6 col-m-6 col-s-6">
                <div class="user-profile">
                    <div class="profile">
                        <?php
                            if(empty($record['image'])){
                                echo "<img src='image/user_profile/default_user_profile.jpg' class='profile-img'>"; 
                            }else{
                                echo "<img src='".$record['image']."' class='profile-img'> ";
                            }

                        ?>
                        <a href=""><?php echo $username ?></a>
                    </div>
                    <div class="profile-active">
                        <a href="user_profile.php"><i class="fa-solid fa-user"></i>Profile</a>
                        <a href="user_profile_edit.php"><i class="fa-solid fa-pen"></i>Update Profile</a>
                        <a href="change_password.php"><i class="fa-solid fa-key"></i>Change Pssword</a>
                    </div>
                </div>

                <!-- <a href="logout.php" class="btn"><i class="fa-solid fa-right-from-bracket"></i>Log out</a> -->
                <div id="google_translate_element"></div>
            </div>
            
        </div>
        <?php
            }
        ?>
        <nav class="navbar">
            <ul>
                <li>
                    <a href="index.php"><i class="fa-solid fa-house"></i><span class="nav-item">Home</span></a>
                </li>
                <li class="dropdown-menu">
                    <div class="menu-title">
                        <a href="#">
                            <i class="fa-regular fa-newspaper"></i>
                            <span class="nav-item">Sharing</span>
                            <i class="fa-solid fa-chevron-down"></i>
                        </a>
                        
                    </div>
                    <div class="menu-list">
                        <a href="information.php?category=1">
                            <i class="fa-solid fa-circle-info"></i>
                            <span class="nav-item">Information</span>
                        </a>
                        <a href="livestreaming.php?category=4">
                            <i class="fa-solid fa-tower-broadcast"></i>
                            <span class="nav-item">Live Stream</span>
                        </a>
                        <a href="guidance.php?category=5">
                            <i class="fa-solid fa-shield-halved"></i>
                            <span class="nav-item">Guide</span>
                        </a>
                    </div>
                </li>
                <li>
                    <a href="popular_social_media.php?category=2"><i class="fa-solid fa-icons"></i><span class="nav-item">Social Media App</span></a>
                </li>
                <li>
                    <a href="parent_caring.php?category=3"><i class="fa-solid fa-hands-holding-child"></i><span class="nav-item">Parent Section</span></a>
                </li>
                <li>
                    <a href="contact.php"><i class="fa-solid fa-comment"></i><span class="nav-item">Contact</span></a>
                </li>
                <?php
                if(empty($_SESSION['user']))
                {
                ?>

                    <li>
                    
                        <a href="register.php" class="register_login_gp"><i class="fa-solid fa-user-plus"></i><span class="nav-item">Register</span></a>
                        
                    </li>
                    <li>
                        
                        <a href="login.php" class="register_login_gp"><i class="fa-solid fa-right-to-bracket"></i><span class="nav-item">Log In</span></a>
                        
                    </li>
                <?php
                }else{
                ?>   
                    <div class="user-profile">
                    <div class="profile">
                        <?php
                            if(empty($record['image'])){
                                echo "<img src='image/user_profile/default_user_profile.jpg' class='profile-img'>"; 
                            }else{
                                echo "<img src='".$record['image']."' class='profile-img'> ";
                            }

                        ?>
                        <a href="#" ><span ><?php echo $username ?></span></a>
                    </div>
                    <div class="profile-active">
                        <a href="user_profile.php"><i class="fa-solid fa-user"></i>Profile</a>
                        <a href="user_profile_edit.php"><i class="fa-solid fa-pen"></i>Update Profile</a>
                        <a href="change_password.php"><i class="fa-solid fa-key"></i>Change Pssword</a>
                    </div>
                </div> 
                    <li>
                        <a href='logout.php'>
                            <i class='fa-solid fa-right-from-bracket'></i><span class='nav-item'>Log out</span>
                        </a>
                    </li>
                <?php    
                }
                ?>
            </ul>
        </nav>
    </header>
    <div class="">
        
    </div>
    <script type="text/javascript">
    function googleTranslateElementInit() 
    {
        new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.Vertical}, 'google_translate_element');
    }
    let menuItem = document.querySelectorAll('.navbar li');

menuItem.forEach((item) => {

    item.addEventListener('click', () => {

        let active = item.classList.contains('active');

        menuItem.forEach((el) => {
            el.classList.remove('active');
        });
        if (active) item.classList.remove('active');
        else item.classList.add('active');
    });
});


    </script>

</body>
<script type="text/javascript" 
    src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
</script>
</html>

<!-- remaing list 
User Profile edit
User Home page (slidshow+ some info)
Policy generate -->

