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
    <div class="page-intro">
        <h2>Most Popular Social Media Apps</h2>
        <div>Details information of the social media applications. Tips for teenagers how to use them effectively and stay safe online.</div>
    </div>
    <div class="container">
        
        <?php
            include('get_content_data.php');

        ?>
    </div>
    

    <?php
        include('footer.php');
    ?>


    <script type="text/javascript" 
        src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>
    <script>
        document.getElementById('you-here').innerHTML = "<p>You are at <b>Popular social media</b></p>";
    </script>

</body>

</html>