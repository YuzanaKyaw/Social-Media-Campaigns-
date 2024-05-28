<?php
    include('database/dbconnection.php');
    $category_id = $_GET['category'];
    
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
            $sql = "SELECT * FROM content WHERE category_id='$category_id'";
            $record = mysqli_query($connection,$sql);
                
            $rows = mysqli_num_rows($record);
            if($rows>0){
                    
                for($i=0; $i<$rows; $i++){
                    $data = mysqli_fetch_assoc($record);
                    $date = date($data['created_at']);
                    $contentId = $data['content_id'];
                    echo "
                    <div class='card col-l-4 col-m-6 col-s-12'>
                        <div class='card-header'>
                            <img src='".substr($data['image'],3)."' alt=''>
                        </div>
                        <div class='card-content'>
                        <h3 class='content-title'>".$data['title']."</h3>
                        <div class='content-detail'>    
                            <div class='content-author col-l-12'>".$data['author']."</div>
                            
                        </div>
                        <div class='description'>
                            ".substr($data['main_content'],0,100).".....
                            <div class='btn-group'>
                                <a href='detail_content.php?content=$contentId' class='btn btnEdit'>Read More</a>
                            </div>
                        </div>
                            
                        </div>
                    </div>";

                }
            }else{
                echo "<div class='sub-header col-l-12 col-m-12 col-s-12'>
                        <h2>There is no content to show</h2>
                    </div>";
            }
            

        ?>



    </div>

    <!-- <div class='content-detail'>    
                            <div class='content-author col-l-6'>".$data['author']."</div>
                            <div class='content-date col-l-6'>".$date."</div>
                        </div> -->

</body>

</html>