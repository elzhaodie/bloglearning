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
<script src="https://cdn.tiny.cloud/1/1ur50c31v8max1i58m995mln8ww68qpzkotmak4d519lr0bg/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

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
                                <i class="fa fa-dashboard"></i>  <a href="">Posts</a>
                            </li>
                        </ol>
                        <div class="col-lg-12">
                            <div id="table-post">
                                <?php
                                    insert_posts();
                                ?>
                                <form id="table-post" action="" method="post">
                                    <label for="fname">Post Author</label><br>
                                    <input type="text" id="fname" name="post_author"><br>
                                    <label for="lname">Post Title</label><br>
                                    <input type="text" id="lname" name="post_title"><br>
                                    <label for="fname">Post Category ID</label><br>
                                        <select id="cars" name="post_cat_id">
                                    <!-- <input type="text" id="fname" name="post_cat_id"><br> -->
                                        <?php
                                            $query = "SELECT * FROM categories";
                                            $result = mysqli_query($connection, $query);

                                            while($row = mysqli_fetch_assoc($result)){
                                                ?>
                                                    
                                                    <option value="<?php echo $row['cat_id'] ?>"><?php echo $row['category_name'] ?></option>
                                            <?php
                                            }
                                        ?>
                                        </select>
                                    <br>
                                    <br>
                                    <label for="post_status">Post Status</label><br>
                                            <select id="post_status" name="post_status">
                                                <option value="drafted">draft</option>
                                                <option value="published">publish</option>
                                            </select><br><br>
                                    <label for="lname">Post Image</label><br>
                                    <input type="file" id="lname" name="post_image" size="60"><br>
                                    <label for="lname">Post Tags</label><br>
                                    <input type="text" id="lname" name="post_tags"><br>
                                    <label for="lname">Post Content</label><br>
                                    <!-- <textarea name="post_content" style="width: 100%;height: 200%" ></textarea>
                                    -->
                                    <br>
                                    <textarea name="post_content">
                                        Welcome to TinyMCE!
                                    </textarea>
                                    <script>
                                        tinymce.init({
                                        selector: 'textarea',
                                        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
                                        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                                        tinycomments_mode: 'embedded',
                                        tinycomments_author: 'Author name',
                                        mergetags_list: [
                                            { value: 'First.Name', title: 'First Name' },
                                            { value: 'Email', title: 'Email' },
                                        ],
                                        });
                                    </script>
                                    <input type="submit" name="post_post">
                                </form>
                            </div>
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


