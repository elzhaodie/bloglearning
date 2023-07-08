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
                                    if(isset($_GET['update'])){
                                        $id = $_GET['update'];
                                        $query = "SELECT * FROM users WHERE user_id='{$id}'";
                                        $result = mysqli_query($connection, $query);
                                        while($row = mysqli_fetch_assoc($result)){
                                            ?>
                                            <form id="table-post" action="" method="post">
                                                <label for="fname">First Name</label><br>
                                                <input type="text" id="fname" name="fname" placeholder="<?php echo $row['user_firstname']?>" required><br>
                                                <label for="lname">Last Name</label><br>
                                                <input type="text" id="lname" name="lname" placeholder="<?php echo $row['user_lastname']?>" required><br>
                                                <label for="fname">Role</label><br>
                                                    <select id="cars" name="user_role" placeholder="<?php echo $row['user_role']?>" required>
                                                        <option value="subscriber">Subscriber</option>
                                                        <option value="admin">Admin</option>
                                                    </select>
                                                <br>
                                                <br>
                                                <label for="lname">Username</label><br>
                                                <input type="text" id="lname" name="username" placeholder="<?php echo $row['username']?>" required><br>
                                                <label for="lname">Email</label><br>
                                                <input type="text" id="lname" name="email" size="60" placeholder="<?php echo $row['user_email']?>" required><br>
                                                <label for="lname">Password</label><br>
                                                <input type="text" id="lname" name="password" required><br>
                                                <input type="submit" name="post_update_user">
                                            </form>
                                        <?php
                                        }
                                        update_users($id);
                                    }
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

