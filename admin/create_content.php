<?php
    session_start();
    include('../database/dbconnection.php');
    if(isset($_SESSION['admin'])){
        $username = $_SESSION['admin'];
        $sql = "SELECT * FROM user WHERE username='$username'";
        $data = mysqli_query($connection,$sql);
        $record = mysqli_fetch_assoc($data); 
    }

    if(isset($_POST['createContent'])){
        $contentTitle = $_POST['contentTitle'];
        $author = $_POST['author'];
        $keyword = $_POST['keyword'];
        $mainContent = mysqli_real_escape_string($connection,$_POST['mainContent']) ;
        // $references = mysqli_real_escape_string($connection,$_POST['references']);
        $references = filter_var($_POST['references'],FILTER_SANITIZE_URL);
        $contentCategory = $_POST['category'];
        
            
        if(is_uploaded_file($_FILES['image']['tmp_name'])){
            echo "<script>alert('Image upload')</script>";
            $contentImg = $_FILES['image']['name'];
            $content_tmp_name = $_FILES['image']['tmp_name'];
            $path="../image/content/".$contentImg;
            // echo "<script>alert(".$content_tmp_name,$contentTitle,$author.")</script>";
            // echo $contentTitle,$author,$content_tmp_name,$path;
            copy($content_tmp_name,$path);

        }
        if(empty($contentTitle)){
            $error['contentTitle'] = "Content Title is required!";
        }else if(empty($author)){
            $error['author'] = "Author is required!";
        }else if(empty($contentCategory)){
            $error['category']="Category of the content must be selected!";
        }else if(empty($keyword)){
            $error['keyword'] = "Keywords of the cotent must be filled!";
        }else if(empty($mainContent)){
            $error['mainContent'] = "The content is required!";
        }else{
            $sql = "INSERT INTO content (title,category_id,author,main_content,image,keyword,reference)
            VALUES ('$contentTitle','$contentCategory','$author','$mainContent','$path','$keyword','$references')";

            if(mysqli_query($connection,$sql)){
                echo "<script>
                    alert('Content created successfully!');
                    window.location = 'content_lists.php';
                </script>";
            }else{
                echo "<script>alert('Creation error.Try again!')</script>";
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Content</title>
    <!-- style link -->
    <link rel="stylesheet" href="../../css/style.css?<?php echo time(); ?>">
</head>
<body>
    <?php
        if(isset($_SESSION['admin'])){
            include('admin_header.php');
        
    ?>

    <div class="form-container">
        <div class="sub-header col-l-12 col-m-12 col-s-12">
            <h2>Content Creation</h2>
        </div>
        <form action="create_content.php" method="post" enctype="multipart/form-data">
            <div class="form-content">
                <label>Content Title</label>
                <input type="text" class="form-input" value="<?php if(isset($_POST['createContent'])){ echo $_POST['contentTitle'];}  ?>" placeholder="Enter Content Title" name="contentTitle">
                <?php
                    if(isset($error['contentTitle'])){
                        echo "<div class='error-msg'>".$error['contentTitle']."</div>";
                    }
                ?>
            </div>
            <div class="form-content">
                <label>Author</label>
                <input type="text" class="form-input" value="<?php if(isset($_POST['createContent'])){ echo $_POST['author'];}  ?>" placeholder="Enter Author Name" name="author">
                <?php
                    if(isset($error['author'])){
                        echo "<div class='error-msg'>".$error['author']."</div>";
                    }
                ?>
            </div>
            <div class="form-content">
                <select name="category" class="form-input" >
                    <option value="">Choose Content Category</option>
                    <?php
                    $sql = "SELECT * FROM category";
                    $record = mysqli_query($connection,$sql);
                    
                    for($i=0; $i<mysqli_num_rows($record); $i++){
                        $data = mysqli_fetch_assoc($record);
                        echo "<option value='".$data['category_id']."'>".$data['category_name']."</option>";
                    }


                    ?>
                </select>
                <?php
                    if(isset($error['category'])){
                        echo "<div class='error-msg'>".$error['category']."</div>";
                    }
                ?>
            </div>
            <div class="form-content">
                <label>Keywords</label>
                <input type="text" class="form-input" value="<?php if(isset($_POST['createContent'])){ echo $_POST['keyword'];}  ?>" placeholder="Keywords eg. #facebook #cyberbullying" name="keyword">
                <?php
                    if(isset($error['keyword'])){
                        echo "<div class='error-msg'>".$error['keyword']."</div>";
                    }
                ?>
            </div>
            <div class="form-content">
                <label for="">Content Image</label>
                <input type="file" class="form-input form-img" name="image" id="">
            </div>
            <div class="form-content">
                <label>Main Content</label>
                <textarea class="form-input" name="mainContent" id="" cols="65" rows="20" placeholder="Enter Main Content"><?php if(isset($_POST['createContent'])){ echo $_POST['mainContent'];}  ?></textarea>
                <?php
                    if(isset($error['mainContent'])){
                        echo "<div class='error-msg'>".$error['mainContent']."</div>";
                    }
                ?>
            </div>
            
            <div class="form-content">
                <label>References</label>
                <textarea class="form-input" name="references" id="" cols="65" rows="5" placeholder="Enter references website links"><?php if(isset($_POST['createContent'])){ echo $_POST['references'];}  ?></textarea>
                <?php
                    if(isset($error['references'])){
                        echo "<div class='error-msg'>".$error['references']."</div>";
                    }
                ?>
            </div>
            
            
            <!-- <div class="form-content">
                <input type="checkbox" name="agree"> <span><small>I agree the terms and policy</small></span>
            </div> -->
            <div class="from-content col-l-12 col-m-12 col-s-12">
                <input type="submit" value="Create Content" name="createContent" class="btn btnRegister">
            </div>
        </form>
        
    </div>



    <?php
        }else{
            echo "<script>window.location = '../login.php';</script>";
        }
    ?>
</body>
</html>