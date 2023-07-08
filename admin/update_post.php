<?php
session_start();
if((empty($_SESSION['user_role'])) or ($_SESSION['user_role'] !== 'admin')){
    echo "you are not an admin, you're not allowed to access this url";
} else {
?>
<!DOCTYPE html>
<html lang="en">

<head>

<?php 
include "includes/db.php";
include "includes/header.php";
include "includes/functions.php";


?>
<link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <?php 
                include "includes/navigation.php";
            ?>
            <!-- Top Menu Items -->
            <?php 
                include "includes/top_menu.php";
            ?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <?php 
                include "includes/sidebar.php";
            ?>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>Author</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i>  <a href="">Categories</a>
                            </li>
                        </ol>
                        <div class="col-lg-12">
                            <div id="table-post">
                                <?php
                                    $id = $_GET['update'];
                                    $query = "SELECT * FROM posts WHERE post_id = '{$id}'";
                                    $result = mysqli_query($connection, $query);
                                    while($row = mysqli_fetch_assoc($result)){
                                        ?>
                                        <form id="table-post" action="" method="post">
                                            <label for="fname">Post Author</label><br>
                                            <input type="text" id="fname" name="post_author" placeholder=<?php echo $row['post_author']?>><br>
                                            <label for="lname">Post Title</label><br>
                                            <input type="text" id="lname" name="post_title" placeholder=<?php echo $row['post_title']?>><br>
                                            <label for="fname">Post Category ID</label><br>
                                            <input type="text" id="fname" name="post_cat_id" placeholder=<?php echo $row['post_category_id']?>><br>
                                            <label for="lname">Post Status</label><br>
                                            <input type="text" id="lname" name="post_status" placeholder=<?php echo $row['post_status']?>><br>
                                            <label for="lname">Post Image</label><br>
                                            <img class="img-responsive" src="../images/<?php echo $row['post_image']?>" alt=""><br>
                                            <input type="file" id="lname" name="post_image" size="60" placeholder=<?php echo $row['post_image']?>><br>
                                            <label for="lname">Post Tags</label><br>
                                            <input type="text" id="lname" name="post_tags" placeholder=<?php echo $row['post_tags']?>><br>
                                            <label for="lname">Post Content</label><br>
                                            <textarea name="post_content" style="width: 100%;height: 200%" placeholder=<?php echo $row['post_content']?> ></textarea><br>
                                            <input type="submit" value="Submit" name="post_update">
                                        </form>
                                    <?php
                                    }

                                    update_post($id);
                                ?>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
<?php
}
?>

