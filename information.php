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
        <h2>Information</h2>
        <div>Details information of the social media campaigns and their aims and vision to keep teenagers safe online.</div>
    </div>
    <div class="container">
        
        
        <?php
            include('get_content_data.php');

        ?>
        <div class="card-container information">
            <div class="col-l-3 col-m-6 col-s-10">
                <div class="admin-card">
                    <h2>Our Teams</h2>
                    <div class="description">
                        SMC team members always try to provide the best services to members and users of SMC. We hope our content and information will be helpful and teenagers when they use social media.
                    </div>
                </div>
            </div>
            <div class="col-l-3 col-m-6 col-s-10">
                <div class="admin-card">
                    <h2>Our Aim</h2>
                    <div class="description">
                        Support and educate the teenagers how to stay safe on social media. We also aim to educate the parents providing tips how parents can help for the use of social media of their childern.
                    </div>
                </div>
            </div>
            <div class="col-l-3 col-m-6 col-s-10">
                <div class="admin-card">
                    <h2>Our Vision</h2>
                    <div class="description">
                        Everythigs has its pros and cons. SMC team hope the teenagers can use social media effectively and they can apply the benefits of social media in their real life. 
                    </div>
                </div>
            </div>
            
            <div class="col-l-3 col-m-6 col-s-10">
                <div class="admin-card">
                    <h2>Our Mission</h2>
                    <div class="description">
                        Provide a save environment for teenagers when they use social media. The appropriate solutions will be provied to teenagers for cyber-crimes and encourage them. 
                    </div>
                </div>
            </div>
        </div>
        <div class="unplugged-video">
            <div class="sub-header col-l-12 col-m-12 col-s-12">
                <h3>Vlogs</h3>
            </div>
            <div class="vlog col-l-5 col-m-5 col-s-12">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/aO858HyFbKI?si=EP8m0Il54_N00xVl" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
            <div class="vlog col-l-5 col-m-5 col-s-12">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/pXDmZR9y0eo?si=8gq4ZuemQ5nWQJ_4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>

        </div>
    </div>
    
    <?php
        include('footer.php');
    ?>
    


    <script type="text/javascript" 
        src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>
    <script>
        document.getElementById('you-here').innerHTML = "<p>You are at <b>Information</b></p>";
    </script>

</body>

</html>