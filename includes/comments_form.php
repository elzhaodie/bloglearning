<?php
include "db.php";
include "header.php";
include_once "admin/includes/functions.php";

if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
?>

<div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="post">
                        <?php
                            if(empty($_SESSION['user_role'])){
                                ?>  
                                <div class="form-group">
                                    <label>Author</label><br>
                                    <input type="text" name="cmmnt_author" class="form-control"><br>
                                    <label>Email</label><br>
                                    <input type="email" name="cmmnt_email" class="form-control"><br>
                                    <label>Your Comment</label><br>
                                    <textarea class="form-control" rows="3" name="cmmnt_content"></textarea>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="form-group">
                                    <label>Author</label><br>
                                    <input type="text" name="cmmnt_author" class="form-control" placeholder="<?php echo $_SESSION['username'];?>" value="<?php $_SESSION['username']; ?>" disabled><br>
                                    <label>Email</label><br>
                                    <input type="email" name="cmmnt_email" class="form-control" placeholder="<?php echo $_SESSION['email']; ?>" value="<?php $_SESSION['email']; ?>" disabled><br>
                                    <label>Your Comment</label><br>
                                    <textarea class="form-control" rows="3" name="cmmnt_content"></textarea>
                                </div>
                                <?php
                            }
                        ?>
                        <?php
                            if(!empty($_SESSION['user_role'])){
                                ?>  
                                <button type="submit" class="btn btn-primary" name="submit_comment">Submit</button>
                                <?php
                            } else {
                                ?>  
                                <button type="submit" class="btn btn-primary" name="submit_comment" disabled>Submit</button>
                                <h9>please, login first to add comment in this post</h9>
                                <?php
                            }
                        ?>
                    </form>
                    <?php
                        if(isset($_POST['submit_comment'])){
                            $id = $_GET['post_id'];
                            $comment_author = $_SESSION['username'];
                            $comment_email = $_SESSION['email'];
                            $comment_content = $_POST['cmmnt_content'];
                            $comment_status = "unapproved";

                            insert_comment($comment_author, $comment_content, $comment_email, $comment_status, $id);
                            // header("location: post.php");
                            update_count_comment_on_post();
                        }
                    ?>
</div>