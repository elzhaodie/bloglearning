<?php
include "db.php";
if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
?>


<html>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Blog Learning PHP</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php
                        $query = "SELECT * FROM categories";
                        $result = mysqli_query($connection, $query);
                        while($row = mysqli_fetch_assoc($result)){
                            $cat_name = $row["category_name"];
                            ?>
                            <li><a href='tag.php?tags=<?php echo $row['cat_id'] ?>'><?php echo $cat_name; ?></a></li>;
                        <?php
                        }
                    ?>
                    <li>
                        <?php if(empty($_SESSION['username']) || ($_SESSION['user_role'] == "subscriber") ){
                            echo "";
                        }  else {
                            ?> 
                            <a href='admin/index.php'>Admin</a> 
                            <?php
                        }
                        ?>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
</html>