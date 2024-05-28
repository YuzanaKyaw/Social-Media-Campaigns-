<?php
    include('database/dbconnection.php');
    session_start();
    if(isset($_SESSION['user'])){
        $username = $_SESSION['user'];
        $sql = "SELECT * FROM user WHERE username='$username'";
        $data = mysqli_query($connection,$sql);
        $record = mysqli_fetch_assoc($data); 
    }
    if(isset($_POST['contact'])){
        
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $message = $_POST['message'];
        
       
        if(empty($fname)){
            $error['fname'] = "First name is required!";
        }else if(empty($lname)){
            $error['lname'] = "Last name is required!";
        }else if(empty($email)){
            $error['email'] = "Email is required!";
        }else{
            
            $sql = "INSERT INTO contact (fname,lname,email,phone,message)
                    VALUES ('$fname','$lname','$email','$phone','$message')";
            if(mysqli_query($connection,$sql)){
                echo "<script>
                        alert('Message Sent Successfully!!');
                        Window.location.href(contact.php);
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
    <title>Contact Page</title>
    <link rel="stylesheet" href="css/style.css?<?php echo time(); ?>">
</head>

<body>
    <header>
        <?php
        include('header.php')
    ?>
    </header>
    <div class="page-intro">
        <h2>Contact and Policy</h2>
        <div>Contact form where customers can send messages and feedbacks through the website.Provide Terms and Policy of website.</div>
    </div>

    <div class="form-container">
        <div class="sub-header col-l-12 col-m-12 col-s-12">
            <h2>Contact</h2>
        </div>
        <form action="contact.php" method="post">
            <div class="form-content">
                <label>First Name</label>
                <input type="text" class="form-input"
                    value="<?php if(isset($_POST['contact'])){ echo $_POST['fname'];}  ?>"
                    placeholder="Enter First Name" name="fname">
                <?php
                    if(isset($error['fname'])){
                        echo "<div class='error-msg'>".$error['fname']."</div>";
                    }
                ?>
            </div>
            <div class="form-content">
                <label>Last Name</label>
                <input type="text" class="form-input"
                    value="<?php if(isset($_POST['contact'])){ echo $_POST['lname'];}  ?>" placeholder="Enter Last Name"
                    name="lname">
                <?php
                    if(isset($error['lname'])){
                        echo "<div class='error-msg'>".$error['lname']."</div>";
                    }
                ?>
            </div>
            <div class="form-content">
                <label>Email</label>
                <input type="email" class="form-input"
                    value="<?php if(isset($_POST['contact'])){ echo $_POST['email'];}  ?>"
                    placeholder="example@gmail.com" name="email">
                <?php
                    if(isset($error['email'])){
                        echo "<div class='error-msg'>".$error['email']."</div>";
                    }
                ?>
            </div>
            <div class="form-content">
                <label>Phone Number</label>
                <input type="text" class="form-input"
                    value="<?php if(isset($_POST['contact'])){ echo $_POST['phone'];}  ?>" placeholder="09xxxxxxxxx"
                    name="phone">
                <?php
                    if(isset($error['phone'])){
                        echo "<div class='error-msg'>".$error['phone']."</div>";
                    }
                ?>
            </div>

            <div class="form-content">
                <label for="">Message</label>
                <textarea name="message" id="" class="form-input" cols="30" placeholder="Enter your message"
                    rows="10"></textarea>
            </div>



            <!-- <div class="form-content">
                <input type="checkbox" name="agree"> <span><small>I agree the terms and policy</small></span>
            </div> -->
            <div class="from-content col-l-12 col-m-12 col-s-12">
                <input type="submit" value="Submit" name="contact" class="btn btnRegister">
                <!-- <button type="submit" name="register" class="btn btnRegister">Register</button> -->
            </div>
        </form>

    </div>
    <div class="container">
        <div class="terms-conditions">
            <h1>TERMS AND CONDITIONS</h1>
            <h2>AGREEMENT TO OUR LEGAL TERMS</h2>
            <div class="term-description">
            We are Social Media Campaigns ('Company', 'we', 'us', or 'our'), a company registered in the United Kingdom.
            We operate the website SMC, as well as any other related products and services that refer or link to these legal terms (the 'Legal Terms') (collectively, the 'Services').
            <h3>Social Media Campaigns helps and supports to teenagers to encourage them to stay safe when using social media apps.</h3>
            You can contact us by phone at 1-800-536-678, email at smcampaigns@gmail.com, or by mail to United Kingdom.
            These Legal Terms constitute a legally binding agreement made between you, whether personally or on behalf of an entity ('you'), and Social Media Campaigns, concerning your access to and use of the Services. You agree that by accessing the Services, you have read, understood, and agreed to be bound by all of these Legal Terms. IF YOU DO NOT AGREE WITH ALL OF THESE LEGAL TERMS, THEN YOU ARE EXPRESSLY PROHIBITED FROM USING THE SERVICES AND YOU MUST DISCONTINUE USE IMMEDIATELY.
            We will provide you with prior notice of any scheduled changes to the Services you are using. The modified Legal Terms will become effective upon posting or notifying you by smcampaigns@gmail.com, as stated in the email message. By continuing to use the Services after the effective date of any changes, you agree to be bound by the modified terms.
            We recommend that you print a copy of these Legal Terms for your records.
            </div>
        </div>
        <div class="terms-conditions">
        <div class="table-content">
            <h2>Table of Content</h2>
            <div class="term-description">
                <ul>
                    <li><a href="#our-service">OUR SERVICES</a></li>
                    <li><a href="#user-representations">USER REPRESENTATIONS</a></li>
                    <li><a href="#user-registration">USER REGISTRATION</a></li>
                    <li><a href="#privacy-policy">PRIVACY POLICY</a></li>
                    <li><a href="#term-termination">TERM AND TERMINATION</a></li>
                    <li><a href="#guidelines-for-reviews">GUIDELINES FOR REVIEWS</a></li>
                    <li><a href="#disclaimer">DISCLAIMER</a></li>
                    <li><a href="#contact-us">CONTACT US</a></li>
                </ul>
            </div>
        </div>
        </div>
        <div class="terms-conditions">
            <div id="our-service">
                <h2>OUR SERVICES</h2>
                <div class="term-description">
                    The information provided when using the Services is not intended for distribution to or use by any person or entity in any jurisdiction or country where such distribution or use would be contrary to law or regulation or which would subject us to any registration requirement within such jurisdiction or country. Accordingly, those persons who choose to access the Services from other locations do so on their own initiative and are solely responsible for compliance with local laws, if and to the extent local laws are applicable.
                </div>
            </div>
        </div>
        <div class="terms-conditions">
            <div id="user-representations">
                <h2>USER REPRESENTATIONS</h2>
                <div class="term-description">
                    By using the Services, you represent and warrant that: (1) all registration information you submit will be true, accurate, current, and complete; (2) you will maintain the accuracy of such information and promptly update such registration information as necessary; (3) you have the legal capacity and you agree to comply with these Legal Terms; (4) you are not a minor in the jurisdiction in which you reside, or if a minor, you have received parental permission to use the Services; (5) you will not access the Services through automated or non-human means, whether through a bot, script or otherwise; (6) you will not use the Services for any illegal or unauthorised purpose; and (7) your use of the Services will not violate any applicable law or regulation.

                    If you provide any information that is untrue, inaccurate, not current, or incomplete, we have the right to suspend or terminate your account and refuse any and all current or future use of the Services (or any portion thereof).
                </div>
            </div>
        </div>
        <div class="terms-conditions">
            <div id="user-registration">
                <h2>USER REGISTRATION</h2>
                <div class="term-description">
                    You may be required to register to use the Services. You agree to keep your password confidential and will be responsible for all use of your account and password. We reserve the right to remove, reclaim, or change a username you select if we determine, in our sole discretion, that such username is inappropriate, obscene, or otherwise objectionable.

                </div>
            </div>
        </div>
        <div class="terms-conditions">
            <div id="privacy-policy">
                <h2>PRIVACY POLICY</h2>
                <div class="term-description">
                    We care about data privacy and security. Please review our Privacy Policy: By using the Services, you agree to be bound by our Privacy Policy, which is incorporated into these Legal Terms. Please be advised the Services are hosted in the United Kingdom. If you access the Services from any other region of the world with laws or other requirements governing personal data collection, use, or disclosure that differ from applicable laws in the United Kingdom, then through your continued use of the Services, you are transferring your data to the United Kingdom, and you expressly consent to have your data transferred to and processed in the United Kingdom.
                </div>
            </div>
        </div>
        <div class="terms-conditions">
            <div id="term-termination">
                <h2>TERM AND TERMINATION</h2>
                <div class="term-description">
                    These Legal Terms shall remain in full force and effect while you use the Services. WITHOUT LIMITING ANY OTHER PROVISION OF THESE LEGAL TERMS, WE RESERVE THE RIGHT TO, IN OUR SOLE DISCRETION AND WITHOUT NOTICE OR LIABILITY, DENY ACCESS TO AND USE OF THE SERVICES (INCLUDING BLOCKING CERTAIN IP ADDRESSES), TO ANY PERSON FOR ANY REASON OR FOR NO REASON, INCLUDING WITHOUT LIMITATION FOR BREACH OF ANY REPRESENTATION, WARRANTY, OR COVENANT CONTAINED IN THESE LEGAL TERMS OR OF ANY APPLICABLE LAW OR REGULATION. WE MAY TERMINATE YOUR USE OR PARTICIPATION IN THE SERVICES OR DELETE YOUR ACCOUNT AND ANY CONTENT OR INFORMATION THAT YOU POSTED AT ANY TIME, WITHOUT WARNING, IN OUR SOLE DISCRETION.

                    If we terminate or suspend your account for any reason, you are prohibited from registering and creating a new account under your name, a fake or borrowed name, or the name of any third party, even if you may be acting on behalf of the third party. In addition to terminating or suspending your account, we reserve the right to take appropriate legal action, including without limitation pursuing civil, criminal, and injunctive redress.


                </div>
            </div>
        </div>
        <div class="terms-conditions">
            <div id="guidelines-for-reviews">
                <h2>GUIDELINES FOR REVIEWS</h2>
                <div class="term-description">
                We may provide you areas on the Services to leave reviews or ratings. When posting a review, you must comply with the following criteria: (1) you should have firsthand experience with the person/entity being reviewed; (2) your reviews should not contain offensive profanity, or abusive, racist, offensive, or hateful language; (3) your reviews should not contain discriminatory references based on religion, race, gender, national origin, age, marital status, sexual orientation, or disability; (4) your reviews should not contain references to illegal activity; (5) you should not be affiliated with competitors if posting negative reviews; (6) you should not make any conclusions as to the legality of conduct; (7) you may not post any false or misleading statements; and (8) you may not organise a campaign encouraging others to post reviews, whether positive or negative.

                We may accept, reject, or remove reviews in our sole discretion. We have absolutely no obligation to screen reviews or to delete reviews, even if anyone considers reviews objectionable or inaccurate. Reviews are not endorsed by us, and do not necessarily represent our opinions or the views of any of our affiliates or partners. We do not assume liability for any review or for any claims, liabilities, or losses resulting from any review. By posting a review, you hereby grant to us a perpetual, non-exclusive, worldwide, royalty-free, fully paid, assignable, and sublicensable right and licence to reproduce, modify, translate, transmit by any means, display, perform, and/or distribute all content relating to review.

                </div>
            </div>
        </div>
        <div class="terms-conditions">
            <div id="disclaimer">
                <h2>DISCLAIMER</h2>
                <div class="term-description">
                    THE SERVICES ARE PROVIDED ON AN AS-IS AND AS-AVAILABLE BASIS. YOU AGREE THAT YOUR USE OF THE SERVICES WILL BE AT YOUR SOLE RISK. TO THE FULLEST EXTENT PERMITTED BY LAW, WE DISCLAIM ALL WARRANTIES, EXPRESS OR IMPLIED, IN CONNECTION WITH THE SERVICES AND YOUR USE THEREOF, INCLUDING, WITHOUT LIMITATION, THE IMPLIED WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, AND NON-INFRINGEMENT. WE MAKE NO WARRANTIES OR REPRESENTATIONS ABOUT THE ACCURACY OR COMPLETENESS OF THE SERVICES' CONTENT OR THE CONTENT OF ANY WEBSITES OR MOBILE APPLICATIONS LINKED TO THE SERVICES AND WE WILL ASSUME NO LIABILITY OR RESPONSIBILITY FOR ANY (1) ERRORS, MISTAKES, OR INACCURACIES OF CONTENT AND MATERIALS, (2) PERSONAL INJURY OR PROPERTY DAMAGE, OF ANY NATURE WHATSOEVER, RESULTING FROM YOUR ACCESS TO AND USE OF THE SERVICES, (3) ANY UNAUTHORISED ACCESS TO OR USE OF OUR SECURE SERVERS AND/OR ANY AND ALL PERSONAL INFORMATION AND/OR FINANCIAL INFORMATION STORED THEREIN, (4) ANY INTERRUPTION OR CESSATION OF TRANSMISSION TO OR FROM THE SERVICES, (5) ANY BUGS, VIRUSES, TROJAN HORSES, OR THE LIKE WHICH MAY BE TRANSMITTED TO OR THROUGH THE SERVICES BY ANY THIRD PARTY, AND/OR (6) ANY ERRORS OR OMISSIONS IN ANY CONTENT AND MATERIALS OR FOR ANY LOSS OR DAMAGE OF ANY KIND INCURRED AS A RESULT OF THE USE OF ANY CONTENT POSTED, TRANSMITTED, OR OTHERWISE MADE AVAILABLE VIA THE SERVICES. WE DO NOT WARRANT, ENDORSE, GUARANTEE, OR ASSUME RESPONSIBILITY FOR ANY PRODUCT OR SERVICE ADVERTISED OR OFFERED BY A THIRD PARTY THROUGH THE SERVICES, ANY HYPERLINKED WEBSITE, OR ANY WEBSITE OR MOBILE APPLICATION FEATURED IN ANY BANNER OR OTHER ADVERTISING, AND WE WILL NOT BE A PARTY TO OR IN ANY WAY BE RESPONSIBLE FOR MONITORING ANY TRANSACTION BETWEEN YOU AND ANY THIRD-PARTY PROVIDERS OF PRODUCTS OR SERVICES. AS WITH THE PURCHASE OF A PRODUCT OR SERVICE THROUGH ANY MEDIUM OR IN ANY ENVIRONMENT, YOU SHOULD USE YOUR BEST JUDGEMENT AND EXERCISE CAUTION WHERE APPROPRIATE.
                </div>
            </div>
        </div>
        <div class="terms-conditions">
            <div id="contact-us">
                <h2>CONTACT US</h2>
                <div class="term-description">
                In order to resolve a complaint regarding the Services or to receive further information regarding use of the Services, please contact us at:

                <h4>Social Media Campaigns</h4>
                <h5>United Kingdom</h5>
                <h5> 1-800-536-678</h5>
                <h5>smcampaigns@gmail.com</h5>
                These terms of use were created using Termly's Terms and Conditions Generator

                </div>
            </div>
        </div>
        

    </div>

    <?php
        include('footer.php');
    ?>
    <script>
        document.getElementById('you-here').innerHTML = "<p>You are at <b>Contact</b></p>";

    </script>
</body>

</html>