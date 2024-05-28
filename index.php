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
    <title>Document</title>
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

    <div class="container custom-cursor">
        <div class="slide-show">
            <div class="slider">
                <div class="slide-item fade">
                    <img src="image/slide-show/teenagers-social-media.png" alt="teenagers and social media">
                    <div class="slide-description">
                        Tips for teenager how to use socical media safely.
                    </div>
                </div>
                <div class="slide-item fade">
                    <img src="image/slide-show/social-media-app.png" alt="social media app">
                    <div class="slide-description">Most popular social media nowadays and ways to stay safe on them
                    </div>
                </div>
                <div class="slide-item fade">
                    <img src="image/slide-show/teenagers-parent-caring.png" alt="parent caring">
                    <div class="slide-description">Tips that parents can use to support healthy teen use of social media
                    </div>
                </div>
                <div class="slide-item fade">
                    <img src="image/slide-show/live-stream-concept-1.jpg" alt="livestreaming">
                    <div class="slide-description">
                        Livestreaming and how it can be done in a safe environment
                    </div>
                </div>
                <div class="slide-item fade">
                    <img src="image/slide-show/giuidness.png" alt="Legislation and Guidance">
                    <div class="slide-description">The details of relevant legislation and best practice guidance
                        relating to online social media use</div>
                </div>
                <div class="slide-item fade">
                    <img src="image/slide-show/social-media-campaigns.jpg" alt="social media campaigns">
                    <div class="slide-description">The details of the social media campaigns</div>
                </div>
            </div>
        </div>

        <ul class="slide-nav">
            <li class='circle'></li>
            <li class='circle'></li>
            <li class='circle'></li>
            <li class='circle'></li>
            <li class='circle'></li>
            <li class='circle'></li>
        </ul>
    </div>
    <div class="container custom-cursor">
        <div class="smc-info">
            <div class="sub-info col-l-8 col-m-10 col-s-10">
                <h3>Spread Love and Support Each Other</h3>
                <div class="">
                    A complete guide for teenager how to use social media and stay safe online.
                    The details of relevant legislation and best practice guidance are also provided.
                </div>
            </div>
            <div class="col-l-8 col-m-10 col-s-12">
                <div class="info-card">
                    <h2>What we support?</h2>
                    <div class="explaination"><span>Ways to use social media safely</span></div>
                    <div class="explaination"><span>Mothly newsletters for members</span></div>
                    <div class="explaination"><span>How Parents Can Help</span></div>
                    <div class="explaination"><span>Sharing Information</span></div>
                    <div class="explaination"><span>Legislation and Guidance</span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
    <div class="card-container">
        <div class='sub-header col-l-12 col-m-12 col-s-12'>
            <h2>Top 5 Most Popular Social Media</h2>
        </div>
        <div class='app-card col-l-3 col-m-4 col-s-6'>
            <div class='card-header'>
                <img class='social-app-img' src='image/slide-show/facebook.jpg' alt=''>
            </div>
        </div>
        <div class='app-card col-l-3 col-m-4 col-s-6'>
            <div class='card-header'>
                <img class='social-app-img' src='image/slide-show/youtube.png' alt=''>
            </div>
        </div>
        <div class='app-card col-l-3 col-m-4 col-s-6'>
            <div class='card-header'>
                <img class='social-app-img' src='image/slide-show/instagram.png' alt=''>
            </div>
        </div>
        <div class='app-card col-l-3 col-m-4 col-s-6'>
            <div class='card-header'>
                <img class='social-app-img' src='image/slide-show/whatapp.png' alt=''>
            </div>
        </div>
        <div class='app-card col-l-3 col-m-4 col-s-6'>
            <div class='card-header'>
                <img class='social-app-img' src='image/slide-show/tiktok.png' alt=''>
            </div>
        </div>
    </div>
    </div>
    <div class="container">

        <div class="illustration3D">
            <img src="image/slide-show/beam-woman-sitting-at-desk-and-programming.gif" alt="">
            <div class="div">
                Illustration by <a href="https://icons8.com/illustrations/author/eEbrZFlkyZbD">Anna A</a> from <a
                    href="https://icons8.com/illustrations">Ouch!</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="location">
            <div class="sub-header col-l-12 col-m-12 col-s-12">
                <h3>Location</h3>
            </div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d61109.565733524054!2d96.05938564863277!3d16.809090500000014!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c1ebcafe604d07%3A0x26451fa071576c95!2sKMD%20Mobile%20%26%20IT%20Sales%20%26%20Service%20Center%20(Mega%20Store)!5e0!3m2!1sen!2smm!4v1692807755114!5m2!1sen!2smm"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
    <?php
        include('footer.php');
    ?>


    <script type="text/javascript"
        src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>
    <script src="js/script.js?<?php echo time(); ?>"></script>

    <script>
    document.getElementById('you-here').innerHTML = "<p>You are at <b>HOME</b></p>";
    let slideIndex = 0;
    showSlides();

    function showSlides() {
        let i;
        let slides = document.getElementsByClassName("slide-item");
        let dots = document.getElementsByClassName("circle");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {
            slideIndex = 1
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" slide-active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " slide-active";
        setTimeout(showSlides, 5000);
    }
    </script>
</body>

</html>