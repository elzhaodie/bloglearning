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
                                <i class="fa fa-dashboard"></i>  <a href="">Profile</a>
                            </li>
                        </ol>
                        <div class="col-lg-12">
                            <div id="table-post">
                                <?php
                                    // update_users();
                                    $id = $_GET['id_user'];
                                    $result = view_specific_user($id);
                                    while($row = mysqli_fetch_assoc($result)){
                                        ?>
                                        <form id="table-post" action="" method="post">
                                            <label for="fname">First Name</label><br>
                                            <input type="text" id="fname" name="first_name" placeholder="<?php echo $row['user_firstname']?>" required><br>
                                            <label for="lname">Last Name</label><br>
                                            <input type="text" id="lname" name="last_name" placeholder="<?php echo $row['user_lastname']?>" required><br>
                                            <label for="lname">Username</label><br>
                                            <input type="text" id="lname" name="username" placeholder="<?php echo $row['username']?>" required><br>
                                            <label for="lname">Email</label><br>
                                            <input type="email" id="lname" name="email" placeholder="<?php echo $row['user_email']?>" required><br>
                                            <label for="lname">Password</label><br>
                                            <input type="password" id="lname" name="password" placeholder="<?php echo $row['user_password']?>" required><br>
                                            <input type="submit" name="update_user">
                                        </form>
                                    <?php
                                    }

                                    if(isset($_POST['update_user'])){
                                        update_users_self($id);
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


