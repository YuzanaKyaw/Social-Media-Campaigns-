<?php
    include('database/dbconnection.php');

    if(isset($_POST['register'])){
        
        $fname = trim($_POST['fname']);
        $lname = trim($_POST['lname']);
        $email = trim($_POST['email']);
        $country = $_POST['country'];
        $phone = $_POST['phone'];
        if(isset($_POST['gender'])){
            $gender = $_POST['gender'];
        }
        $username = $_POST['username'];
        $password = mysqli_real_escape_string($connection,$_POST['pwd']) ;
        $confirmpwd = $_POST['cpwd'];
        // $agree = $_POST['agree'];

       
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
        }else if(empty($password)){
            $error['pwd'] = "Password is required!";
        }else if(empty($confirmpwd)){
            $error['cpwd'] = "Confirm password is required!";
        }else if($password != $confirmpwd){
            $error['match'] = "Password and confirm password must be match!";
        }else{
            $query = "SELECT * FROM user WHERE username = '$username'";
            $data = mysqli_query($connection,$query);
            if(mysqli_num_rows($data)>0){
                $error['username']= "Username has been already existed. Choose the different one!";
            }else if(strlen($password)<8){
                $error['msg'] = "Password must contain 8 character!";
            }else{
                $hash_pwd = password_hash($password,PASSWORD_DEFAULT);
                $sql = "INSERT INTO user (fname,lname,email,gender,phone_number,country,username,password,role)
                        VALUES ('$fname','$lname', '$email','$gender','$phone','$country','$username','$hash_pwd','user')";
                
                if(mysqli_query($connection,$sql)){
                    echo "<script>
                            alert('Register Successfully!!');
                            window.location= 'login.php';
                        </script>";
                    
                }
            }
        }
    }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="css/style.css?<?php echo time(); ?>">
</head>

<body>

    <div class="form-container">
        <div class="sub-header col-l-12 col-m-12 col-s-12">
            <h2>Register</h2>
        </div>
        <form action="register.php" method="post">
            <div class="form-content">
                <label>First Name</label>
                <input type="text" class="form-input" value="<?php if(isset($_POST['register'])){ echo $_POST['fname'];}  ?>" placeholder="Enter First Name" name="fname">
                <?php
                    if(isset($error['fname'])){
                        echo "<div class='error-msg'>".$error['fname']."</div>";
                    }
                ?>
            </div>
            <div class="form-content">
                <label>Last Name</label>
                <input type="text" class="form-input" value="<?php if(isset($_POST['register'])){ echo $_POST['lname'];}  ?>" placeholder="Enter Last Name" name="lname">
                <?php
                    if(isset($error['lname'])){
                        echo "<div class='error-msg'>".$error['lname']."</div>";
                    }
                ?>
            </div>
            <div class="form-content">
                <label>Email</label>
                <input type="email" class="form-input" value="<?php if(isset($_POST['register'])){ echo $_POST['email'];}  ?>" placeholder="example@gmail.com" name="email">
                <?php
                    if(isset($error['email'])){
                        echo "<div class='error-msg'>".$error['email']."</div>";
                    }
                ?>
            </div>
            <div class="form-content">
                <label>Phone Number</label>
                <input type="text" class="form-input" value="<?php if(isset($_POST['register'])){ echo $_POST['phone'];}  ?>" placeholder="09xxxxxxxxx" name="phone">
                <?php
                    if(isset($error['phone'])){
                        echo "<div class='error-msg'>".$error['phone']."</div>";
                    }
                ?>
            </div>
            <div class="form-content">
                <label>Gender</label> <br>
                <input type="radio" class="form-radio" name="gender" id="" value="male"><span>Male</span> <br>
                <input type="radio" class="form-radio" name="gender" id="" value="female"><span>Female</span> <br>
                <input type="radio" class="form-radio" name="gender" id="" value="other"><span>Other</span> <br>
                <?php
                    if(isset($error['gender'])){
                        echo "<div class='error-msg'>".$error['gender']."</div>";
                    }
                ?>
            </div>
            <div class="form-content">
                <select name="country" class="form-input">
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
                        echo "<option value='$country'>$country</option>";
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
                <input type="text" class="form-input" value="<?php if(isset($_POST['register'])){ echo $_POST['username'];}  ?>" placeholder="Enter username" name="username">
                <?php
                    if(isset($error['username'])){
                        echo "<div class='error-msg'>".$error['username']."</div>";
                    }
                ?>
            </div>
            <div class="form-content">
                <label>Password</label>
                <input type="password" class="form-input" placeholder="Enter Password" name="pwd">
                <?php
                    if(isset($error['pwd'])){
                        echo "<div class='error-msg'>".$error['pwd']."</div>";
                    }
                ?>
            </div>
            <div class="form-content">
                <label>Comfimed Password</label>
                <input type="password" class="form-input" placeholder="Enter Comfimed Password" name="cpwd">
                <?php
                    if(isset($error['cpwd'])){
                        echo "<div class='error-msg'>".$error['cpwd']."</div>";
                    }
                    if(isset($error['match'])){
                        echo "<div class='error-msg'>".$error['match']."</div>";
                    }
                ?>
            </div>
            
            <!-- <div class="form-content">
                <input type="checkbox" name="agree"> <span><small>I agree the terms and policy</small></span>
            </div> -->
            <div class="from-content col-l-12 col-m-12 col-s-12">
                <input type="submit" value="Register" name="register" class="btn btnRegister">
                <!-- <button type="submit" name="register" class="btn btnRegister">Register</button> -->
            </div>
        </form>
        <div class="form-content">
            <span><small>Already have and account? <a href="login.php">Log in here</a></small></span>
        </div>
    </div>

</body>

</html>