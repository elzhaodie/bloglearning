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
                    $id = $_GET['tags'];
                    $query = "SELECT * FROM posts WHERE post_category_id='{$id}' AND post_status='published'";
                    $result = mysqli_query($connection, $query);
                    $count_row = mysqli_num_rows($result);
                    if($count_row == 0){
                        echo '
                        <div class="success" style="background-color: #ffdddd; border-left: 6px solid red;">
                                <h4 style="
                                    align-items:center;
                                    justify-content: center;
                                    display: flex;
                                    ">
                                    <strong>Sorry!</strong>&nbsp No Post Available
                                </h4>
                        </div>
                        ';
                    } else {
                    while($row = mysqli_fetch_assoc($result)){
                ?>
                    <h2>
                        <a href="post.php?post_id=<?php echo $row['post_id']?>"><?php echo $row['post_title']?></a>
                    </h2>
                    <p class="lead">
                        by <a href="index.php"><?php echo $row['post_author']?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $row['post_date']?></p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $row['post_image']?>" alt="">
                    <hr>
                    <p><?php echo $row['post_content']?></p>
                    <a class="btn btn-primary" href="post.php?post_id=<?php echo $row['post_id']?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                    <hr>
                <?php
                    }
                    }
                ?>

                <!-- Pager -->
                <ul class="pager">
                    <!-- <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li> -->
                    <?php
                    $id = $_GET['tags'];
                    $query_count = "SELECT COUNT(*) FROM posts WHERE post_category_id='{$id}'";
                    $count_post_row = intval($query_count[0]);
                    $data_limit = 3;
                    $divided = $count_post_row / $data_limit;
                    // $halaman = 0;
                    $limit = 3;
                    $query_count = "SELECT COUNT(*) FROM posts";
                    $query_count_row = mysqli_query($connection, $query_count);
                    $result_count = mysqli_fetch_array($query_count_row);
                    $count = $result_count[0];
                    $divided = ceil($count / $limit);
                    $x = 1;
                    while($x <= $divided){
                        ?>
                        <li>
                            <a href="scroll.php?page=<?php echo $x?>"><?php
                                echo $x;
                            ?></a>
                        </li>
                        <?php
                        $x++;
                    }
                    ?>
                    
                </ul>

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
