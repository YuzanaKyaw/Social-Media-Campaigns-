<?php
    session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Fail</title>
    <link rel="stylesheet" href="css/style.css?<?php time(); ?>">
</head>

<body>
    <div class="form-container">
        <div class="sub-header col-l-12 col-m-12 col-s-12">
                <h1>Login Fail</h1>
        </div>
        <div id="login-fail-timer"></div>
    </div>
    

    <script type="text/javascript">
    var month = new Date().getMonth() + 1;
    var day = new Date().getDate();
    var year = new Date().getFullYear();
    var hour = new Date().getHours();
    var minutes = new Date().getMinutes() + 10; //10 minutes
    var second = new Date().getSeconds() + 2;
    var time = hour + ":" + minutes + ":" + second;

    var ResetTime = new Date(month + " " + day + ", " + year + " " + time).getTime();

    var x = setInterval(function() {

        var now = new Date().getTime();
        var distance = ResetTime - now;

        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("login-fail-timer").innerHTML = "<h2>Suspicous Login! Block for 10 minutes.</h2><h3>" + minutes + "m " + seconds +
            "s </h3>";


        if (distance < 0) {
            clearInterval(x);
            document.getElementById("login-fail-timer").innerHTML = "<?php session_destroy();  ?>";
            window.location.href = 'login.php';
        }
    }, 1000); //1 sec = 1000 milisecond
    </script>

</body>

</html>