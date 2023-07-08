<?php
session_start();
if((empty($_SESSION['user_role'])) or ($_SESSION['user_role'] !== 'admin')){
    echo "you are not an admin, you're not allowed to access this url";
} else {
?>

<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="css/style.css">
<?php 
include "includes/db.php";
include "includes/header.php";
include "includes/functions.php";
?>

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
                                <i class="fa fa-dashboard"></i>  <a href="">Comments</a>
                            </li>
                        </ol>
                        <div class="col-lg-12">
                        <form action="" method="post">
                        <button type="submit" name="delete_comments">Delete</button><br><br>
                        <?php
                                if(isset($_POST['delete_comments'])){
                                    $id = [];
                                    if(!empty($_POST['checkbox'])){
                                        foreach(($_POST['checkbox']) as $checkboxvalue){
                                            array_push($id, $checkboxvalue);
                                        }
                                        foreach($id as $key){
                                            global $connection;
                                            $query = "DELETE FROM comments WHERE comment_id='{$key}'";
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
                                                        <strong>Success!</strong>Your categories has succesfully deleted</p>
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
                        
                        <table class="check" id="check">
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Comment on Post</th>
                                <th>Author</th>
                                <th>Comment</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>In Response To</th>
                                <th>Date</th>
                                <th>Approve</th>
                                <th>Unapprove</th>
                                <th>Delete</th>
                            </tr>
                            <?php
                                $result_comments = view_comments();
                                while($row = mysqli_fetch_assoc($result_comments)){
                                    ?> 
                                <tr>
                                    <td><input name="checkbox[]" type="checkbox" value="<?php echo $row['comment_id']; ?>"></td>
                                    <td><?php echo $row['comment_id']?></td>
                                    <td><?php echo $row['comment_post_id']?></td>
                                    <td><?php echo $row['comment_author']?></td>
                                    <td><?php echo $row['comment_content']?></td>
                                    <td><?php echo $row['comment_email']?></td>
                                    <td><?php echo $row['comment_status']?></td>
                                    <td><?php echo $row['post_title']?></td>
                                    <td><?php echo $row['comment_date']?></td>
                                    <td class="action"><a href="comments.php?approve=<?php  echo $row['comment_id']?>">Approve</a></td>
                                    <td class="action"><a href="comments.php?unapprove=<?php  echo $row['comment_id']?>">Unapprove</a></td>
                                    <td class="action"><a href="comments.php?delete=<?php  echo $row['comment_id']?>">Delete</a></td>
                                </tr>
                                <?php
                                }
                                if(isset($_GET['delete'])){
                                    $id = $_GET['delete'];
                                    delete_comment($id);
                                }

                                if(isset($_GET['approve'])){
                                    $id = $_GET['approve'];
                                    set_approve($id);
                                    header("location: comments.php");
                                }

                                if(isset($_GET['unapprove'])){
                                    $id = $_GET['unapprove'];
                                    set_unapprove($id);
                                    header("location: comments.php");
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

