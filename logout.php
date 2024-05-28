<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    session_destroy();
    // echo "Logout Successfully!!";
    
    echo "<script>
            alert('Logout Successfully!!');
            window.location='index.php';
        </script>";
?>
</body>
</html>