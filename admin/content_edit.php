<?php
    session_start();
    include('../database/dbconnection.php');
    if(isset($_SESSION['admin'])){
        $username = $_SESSION['admin'];
        $sql = "SELECT * FROM user WHERE username='$username'";
        $data = mysqli_query($connection,$sql);
        $record = mysqli_fetch_assoc($data); 
    }
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "SELECT * FROM content WHERE content_id='$id'";
        $content = mysqli_query($connection,$query);
        $content = mysqli_fetch_assoc($content);
    }
    

    if(isset($_POST['updateContent'])){
        $contentTitle = $_POST['contentTitle'];
        $author = $_POST['author'];
        $keyword = $_POST['keyword'];
        $mainContent = mysqli_real_escape_string($connection,$_POST['mainContent']) ;
        // $references = mysqli_real_escape_string($connection,$_POST['references']);
        $references = filter_var($_POST['references'],FILTER_SANITIZE_URL);
        $contentCategory = $_POST['category'];
        
            
        if(is_uploaded_file($_FILES['image']['tmp_name'])){
            $contentImg = $_FILES['image']['name'];
            $content_tmp_name = $_FILES['image']['tmp_name'];
            $path="../image/content/".$contentImg;
            
            copy($content_tmp_name,$path);
            $oldImg = $content['image'];
            unlink($oldImg);

        }else{
            $path = $content['image'];
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
            $sql = "UPDATE content SET title='$contentTitle',category_id='$contentCategory',
            author='$author',main_content='$mainContent',image='$path',keyword='$keyword',
            reference='$references' WHERE content_id='$id'";

            if(mysqli_query($connection,$sql)){
                echo "<script>
                    alert('Content updated successfully!');
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
    <title>Update Content</title>
    <!-- style link -->
    <link rel="stylesheet" href="../../css/style.css?<?php echo time(); ?>">
</head>
<body>
    <?php
        if(isset($_SESSION['admin'])){
            include('admin_header.php');
        
    ?>
    <div class="admin-container">
    <div class="form-container">
        <div class="sub-header col-l-12 col-m-12 col-s-12">
            <h2>Content Creation</h2>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-content">
                <label>Content Title</label>
                <input type="text" class="form-input" value="<?php echo $content['title']  ?>" placeholder="Enter Content Title" name="contentTitle">
                <?php
                    if(isset($error['contentTitle'])){
                        echo "<div class='error-msg'>".$error['contentTitle']."</div>";
                    }
                ?>
            </div>
            <div class="form-content">
                <label>Author</label>
                <input type="text" class="form-input" value="<?php echo $content['author']  ?>" placeholder="Enter Author Name" name="author">
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
                        if($content['category_id']==$data['category_id']){ 
                            echo "<option value='".$data['category_id']."' selected>".$data['category_name']."</option>";
                        }else{
                            echo "<option value='".$data['category_id']."'>".$data['category_name']."</option>";
                        }
                        
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
                <input type="text" class="form-input" value="<?php echo $content['keyword'] ?>" placeholder="Keywords eg. #facebook #cyberbullying" name="keyword">
                <?php
                    if(isset($error['keyword'])){
                        echo "<div class='error-msg'>".$error['keyword']."</div>";
                    }
                ?>
            </div>
            <div class="form-content">
                <label for="">Content Image</label>
                <img src="<?php echo $content['image'] ?>" alt="">
                <input type="file" class="form-input form-img" name="image" id="">
            </div>
            <div class="form-content">
                <label>Main Content</label>
                <textarea class="form-input" name="mainContent" id="" cols="65" rows="20" placeholder="Enter Main Content"><?php echo $content['main_content']  ?></textarea>
                <?php
                    if(isset($error['mainContent'])){
                        echo "<div class='error-msg'>".$error['mainContent']."</div>";
                    }
                ?>
            </div>
            
            <div class="form-content">
                <label>References</label>
                <textarea class="form-input" name="references" id="" cols="65" rows="5" placeholder="Enter references website links"><?php echo $content['reference']  ?></textarea>
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
                <input type="submit" value="Update Content" name="updateContent" class="btn btnRegister">
            </div>
        </form>
        
    </div>
    </div>


    <?php
        }else{
            echo "<script>window.location = '../login.php';</script>";
        }
    ?>
</body>
</html>