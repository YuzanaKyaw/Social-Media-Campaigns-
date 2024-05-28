<?php
    include('database/dbconnection.php');
    session_start();
    $category_id = $_GET['category'];
    if(isset($_SESSION['user'])){
        $username = $_SESSION['user'];
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
    <title>Popular Social Media App</title>
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
    <div class="container">
    <div class="content-search col-l-6 col-m-8 col-s-12">
        <form action="search_process.php?category=<?php echo $category_id; ?>" method="post">
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
            $category_id = $_POST['categoryId'];
            $sql = "SELECT * FROM content WHERE category_id='$category_id' AND 
            ((title LIKE '%$searchkey%') OR (keyword LIKE '%$searchkey%') OR (author LIKE '%$searchkey%'))";
            $data = mysqli_query($connection,$sql);
            $rows = mysqli_num_rows($data);
                    if($rows>0){
                        
                        for($i=0; $i<$rows; $i++){
                            $content = mysqli_fetch_assoc($data);
                            $date = date($content['created_at']);
                            echo "
                            <div class='card col-l-3 col-m-5 col-s-12'>
                            <div class='card-header'>
                                <img src='".substr($content['image'],3)."' alt=''>
                            </div>
                            <div class='card-content'>
                                <h3 class='content-title'>".$content['title']."</h3>
                                <div class='content-detail'>    
                                    <div class='content-author col-l-6'>".$content['author']."</div>
                                    <div class='content-date col-l-6'>".$date."</div>
                                </div>
                                <div class='description'>
                                ".substr($content['main_content'],0,100).".....
                                <div class='btn-group'>
                                    <a href='#' class='btn btnEdit'>Read More</a>
                                </div>
                                </div>
                                
                            </div>
                        </div>
                            ";
                        }
                    }else{
                        echo "<div class='sub-header col-l-12 col-m-12 col-s-12'>
                            <h2>There is no content to show</h2>
                        </div>";
                    }
        }
    ?>

    </div>
    </div>
    


</body>

</html>

    