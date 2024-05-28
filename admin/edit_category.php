<?php
    session_start();
    if(isset($_SESSION['admin'])){
        $username = $_SESSION['admin'];
        $sql = "SELECT * FROM user WHERE username='$username'";
        $data = mysqli_query($connection,$sql);
        $record = mysqli_fetch_assoc($data); 
    }
    include('admin_header.php');
    include('../database/dbconnection.php');
    $category_id = $_GET['id'];
    $sql = "SELECT * FROM category WHERE category_id = '$category_id'";
    $category = mysqli_query($connection,$sql);
    $category = mysqli_fetch_assoc($category);

    if(isset($_POST['updateCategory'])){
        $category_name = trim($_POST['catName']);
        if(empty($category_name)){
            $error['catName'] = "Category Name is required";
        }else{
            $sql = "SELECT * FROM category WHERE category_name='$category_name'";
            $data = mysqli_query($connection,$sql);
            if(mysqli_num_rows($data)){
                $error['unique'] = "The category name has been already existed! Try another!";

            }else{
                $sql = "UPDATE category SET category_name='$category_name' WHERE category_id='$category_id'";
                if(mysqli_query($connection,$sql)){
                    echo "<script>
                            alert('Category Update successfully!');
                            window.location= 'create_category.php';
                        </script>";
                }else{
                    echo "<script>alert('Try again!')</script>";
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
    <title>Create Category</title>
    <!-- style link -->
    <link rel="stylesheet" href="../../css/style.css?<?php echo time(); ?>">
</head>

<body>
    <?php
        if(isset($_SESSION['admin']))
        {
    ?>
    <div class="admin-container">
        <div class="category">
            <div class="">
                <div class="form-container">
                    <div class="sub-header col-l-12 col-m-12 col-s-12">
                        <h2>Category</h2>
                    </div>
                    <form action="" method="post">
                        <div class="form-content">
                            <label>Category Name</label>
                            <input type="text" class="form-input" name="catName" placeholder="Enter username" value="<?php echo $category['category_name'] ?>">
                            <?php
                                if(isset($error['catName'])){
                                    echo "<div class='error-msg'>".$error['catName']."</div>";
                                }
                                if(isset($error['unique'])){
                                    echo "<div class='error-msg'>".$error['unique']."</div>";
                                }
                            ?>
                        </div>


                        <div class="from-content col-l-12 col-m-12 col-s-12">
                            <button type="submit" class="btn btnRegister" name="updateCategory">Create Category</button>
                        </div>

                    </form>
                </div>
            </div>
            
            
        </div>
        
    </div>


    <?php
        }else{
            echo "<script>window.location = '../login.php';</script>";
        }
    ?>
    <script src="../js/script.js"></script>
</body>

</html>