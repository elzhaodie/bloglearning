<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php  include "admin/includes/functions.php"; ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" required>
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" required>
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password" required>
                        </div>
                
                        <input type="submit" name="register_user" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                </div>
                <?php
                    if(isset($_POST['register_user'])){
                        $username = $_POST['username'];
                        $is_username_exist = is_exist($username);
                        if($is_username_exist > 0){
                            echo '
                            <div class="success" style="background-color: #ffdddd; border-left: 6px solid red;">
                                        <p style="
                                        align-items:center;
                                        justify-content: center;
                                        display: flex;
                                        ">
                                        <strong>Sorry!</strong>Your username has been used. Please select another username to continue</p>
                                    </div>
                            '
                            ;
                        } else {
                            registration_user();
                        }   
                    }
                ?>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
