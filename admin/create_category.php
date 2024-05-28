<?php
    session_start();
    include('../database/dbconnection.php');
    if(isset($_SESSION['admin'])){
        $username = $_SESSION['admin'];
        $sql = "SELECT * FROM user WHERE username='$username'";
        $data = mysqli_query($connection,$sql);
        $record = mysqli_fetch_assoc($data); 
    }
    
    
    if(isset($_POST['category'])){
        $category_name = trim($_POST['catName']);
        if(empty($category_name)){
            $error['catName'] = "Category Name is required";
        }else{
            $sql = "SELECT * FROM category WHERE category_name='$category_name'";
            $data = mysqli_query($connection,$sql);
            if(mysqli_num_rows($data)){
                $error['unique'] = "The category name has been already existed! Try another!";

            }else{
                $sql = "INSERT INTO category (category_name) VALUES('$category_name')";
                if(mysqli_query($connection,$sql)){
                    echo "<script>alert('Category Create successfully!');</script>";
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
            include('admin_header.php');
    ?>
    <div class="form-container">
                    <div class="sub-header col-l-12 col-m-12 col-s-12">
                        <h2>Category</h2>
                    </div>
                    <form action="" method="post">
                        <div class="form-content">
                            <label>Category Name</label>
                            <input type="text" class="form-input" name="catName" placeholder="Enter username">
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
                            <button type="submit" class="btn btnRegister" name="category">Create Category</button>
                        </div>

                    </form>
                </div>
    <div class="admin-container">
            
            <div class="col-l-12 col-m-12 col-s-12 data-box">
                <table class="table">
                    <tr>
                        <th>No</th>
                        <th>Category Name</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <?php
                        $sql = "SELECT * FROM category";
                        $record = mysqli_query($connection,$sql);
                        
                        for($i=0; $i<mysqli_num_rows($record); $i++){
                            $data = mysqli_fetch_assoc($record);
                            $id = $data['category_id'];
                            $deleteURL = 'delete_category.php?id='.$id;
                            echo "
                            <tr>
                                <td>".($i+1)."</td>
                                <td>".$data['category_name']."</td>
                                <td>
                                    <a href='#' onclick='deleteConfirm($id)' class='btn btnDelete'>
                                        <i class='fa-solid fa-trash'></i>
                                    </a>
                                </td>
                                <td>
                                <a href='edit_category.php?id=$id' class='btn btnEdit'>
                                    <i class='fa-solid fa-user-pen'></i>
                                </a>
                                </td>
                            </tr>
                            ";
                        }

                    ?>


                </table>
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