<?php
// session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

<link rel="stylesheet" href="css/style.css">
</head>

<body>
<div class="col-md-4">

                <!-- Login -->
                <?php
                if(empty($_SESSION['username'])){
                   ?>
                   <div class="well">
                    <h4>Login</h4>
                    <form action="login.php" method="post">
                            <input type="text" name="username" class="form-control" placeholder="Enter a username" required><br>
                            <input type="password" name="password_login" class="form-control" placeholder="Enter a password" required><br>
                            <div style="display: flex; justify-content: flex-end; margin-top: -10px" >
                                <p>Don't have an account?&nbsp; </p><a href="register.php" style="text-align: right;"> Register Here</a>
                            </div>
                            <br>
                            <div style="display: flex; justify-content: flex-end; margin-top: -10px">
                                <input name="kamu" type="submit">
                            </div>
                            
                    </form>
                    <!-- /.input-group -->
                    </div>
                    
                <?php
                } else {
                    ?>
                    <div class="well">
                    <h4>Hi, you're login as <?php echo $_SESSION['username']; ?></h4>
                        <div style="display: flex;">
                            <button><a href="admin/logout.php">Log Out</a></button>
                        </div>
                    <!-- /.input-group -->
                    </div>
                    <?php
                }
                ?>
                

                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="saerch.php" method="post">
                    <div class="input-group">
                        <input name="search_blog" type="text" class="form-control"><br>
                        <br>
                        <input name="search" type="submit">
                    </div>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Search Well -->
                

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                                <?php
                                    $query = "SELECT * FROM categories";
                                    $result = mysqli_query($connection, $query);

                                    if(!$result){
                                        die("you've lost connection in database cause". mysqli_error($connection));
                                    } else {
                                        while($row = mysqli_fetch_assoc($result)){
                                            ?> <li><a href="post.php?categories=<?php echo $row['cat_id'] ?>"><?php echo $row['category_name']?></a></li>
                                            <?php
                                        }   
                                    }
                                ?>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <!-- <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div> -->

            </div>
</body>

</html>
