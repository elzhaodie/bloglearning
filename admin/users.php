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
    <?php
    delete_user();
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
                                <i class="fa fa-dashboard"></i>  <a href="">Users</a>
                            </li>
                        </ol>
                        <div class="col-lg-12" class="table-post" style="overflow-x:auto;">
                            <table class="learn">
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th colspan="2">Action</th>
                                </tr>
                                <?php
                                    $query = "SELECT * FROM users";
                                    $result = mysqli_query($connection, $query);

                                    while($row = mysqli_fetch_assoc($result)){
                                        ?> 
                                        <tr>
                                            <td><?php echo $row['user_id']?></td>
                                            <td><?php echo $row['username']?></td>
                                            <td><?php echo $row['user_firstname']?></td>
                                            <td><?php echo $row['user_lastname']?></td>
                                            <td><?php echo $row['user_email']?></td>
                                            <!--<td><img class="img-responsive" src="../images/<?php echo $row['post_image']?>" alt=""></td>-->
                                            <td><?php echo $row['user_role']?></td>
                                            <td class="action"><a data-toggle="modal" data-target="#myModal-<?php echo $row['user_id']; ?>" href="#">Delete</a></td>
                                            <!-- /#Modal Content Delete -->
                                            <div class="modal fade" id="myModal-<?php echo $row['user_id']; ?>" role="dialog" data-backdrop="false"
                                                style="background-color: rgba(0, 0, 0, 0.5);">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">Delete Categories</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to delete your <?php echo $row['username'] ?>'s data?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                            <a href="users.php?delete_user=<?php echo $row['user_id'] ?>"><button type="button" class="btn btn-default">Yes, Please</button></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <td><a href="users.php?update_user=<?php echo $row['user_id'] ?>">Edit</a></td>
                                        </tr>
                                        <?php 
                                    }
                                    if(isset($_GET['update_user'])){
                                        $id = $_GET['update_user'];
                                        header("location: update_user.php?update=$id");
                                    }
                                ?>
                            </table>
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

