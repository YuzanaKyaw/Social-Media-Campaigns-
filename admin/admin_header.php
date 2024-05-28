<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- style css link -->
    <link rel="stylesheet" href="../css/style.css?<?php echo time(); ?>">
    <!-- font awesome cdn link -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/> -->
</head>

<body>
    <header>
        <div class="admin-heading ">
            <div class="logo col-l-6 col-m-6 col-s-4">
                <span>Social Hub</span>
            </div>
            
            <div class="btn-group col-l-6 col-m-6 col-s-8">
                
                <div class="user-profile">
                    <div class="profile">
                        <?php
                    if(empty($record['image'])){
                        echo "<img src='../image/user_profile/default_user_profile.jpg' class='profile-img'>"; 
                    }else{
                        echo "<img src='".$record['image']."' class='profile-img'> ";
                    }

                    ?>
                        <a href=""><?php echo $username ?></a>
                    </div>
                    <div class="profile-active">
                        <a href="admin_profile.php"><i class="fa-solid fa-user"></i>Profile</a>
                        <a href="edit_profile.php"><i class="fa-solid fa-pen"></i>Update Profile</a>
                        <a href="admin_password_change.php"><i class="fa-solid fa-key"></i>Change Pssword</a>
                    </div>
                </div>

                <div id="google_translate_element"></div>
                <button type="button" id="nav-toogle" class="btn">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </div>
        <nav class="admin-navbar">
            <ul>
                
                <li>
                    <a href="dashboard.php">
                        <i class="fa-solid fa-chart-pie"></i>
                        <span class="nav-item">Dashboard</span>
                    </a>
                </li>
                <li class="dropdown-menu">
                    <div class="menu-title">
                        <a href="#">
                            <i class="fa-solid fa-layer-group"></i>
                            <span class="nav-item">Category</span>
                            <i class="fa-solid fa-chevron-down"></i>
                        </a>
                        
                    </div>
                    <div class="menu-list">
                        <a href="create_category.php">
                            <i class="fa-solid fa-square-plus"></i>
                            <span class="nav-item">Category Create</span>
                        </a>
                        
                    </div>
                </li>
                <li class="dropdown-menu">
                    <div class="menu-title">
                        <a href="#">
                            <i class="fa-regular fa-newspaper"></i>
                            <span class="nav-item">Content</span>
                            <i class="fa-solid fa-chevron-down"></i>
                        </a>
                        
                    </div>
                    <div class="menu-list">
                        <a href="create_content.php">
                            <i class="fa-solid fa-square-plus"></i>
                            <span class="nav-item">Content Create</span>
                        </a>
                        <a href="content_lists.php">
                            <i class="fa-solid fa-clipboard-list"></i>
                            <span class="nav-item">Content List</span>
                        </a>
                        
                    </div>
                </li>
                
                <li>
                    <a href="contact_message.php">
                        <i class="fa-solid fa-comment"></i>
                        <span class="nav-item">Contact Message</span>
                    </a>
                </li>
                <li>
                <div class="user-profile">
                    <div class="profile">
                        <?php
                    if(empty($record['image'])){
                        echo "<img src='../image/user_profile/default_user_profile.jpg' class='profile-img'>"; 
                    }else{
                        echo "<img src='".$record['image']."' class='profile-img'> ";
                    }

                    ?>
                        <a href=""><?php echo $username ?></a>
                    </div>
                    <div class="profile-active">
                        <a href="admin_profile.php"><i class="fa-solid fa-user"></i>Profile</a>
                        <a href="edit_profile.php"><i class="fa-solid fa-pen"></i>Update Profile</a>
                        <a href="admin_change_password.php"><i class="fa-solid fa-key"></i>Change Pssword</a>
                    </div>
                </div>
                </li>
                <li>
                    <a href="../logout.php">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span class="nav-item">Log out</span>
                    </a>
                </li>
            </ul>
        </nav>
    </header>
    
    
<script type="text/javascript" src="../js/script.js?<?php echo time(); ?>"></script>
<script type="text/javascript" 
    src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
</script>

</body>

</html>