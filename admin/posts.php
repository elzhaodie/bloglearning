<?php
session_start();
if((empty($_SESSION['user_role'])) or ($_SESSION['user_role'] !== 'admin')){
    echo "you are not an admin, you're not allowed to access this url";
} else {
?>
<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1">


<?php 
include "includes/db.php";
include "includes/header.php";
include "includes/functions.php";
?>
</head>

<body>
    <?php
                                    if (isset($_GET['delete'])) {
                                        $the_cat_id = $_GET['delete'];
                                        $query = "DELETE FROM categories WHERE cat_id=$the_cat_id";
                                        $result = mysqli_query($connection, $query);
                                    
                                        if (!$result) {
                                            echo "Sorry, your database hasn't changed.";
                                        }
                                    }
    ?>
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
        <?php
        delete_post();
        ?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>
                                <?php
                                    if(empty($_SESSION['username'])){
                                        echo "";
                                     } else {
                                        echo $_SESSION['username'];
                                     } 
                                ?>
                            </small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i>  <a href="">Posts</a>
                            </li>
                        </ol>
                        <div class="col-lg-12" class="table-post" style="overflow-x:auto;">
                        <form action="" method="post">
                        <button type="submit" name="delete_category">Delete</button><br><br>
                        <?php
                            if(isset($_POST['delete_category'])){
                                $id = [];
                                if(!empty($_POST['checkbox'])){
                                    foreach(($_POST['checkbox']) as $checkboxvalue){
                                        array_push($id, $checkboxvalue);
                                    }
                                    foreach($id as $key){
                                        global $connection;
                                        $query = "DELETE FROM posts WHERE post_id = '{$key}'";
                                        $result = mysqli_query($connection, $query);
                                        if(!$result){
                                            die('QUERY FAILED' . mysqli_error($connection));
                                        }
                                    }
                                    echo '
                                            <div class="success" style="background-color: #ddffdd; border-left: 6px solid #04AA6D;">
                                                        <p style="
                                                        align-items:center;
                                                        justify-content: center;
                                                        display: flex;
                                                        ">
                                                        <strong>Success!</strong>Your post has succesfully deleted</p>
                                                    </div>
                                            ';
                                } else {
                                    ?> 
                                    <div class="danger" style="background-color: #fa5f5f; border-left: 6px solid red;">
                                        <p style="
                                        align-items:center;
                                        justify-content: center;
                                        display: flex;
                                        ">
                                        <strong>Sorry!</strong>There is no data you've selected</p>
                                    </div>
                                    <?php
                                }
                            }
                        ?>
                            <table class="learn">
                                <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Tags</th>
                                    <th>Comments</th>
                                    <th>Date</th>
                                    <th colspan="2">Action</th>
                                </tr>
                                <?php
                                    $query = "SELECT * FROM posts LEFT JOIN (SELECT comments.comment_post_id as comment_post_id, COUNT(comments.comment_post_id) as jumlah_komen FROM `comments` join `posts` ON comments.comment_post_id = posts.post_id GROUP BY comments.comment_post_id) as count_comment_on_post ON posts.post_id = count_comment_on_post.comment_post_id;";
                                    $result = mysqli_query($connection, $query);

                                    while($row = mysqli_fetch_assoc($result)){
                                        ?> 
                                        <tr>
                                        <td><input name="checkbox[]" type="checkbox" value="<?php echo $row['post_id']; ?>"></td>
                                            <td><?php echo $row['post_id']?></td>
                                            <td><?php echo $row['post_author']?></td>
                                            <td><?php echo $row['post_title']?></td>
                                            <td><?php echo $row['post_category_id']?></td>
                                            <td><?php echo $row['post_status']?></td>
                                            <td><img class="img-responsive" src="../images/<?php echo $row['post_image']?>" alt=""></td>
                                            <td><?php echo $row['post_tags']?></td>
                                            <td><a href="comment.php?post_id=<?php echo $row['post_id'] ?>"><?php if(empty($row['jumlah_komen'])){
                                                echo "0";}
                                                ?></a></td>
                                            <td><?php echo $row['post_date']?></td>
                                            <td><a data-toggle="modal" data-target="#myModal-<?php echo $row['post_id']; ?>" href="#">Delete</a></td>
                                            <!-- /#Modal Content Delete -->
                                            <div class="modal fade" id="myModal-<?php echo $row['post_id']; ?>" role="dialog" data-backdrop="false"
                                                style="background-color: rgba(0, 0, 0, 0.5);">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">Delete Categories</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to delete your <?php echo $row['post_title'] ?> post?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                            <a href="posts.php?delete_post=<?php echo $row['post_id'] ?>"><button type="button" class="btn btn-default">Yes, Please</button></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <td><a href="posts.php?update_post=<?php echo $row['post_id'] ?>">Edit</a></td>
                                        </tr>
                                        <?php 
                                    }
                                    if(isset($_GET['update_post'])){
                                        $id = $_GET['update_post'];
                                        header("location: update_post.php?update=$id");
                                    }
                                ?>
                            </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>


  
</body>

    <!-- jQuery -->
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</html>
<?php
}
?>

