<?php

    session_start();
    include('database/dbconnection.php');
    if(isset($_SESSION['user'])){
        $username=$_SESSION['user'];
        $sql = "SELECT * FROM user WHERE username='$username'";
        $data = mysqli_query($connection,$sql);
        $record = mysqli_fetch_assoc($data); 
    }
    $id = $record['id'];
    if(isset($_POST['updateProfile'])){
        
        $fname = trim($_POST['fname']);
        $lname = trim($_POST['lname']);
        $email = trim($_POST['email']);
        $country = $_POST['country'];
        $phone = $_POST['phone'];
        if(isset($_POST['gender'])){
            $gender = $_POST['gender'];
        }
        $username = $_POST['username'];
        
        // $agree = $_POST['agree'];


        if(is_uploaded_file($_FILES['profileImg']['tmp_name'])){
            $profileImg = $_FILES['profileImg']['name'];
            $profile_tmp_name = $_FILES['profileImg']['tmp_name'];
            $path="image/user_profile/".$profileImg;
            
            copy($profile_tmp_name,$path);
            if($record['image']!=null){
                $oldImg = $record['image'];
                unlink($oldImg);
            }
            

        }else{
            $path = $record['image'];
        }
        if(empty($fname)){
            $error['fname'] = "First name is required!";
        }else if(empty($lname)){
            $error['lname'] = "Last name is required!";
        }else if(empty($email)){
            $error['email'] = "Email is required!";
        }else if(empty($phone)){
            $error['phone'] = "Phone is required!";
        }else if(empty($gender)){
            $error['gender'] = "Gender is required!";
        }else if(empty($country)){
            $error['country'] = "Country is required!";
        }else if(empty($username)){
            $error['username'] = "Username is required!";
        }else{
            // $query = "SELECT * FROM user WHERE username = '$username'";
            // $data = mysqli_query($connection,$query);
            // if(mysqli_num_rows($data)>0){
            //     $error['username']= "Username has been already existed. Choose the different one!";
            // }else{
                
                
            // }
            $sql = "UPDATE user SET fname='$fname',lname='$lname',email='$email',
                gender='$gender',phone_number='$phone',country='$country',username='$username',image='$path'
                WHERE id='$id'";
                
                if(mysqli_query($connection,$sql)){
                    echo "<script>
                            alert('Update Successfully!!');
                            window.location = 'user_profile.php';
                        </script>";
                    
                }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
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
    

       
    <?php
        if(isset($_SESSION['user']))
        {
            
        
    ?>
    <div class="form-container">
        <div class="sub-header col-l-12 col-m-12 col-s-12">
            <h2>Update</h2>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-content">
                <label>First Name</label>
                <input type="text" class="form-input" value="<?php echo $record['fname']; ?>" placeholder="Enter First Name" name="fname">
                <?php
                    if(isset($error['fname'])){
                        echo "<div class='error-msg'>".$error['fname']."</div>";
                    }
                ?>
            </div>
            <div class="form-content">
                <label>Last Name</label>
                <input type="text" class="form-input" value="<?php echo $record['lname']; ?>" placeholder="Enter Last Name" name="lname">
                <?php
                    if(isset($error['lname'])){
                        echo "<div class='error-msg'>".$error['lname']."</div>";
                    }
                ?>
            </div>
            <div class="form-content">
                <label for="">Profile Image</label>
                <?php
                    if(empty($record['image'])){
                        echo "<img src='image/user_profile/default_user_profile.jpg'>";
                    }else{
                        echo "<img src='".$record['image']."'>";
                    }

                ?>
            
                <input type="file" class="form-input form-img" name="profileImg" id="">
            </div>
            <div class="form-content">
                <label>Email</label>
                <input type="email" class="form-input" value="<?php  echo $record['email']; ?>" placeholder="example@gmail.com" name="email">
                <?php
                    if(isset($error['email'])){
                        echo "<div class='error-msg'>".$error['email']."</div>";
                    }
                ?>
            </div>
            <div class="form-content">
                <label>Phone Number</label>
                <input type="text" class="form-input" value="<?php echo $record['phone_number']; ?>" placeholder="09xxxxxxxxx" name="phone">
                <?php
                    if(isset($error['phone'])){
                        echo "<div class='error-msg'>".$error['phone']."</div>";
                    }
                ?>
            </div>
            <div class="form-content">
                <label>Gender</label> <br>
                <?php
                    if($record['gender']=='male'){
                        echo "
                        <input type='radio' class='form-radio' name='gender' checked value='male'><span>Male</span> <br>
                        <input type='radio' class='form-radio' name='gender' value='female'><span>Female</span> <br>
                        <input type='radio' class='form-radio' name='gender' value='other'><span>Other</span> <br>
                        ";
                    }else if($record['gender']=='female'){
                        echo "
                        <input type='radio' class='form-radio' name='gender' value='male'><span>Male</span> <br>
                        <input type='radio' class='form-radio' name='gender' checked value='female'><span>Female</span> <br>
                        <input type='radio' class='form-radio' name='gender' value='other'><span>Other</span> <br>
                        ";
                    }else{
                        echo "
                        <input type='radio' class='form-radio' name='gender' value='male'><span>Male</span> <br>
                        <input type='radio' class='form-radio' name='gender' value='female'><span>Female</span> <br>
                        <input type='radio' class='form-radio' name='gender' checked value='other'><span>Other</span> <br>
                        ";
                    }

                    if(isset($error['gender'])){
                        echo "<div class='error-msg'>".$error['gender']."</div>";
                    }
                ?>
                
                
            </div>
            <div class="form-content">
                <select name="country" class="form-input" >
                    <option value="">Choose your country</option>
                    <?php
                    $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", 
                                        "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda",
                                        "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", 
                                        "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", 
                                        "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", 
                                        "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", 
                                        "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", 
                                        "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", 
                                        "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", 
                                        "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", 
                                        "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", 
                                        "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", 
                                        "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", 
                                        "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", 
                                        "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", 
                                        "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", 
                                        "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", 
                                        "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", 
                                        "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", 
                                        "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", 
                                        "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", 
                                        "North Korea", "South Korea", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", 
                                        "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", 
                                        "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", 
                                        "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", 
                                        "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", 
                                        "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", 
                                        "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", 
                                        "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", 
                                        "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", 
                                        "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", 
                                        "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", 
                                        "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", 
                                        "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", 
                                        "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", 
                                        "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", 
                                        "South Africa", "South Georgia and the South Sandwich Islands", "Spain", 
                                        "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", 
                                        "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", 
                                        "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", 
                                        "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", 
                                        "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", 
                                        "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", 
                                        "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", 
                                        "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", 
                                        "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
                    
                    foreach($countries as $country){
                        if($record['country']==$country)
                            echo "<option value='$country' selected >$country</option>";
                        else {
                            echo "<option value='$country'>$country</option>";
                        }
                    }


                    ?>
                </select>
                <?php
                    if(isset($error['country'])){
                        echo "<div class='error-msg'>".$error['country']."</div>";
                    }
                ?>
            </div>
            <div class="form-content">
                <label>Username</label>
                <input type="text" class="form-input" value="<?php echo $record['username']  ?>" placeholder="Enter username" name="username">
                <?php
                    if(isset($error['username'])){
                        echo "<div class='error-msg'>".$error['username']."</div>";
                    }
                ?>
            </div>
            
            
            
            <!-- <div class="form-content">
                <input type="checkbox" name="agree"> <span><small>I agree the terms and policy</small></span>
            </div> -->
            <div class="from-content col-l-12 col-m-12 col-s-12">
                <input type="submit" value="Update Profile" name="updateProfile" class="btn btnRegister">
                <!-- <button type="submit" name="register" class="btn btnRegister">Register</button> -->
            </div>
        </form>
        
    </div>

    <?php
        }else{
            echo "<script>window.location = 'login.php';</script>";
        }
    ?>

    

    


    <script type="text/javascript" 
        src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
    </script>
    <script>
        document.getElementById('you_here').innerHTML = "<p>You are at <b>Popular social media</b></p>";
    </script>

</body>

</html>