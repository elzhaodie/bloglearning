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

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin,
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
                                <i class="fa fa-dashboard"></i>  <a href="">Categories</a>
                            </li>
                        </ol>
                        <div class="col-xs-6">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat-title">Add Category</label>
                                    <input name="category_title" type="text" class="form-control" >
                                </div>
                                <div class="form-group">
                                <input type="submit" value="Submit" name="submit">
                                </div>
                            </form>

                            <?php
                            if(isset($_POST['update'])){
                                $value = $_POST['update_category_title'];
                                $id = $_GET['update'];
                                $query = "UPDATE categories SET category_name = '$value' WHERE cat_id='$id'";
                                $result = mysqli_query($connection, $query);
                                if(!$result){
                                    echo "sorry, your request doesn't updated";
                                }
                            }
                            if(isset($_GET['update'])){
                                ?>

                                <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat-title">Update Category</label>
                                    <input name="update_category_title" type="text" class="form-control" placeholder=<?php
                                        $selected_data = $_GET['update']; 
                                        $query = "SELECT * FROM categories WHERE cat_id='$selected_data'";
                                        $data_query = mysqli_query($connection, $query);
                                        while($row = mysqli_fetch_assoc($data_query)){
                                            echo $row['category_name'];
                                        }
                                    ?>>
                                </div>
                                <div class="form-group">
                                <input type="submit" value="Update" name="update">
                                </div>
                                </form>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="col-xs-6">
                        <br>
                        <?php
                            insert_categories();
                        ?>
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
                                            $query = "DELETE FROM categories WHERE cat_id='{$key}'";
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
                                <th>No</th>
                                <th>Category Name</th>
                                <th colspan="2">Action</th>
                            </tr>
                            <?php
                                $query = "SELECT * FROM categories";
                                $result = mysqli_query($connection, $query);
                                
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="checkbox[]" value="<?php echo $row['cat_id']; ?>">
                                        </td>
                                        <td><?php echo $row['cat_id'] ?></td>
                                        <td><?php echo $row['category_name'] ?></td>
                                        <!-- -->
                                        <td class="action"><a data-toggle="modal" data-target="#myModal-<?php echo $row['cat_id']; ?>" href="#">Delete</a></td>
                                        <!-- /#Modal Content Delete -->
                                        <div class="modal fade" id="myModal-<?php echo $row['cat_id']; ?>" role="dialog" data-backdrop="false"
                                             style="background-color: rgba(0, 0, 0, 0.5);">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Delete Categories</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to delete your <?php echo $row['category_name'] ?> category?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                        <a href="categories.php?delete=<?php echo $row['cat_id'] ?>"><button type="button" class="btn btn-default">Yes, Please</button></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <td class="action"><a href="categories.php?update=<?php echo $row['cat_id'] ?>">Update</a></td>
                                    </tr>
                                    <?php
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
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    
    <!-- Bootstrap Core JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</html>
<?php
}
?>

