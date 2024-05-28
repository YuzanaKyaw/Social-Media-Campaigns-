<?php
    session_start();
    include('../database/dbconnection.php');
    if(isset($_SESSION['admin'])){
        $username = $_SESSION['admin'];
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
    <title>Create Content</title>
    <!-- style link -->
    <link rel="stylesheet" href="../../css/style.css?<?php echo time(); ?>">
</head>
<body>
    <?php
        if(isset($_SESSION['admin'])){
            include('admin_header.php');
        
    ?>
    <div class="admin-container">
        <div class="content-search col-l-6 col-m-8 col-s-12">
            <form action="" method="post">
                <input type="hidden" name="categoryId" value="<?php echo $category_id; ?>">
                <div class="form-content col-l-9 col-m-9 col-s-9">
                    <input type="text" name="searchKey" id="" class="form-input">
                </div>
                <input type="submit" name="serach" value="Search" class=" col-l-3 col-m-3 col-s-3 btn btnSearch">
            </form>

        </div>
       <div class="card-container">
            <?php
                if(isset($_POST['serach'])){
                    $searchkey = $_POST['searchKey'];
                    $sql = "SELECT * FROM content WHERE  
                        ((title LIKE '%$searchkey%') OR 
                        (keyword LIKE '%$searchkey%') OR 
                        (author LIKE '%$searchkey%'))";
                    $record = mysqli_query($connection,$sql);
                    $row = mysqli_num_rows($record);
                    if($row>0){
                        for($i=0; $i<$row; $i++){
                            $data = mysqli_fetch_assoc($record);
                            $id = $data['content_id'];
                            echo "<div class='admin-card'>
                            <div class='left-side col-l-3 col-m-4 col-s-12'>
                                <img src='".$data['image']."' alt=''>
                            </div>
                            <div class='right-side col-l-9 col-m-8 col-s-12'>
                                <h2>".$data['title']."</h2>
                                <div class='content-detail'>    
                                    <div class='content-author col-l-6 col-m-6 col-s-6'>".$data['author']."</div>
                                    <div class='content-date col-l-6 col-m-6 col-s-6'>".$data['created_at']."</div>
                                </div>
                                <div class='description'>
                                    ".substr($data['main_content'],0,250)."...
                                    <div class='btn-group'>
                                        <a href='admin_content_detail.php?content=$id' class='btn'>View</a>
                                        <a href='content_edit.php?id=$id' class='btn btnEdit'>Edit</a>
                                        <a href='#' onclick='deleteContent($id)' class='btn btnDelete'>Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>";    
                        }
                    }        
                }
                else{
                    $sql = "SELECT * FROM content ORDER BY created_at DESC";
                    $record = mysqli_query($connection,$sql);
                    $row = mysqli_num_rows($record);
                    if($row>0){
                        for($i=0; $i<$row; $i++){
                            $data = mysqli_fetch_assoc($record);
                            $id = $data['content_id'];
                            echo "<div class='admin-card'>
                            <div class='left-side col-l-3 col-m-4 col-s-12'>
                                <img src='".$data['image']."' alt=''>
                            </div>
                            <div class='right-side col-l-9 col-m-8 col-s-12'>
                                <h2>".$data['title']."</h2>
                                <div class='content-detail'>    
                                    <div class='content-author col-l-6 col-m-6 col-s-6'>".$data['author']."</div>
                                    <div class='content-date col-l-6 col-m-6 col-s-6'>".$data['created_at']."</div>
                                </div>
                                <div class='description'>
                                    ".substr($data['main_content'],0,250)."...
                                    <div class='btn-group'>
                                        <a href='admin_content_detail.php?content=$id' class='btn'>View</a>
                                        <a href='content_edit.php?id=$id' class='btn btnEdit'>Edit</a>
                                        <a href='#' onclick='deleteContent($id)' class='btn btnDelete'>Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>";    
                        }
                    }
                }

            ?>
            
       </div>     
    </div>


    <?php
        }else{
            echo "<script>window.location = '../login.php';</script>";
        }
    ?>
<script src='../js/script.js?<?php echo time(); ?>'></script>
</body>
</html>