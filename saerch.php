<?php
include "includes/db.php";
include "includes/header.php";


?>
<!DOCTYPE html>
<html lang="en">

<head>


</head>

<body>

    <!-- Navigation -->
    <?php  include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <!-- <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1> -->

                <!-- First Blog Post -->
                <?php

                if(isset($_POST['search'])){
                    $search = $_POST['search_blog'];
                    $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
                    $result = mysqli_query($connection, $query);
                    $count = mysqli_num_rows($result);
                    if($count == 0){
                        ?> <h1>NO RESULT</h1> <?php
                    } else {
                        while($row = mysqli_fetch_assoc($result)){
                            ?> 
                            <h2>
                                <a href="#"><?php echo $row['post_title']?></a>
                            </h2>
                            <p class="lead">
                                by <a href="index.php"><?php echo $row['post_author']?></a>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $row['post_date']?></p>
                            <hr>
                            <img class="img-responsive" src="images/<?php echo $row['post_image']?>" alt="">
                            <hr>
                            <p><?php echo $row['post_content']?></p>
                            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                            <hr>
                            <?php
                        }
                        
                    }
                    
                }  
                ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>


    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

    <!-- footer -->
    <?php
    include "includes/footer.php";
    ?>

</html>
