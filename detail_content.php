<?php
    include('database/dbconnection.php');
    $contentId = $_GET['content'];
    session_start();
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
    <title>Popular Social Media App</title>
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
            $sql = "SELECT * FROM content WHERE content_id='$contentId'";
            $record = mysqli_query($connection,$sql);
            $data = mysqli_fetch_assoc($record);
            echo "<div class='content'>
                <h1>".$data['title']."</h1>
                <div class='content-detail'>    
                    <div class='content-author col-l-6'>".$data['author']."</div>
                    <div class='content-author col-l-6'>".$data['created_at']."</div>       
                </div>
                <img src='".substr($data['image'],3)."' alt=''>
                <div class='main-content'>".$data['main_content']."</div>
                
            </div>";

        ?>
        


    </div>

    <!-- <div class='content-detail'>    
                            <div class='content-author col-l-6'>".$data['author']."</div>
                            <div class='content-date col-l-6'>".$date."</div>
                        </div> -->

</body>

</html>