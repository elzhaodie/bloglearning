<?php


?>

<!DOCTYPE html>
<html lang="en">

<head>
<?php
include "includes/header.php";
include "includes/db.php";
include "admin/includes/functions.php";
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <!-- Navigation -->
    <?php
        include "includes/navigation.php";
    ?>

    <div class="container">
        <div class="row">
             <!-- Blog Post Content Column -->
            <div class="col-lg-8">
                <?php
                    if(isset($_GET['post_id'])){
                        $id = $_GET['post_id'];
                        $result = view_post($id);

                        while($row = mysqli_fetch_assoc($result)){
                        ?>
                            <h1><?php echo $row['post_title'] ?></h1>
                            <p class="lead">
                                by <a href="#"><?php echo $row['post_author'] ?></a>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $row['post_date'] ?></p>
                            <hr>
                            <!-- Preview Image -->
                            <img class="img-responsive" src="images/<?php echo $row['post_image']?>" alt="">
                            
                            <hr>
                            <!-- Post Content -->
                            <p class="lead"><?php echo $row['post_content']?></p>
                            <hr>
                            <div class="row">
                                <div class="col-lg-12" style="display: flex; justify-content: space-between;">
                                        <div class="col-md-3" style="display: flex; justify-content: space-between;">
                                            <form action="" method="post">
                                                <button name="post_like"><i class="fa fa-heart-o" style="text-align: left"></i> Like</button>
                                            </form> 
                                            <form action="" method="post">
                                                <button name="post_unlike"><i class="fa fa-thumbs-down" style="text-align: left"></i> Unlike</button>
                                            </form>
                                        </div>
                                        <div><i class="fa fa-heart-o"></i>
                                            <?php
                                                if(empty($row['post_like'])){
                                                    echo "0";
                                                } else {
                                                    echo $row['post_like'];
                                                }
                                            ?>
                                        </div>
                                </div>
                            </div>
                            <hr>
                            <?php   
                                    if(isset($_POST['post_like'])){
                                        if(empty($_SESSION['username'])){
                                            echo '
                                            <div class="success" style="background-color: #ffdddd; border-left: 6px solid red;">
                                                        <p style="
                                                        align-items:center;
                                                        justify-content: center;
                                                        display: flex;
                                                        ">
                                                        <strong>Sorry!</strong>You need to login to do this action</p>
                                                    </div>
                                            ';
                                        } else {
                                            $id = $_GET['post_id'];
                                            update_likes($id);
                                        }
                                    }

                                    if(isset($_POST['post_unlike'])){
                                        if(empty($_SESSION['username'])){
                                            echo '
                                            <div class="success" style="background-color: #ffdddd; border-left: 6px solid red;">
                                                        <p style="
                                                        align-items:center;
                                                        justify-content: center;
                                                        display: flex;
                                                        ">
                                                        <strong>Sorry!</strong>You need to login to do this action</p>
                                                    </div>
                                            ';
                                        } else {
                                            $id = $_GET['post_id'];
                                            update_unlikes($id);
                                        }
                                    }
                                ?>
                            <hr>
                        <?php
                        }    
                    }
                    if(isset($_GET['categories'])){
                        $id = $_GET['categories'];
                        $result = view_post_based_categories($id);
                        $row = mysqli_fetch_assoc($result);
                        if(empty($row)){
                            ?>
                            <div class="well">
                                <h4>Sorry, There is no data found</h4>
                            </div>
                            <?php
                        }
                        else {      
                                ?>
                                    <h1><?php echo $row['post_title'] ?></h1>
                                    <p class="lead">
                                        by <a href="#"><?php echo $row['post_author'] ?></a>
                                    </p>
                                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $row['post_date'] ?></p>
                                    <hr>
                                    <!-- Preview Image -->
                                    <img class="img-responsive" src="images/<?php echo $row['post_image']?>" alt="">
                                    
                                    <hr>
                                    <!-- Post Content -->
                                    <p class="lead"><?php echo $row['post_content']?></p>
                                            <hr>
                                <?php
                                
                        }
                    }
                ?>
                

                <!-- Comments Form -->
                
                <?php 
                    // if(!empty($_SESSION['username'])){
                    //     include "includes/comments_form.php";
                    // }
                    include "includes/comments_form.php";
                ?>
                <hr>
                <?php
                    if(isset($_GET['post_id'])){
                        $id = $_GET['post_id'];
                        $result = view_comment_on_post($id);

                        while($row = mysqli_fetch_assoc($result)){
                            ?>
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><?php echo $row['comment_author']?>
                                    <small><?php echo $row['comment_date']?></small>
                                </h4>
                                <?php echo $row['comment_content']?>
                            </div>
                        </div>
                        <?php
                        }
                    }
                ?>
                
            </div>

            <div class="col-md-4">
                <!-- Blog Search Well -->
                <?php
                    if(empty($_SESSION['username'])){
                        echo "";
                    } else {
                        ?>
                        <div class="well">
                            <h4>Hi, you're login as <?php echo $_SESSION['username']; ?></h4>
                                <div style="display: flex;">
                                    <button><a href="admin/logout.php">Log Out</a></button>
                                </div>
                            <!-- /.input-group -->
                        </div>
                        <?php
                    }
                ?>
                <div class="well">
                    <h4>Blog Search</h4>
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                                <?php
                                $check = view_categories();
                                while($row = mysqli_fetch_assoc($check)){
                                    ?>
                                    <li><a href="#"><?php echo $row['category_name'] ?></a></li> 
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>
    </div>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>


</html>