<!DOCTYPE html>
<html lang="en">

<head>

<?php 
include "includes/db.php";
include "includes/header.php";
session_start();


?>
<link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php
    if(isset($_POST['kamu'])){
        $username = $_POST['username'];
        $password = $_POST['password_login'];
        $db_password = "";
        $userid = "";
        $user_role = "";
        $user_email = "";
        $_SESSION['username'] = "";
        $_SESSION['user_id'] = "";
        $_SESSION['user_role'] = "";
        $_SESSION['email'] = "";
        global $connection;

        $query = "SELECT * FROM users WHERE username='{$username}'";
        $result = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($result)){
            $db_password = $row["user_password"];
            $userid = $row["user_id"];
            $user_role = $row["user_role"];
            $user_email = $row["user_email"];
        }

        if($db_password == $password){
            $_SESSION['username'] = "$username";
            $_SESSION['user_id'] = "$userid";
            $_SESSION['user_role'] = "$user_role";
            $_SESSION['email'] = "$user_email";
            if($_SESSION['user_role'] == "admin"){
                header("location: admin/categories.php");
            } else if($_SESSION['user_role'] == "subscriber"){
                header("location: index.php");
            }
        } else {
            echo "maaf kamu tidak diperbolehkan masuk";
        } 
    }
    ?>


    
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
