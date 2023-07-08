<?php

function insert_categories(){
    // include "db.php";
    global $connection;

    if(isset($_POST['submit'])){
        $new_category_data = $_POST['category_title'];
        if($new_category_data == "" || empty($new_category_data)){
            echo "Sorry, your action couldn't be processed"; 
        } else {
            $insert_category_data = "INSERT INTO categories(category_name) VALUES ('{$new_category_data}')";
            $result_insert_category_data = mysqli_query($connection, $insert_category_data);
            if(!$result_insert_category_data){
                die('QUERY FAILED' . mysqli_error($connection));
            } else{
                echo '
                <div class="success" style="background-color: #ddffdd; border-left: 6px solid #04AA6D;">
                            <p style="
                            align-items:center;
                            justify-content: center;
                            display: flex;
                            ">
                            <strong>Success!</strong>Your new category has succesfully added</p>
                        </div>
                ';
            }
        }                                   
    }
}

function insert_posts(){
    global $connection;

    if(isset($_POST['post_post'])){
        $new_post_author = $_POST['post_author'];
        $new_post_title = $_POST['post_title'];
        $new_post_cat_id = $_POST['post_cat_id'];
        $new_post_status = $_POST['post_status'];
        $new_post_image = $_POST['post_image'];
        $new_post_tags = $_POST['post_tags'];
        $new_post_content = $_POST['post_content'];

        if($new_post_author == "" || empty($new_post_author)){
            echo "Sorry, your action couldn't be processed"; 
        } else {
            $insert_post_data = "INSERT INTO posts(post_category_id, post_title, post_author, post_image, post_content, post_tags, post_status) VALUES ('{$new_post_cat_id}','{$new_post_title}','{$new_post_author}','{$new_post_image}','{$new_post_content}','{$new_post_tags}','{$new_post_status}')";
            $result_insert_post_data = mysqli_query($connection, $insert_post_data);
            if(!$result_insert_post_data){
                die('QUERY FAILED' . mysqli_error($connection));
            } else{
                echo '
                <div class="success" style="background-color: #ddffdd; border-left: 6px solid #04AA6D;">
                            <p style="
                            align-items:center;
                            justify-content: center;
                            display: flex;
                            ">
                            <strong>Success!</strong>Your new post has succesfully added</p>
                        </div>
                ';
            }
        }                                   
    }
}

function delete_post(){
    if(isset($_GET['delete_post'])){
        global $connection;
        $deleted_id = $_GET['delete_post'];
        $query = "DELETE FROM posts WHERE post_id = '{$deleted_id}'";
        $result = mysqli_query($connection, $query);

        if(!$result){
            die('QUERY FAILED' . mysqli_error($connection));
        } else{
            echo '
            <div class="success" style="background-color: #ddffdd; border-left: 6px solid #04AA6D;">
                        <p style="
                        align-items:center;
                        justify-content: center;
                        display: flex;
                        ">
                        <strong>Success!</strong>Your post has succesfully deleted</p>
                    </div>
            ';
            // header("location: posts.php");
        }
    }
}

function update_post($id){   
    if(isset($_POST['post_update'])){
        global $connection;
        // $id = $_GET['update_post'];
        $post_author = $_POST['post_author'];
        $post_title = $_POST['post_title'];
        $post_cat_id = $_POST['post_cat_id'];
        $post_status = $_POST['post_status'];
        $post_image = $_POST['post_image'];
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];

        $query = "UPDATE posts SET post_category_id = '{$post_cat_id}', 
        post_title = '{$post_title}',
        post_author = '{$post_author}',
        post_image = '{$post_image}',
        post_content = '{$post_content}',
        post_tags = '{$post_tags}',
        post_status = '{$post_status}',
        post_date = now() WHERE post_id = '{$id}'";

        if(empty($post_author)||empty($post_title)||empty($post_cat_id)||empty($post_status)||empty($post_image)||empty($post_tags)||empty($post_content)){
            echo "sorry, you have unfilled field";
        } else {
            $result = mysqli_query($connection, $query);
            if(!$result){
                die('QUERY FAILED' . mysqli_error($connection));
            } else {
                header("location: posts.php");
            }
        }
       
    }
}

function view_categories(){
    global $connection;

    $query = "SELECT * FROM categories";
    $result = mysqli_query($connection, $query);
    return $result;
}

function view_comments(){
    global $connection;

    $query = "SELECT * FROM comments LEFT JOIN posts ON comments.comment_post_id = posts.post_id";
    $result = mysqli_query($connection, $query);
    return $result;
}

function insert_comment($comment_author, $comment_content, $comment_email, $comment_status, $id){
    global $connection;

    $query = "INSERT INTO comments(comment_author, comment_content, comment_email, comment_status, comment_date, comment_post_id) VALUES ('{$comment_author}', '{$comment_content}', '{$comment_email}', '{$comment_status}', now(), '{$id}')";
    $result = mysqli_query($connection, $query);

    if(!$result){
        die ('QUERY FAILED' . mysqli_error($connection));
    } else {
        return $result;
    }
}

function delete_comment($id){
    global $connection;
    $query = "DELETE FROM comments WHERE comment_id = '{$id}'";
    $result = mysqli_query($connection, $query);

    if(!$result){
        die ("Query failed" . mysqli_error($connection));
    } else {
        return $result;
    }
}

function set_approve($id){
    global $connection;
    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id='{$id}'";
    $result = mysqli_query($connection, $query);

    if(!$result){
        die ("Query failed" . mysqli_error($connection));
    } else {
        return $result;
    }
}

function set_unapprove($id){
    global $connection;
    $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id='{$id}'";
    $result = mysqli_query($connection, $query);

    if(!$result){
        die ("Query failed" . mysqli_error($connection));
    } else {
        return $result;
    }
}

function view_comment_on_post($id){
    global $connection;
    $query = "SELECT * FROM comments JOIN posts ON comments.comment_post_id = posts.post_id JOIN categories ON posts.post_category_id = categories.cat_id WHERE comment_post_id='{$id}' AND comment_status = 'approved'";
    $result = mysqli_query($connection, $query);

    return $result;
}

function view_post($id){
    global $connection;
    $query = "SELECT * FROM posts WHERE post_id='{$id}'";
    $result = mysqli_query($connection, $query);

    return $result;
}

function update_count_comment_on_post(){
    global $connection;
    $query = "UPDATE posts SET post_comment_count = (SELECT COUNT(*) FROM comments WHERE posts.post_id = comments.comment_post_id)";  
    $result = mysqli_query($connection, $query);
}

function insert_users(){
    // include "db.php";
    global $connection;

    if(isset($_POST['post_user'])){
        $new_firstname = $_POST['fname'];
        $new_lastname = $_POST['lname'];
        $new_user_role = $_POST['user_role'];
        $new_username = $_POST['username'];
        $new_email = $_POST['email'];
        $new_password = $_POST['password'];

            $insert_user_data = "INSERT INTO users(user_firstname, user_lastname, user_role, username, user_email, user_password) VALUES ('{$new_firstname}','{$new_lastname}','{$new_user_role}','{$new_username}','{$new_email}','{$new_password}')";
            $result_insert_user_data = mysqli_query($connection, $insert_user_data);
            if(!$result_insert_user_data){
                die('QUERY FAILED' . mysqli_error($connection));      
            } else {
                header("location: users.php");
            }                                   
    }
}


function delete_user(){
    if(isset($_GET['delete_user'])){
        global $connection;
        $deleted_id = $_GET['delete_user'];
        $query = "DELETE FROM users WHERE user_id = '{$deleted_id}'";
        $result = mysqli_query($connection, $query);

        if(!$result){
            die('QUERY FAILED' . mysqli_error($connection));
        }
    }
}

function view_users(){
    global $connection;

    $query = "SELECT * FROM users";
    $result = mysqli_query($connection, $query);
    return $result;
}

function update_users($id){
    if(isset($_POST['post_update_user'])){
        global $connection;
        $id = $_GET['update'];
        $new_firstname = $_POST['fname'];
        $new_lastname = $_POST['lname'];
        $new_user_role = $_POST['user_role'];
        $new_username = $_POST['username'];
        $new_email = $_POST['email'];
        $new_password = $_POST['password'];

        $query = "UPDATE users SET username = '{$new_username}',
        user_password = '{$new_password}',
        user_firstname = '{$new_firstname}',
        user_lastname = '{$new_lastname}',
        user_role = '{$new_user_role}',
        user_email = '{$new_email}' WHERE user_id = '{$id}'";  
        
        $result = mysqli_query($connection, $query);
        if(!$result){
            die('QUERY FAILED' . mysqli_error($connection));
        } else {
            header("location: users.php");
        }
    }
}

function update_users_self($id){
    global $connection;
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "UPDATE users SET user_firstname = '{$fname}', 
        user_lastname = '{$lname}',
        username = '{$username}',
        user_email = '{$email}',
        user_password = '{$password}'
        WHERE user_id = '{$id}'";
    
    $result = mysqli_query($connection, $query);
    if(!$result){
        die('QUERY FAILED' . mysqli_error($connection));
    } else {
        header("location: users.php");
    }
}

function view_specific_user($id){
    global $connection;
    $query = "SELECT * FROM users WHERE user_id ='{$id}'";
    $result = mysqli_query($connection, $query);
    return $result;
}

function count_post(){
    global $connection;
    $query = "SELECT COUNT(*) as hasil FROM posts";
    $result = mysqli_query($connection, $query);
    return $result;
}

function count_comments(){
    global $connection;
    $query = "SELECT COUNT(*) as hasil FROM comments";
    $result = mysqli_query($connection, $query);
    return $result;
}

function count_users(){
    global $connection;
    $query = "SELECT COUNT(*) as hasil FROM users";
    $result = mysqli_query($connection, $query);
    return $result;
}

function count_categories(){
    global $connection;
    $query = "SELECT COUNT(*) as hasil FROM categories";
    $result = mysqli_query($connection, $query);
    return $result;
}

function delete_categories($id){
    global $connection;
    $query = "DELETE FROM categories WHERE cat_id='{$id}'";
    $result = mysqli_query($connection, $query);
    if(!$result){
        die('QUERY FAILED' . mysqli_error($connection));
    } else {
        echo '
            <div class="success" style="background-color: #ddffdd; border-left: 6px solid #04AA6D;">
                        <p style="
                        align-items:center;
                        justify-content: center;
                        display: flex;
                        ">
                        <strong>Success!</strong>Your post has succesfully deleted</p>
                    </div>
            ';
    }
}

function registration_user(){
    global $connection;
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hash_password = password_hash($password, PASSWORD_DEFAULT);
    
    $query = "INSERT INTO users(username, user_email, user_password) VALUES ('{$username}','{$email}','{$hash_password}')";
    $result = mysqli_query($connection, $query);
    if(!$result){
        die('QUERY FAILED' . mysqli_error($connection));
    } else {
        echo '
            <div class="success" style="background-color: #ddffdd; border-left: 6px solid #04AA6D;">
                        <p style="
                        align-items:center;
                        justify-content: center;
                        display: flex;
                        ">
                        <strong>Success!</strong>Your account has succesfully created</p>
                    </div>
            ';
    }
    
}

function view_post_based_categories($post_category){
    global $connection;
    $query = "SELECT * FROM posts WHERE post_category_id = '{$post_category}'";
    $result = mysqli_query($connection, $query);
    return $result;
}

function is_exist($username){
    global $connection;
    $query = "SELECT COUNT(username) as amount_username FROM users WHERE username ='{$username}'";
    $result = mysqli_query($connection, $query);
    $result_count = mysqli_fetch_assoc($result);
    $count = $result_count['amount_username'];
    return $count;
}

function update_likes($id){
    global $connection;
    $query_get_post_like = "SELECT post_like FROM posts WHERE post_id = '{$id}'";
    $connection_select = mysqli_query($connection, $query_get_post_like);
    $result_select = mysqli_fetch_assoc($connection_select);
    $count = $result_select['post_like'];
    $new_count = $count + 1;
    $query_update = "UPDATE posts SET post_like = '{$new_count}' WHERE post_id = '{$id}'";
    $connection_update = mysqli_query($connection, $query_update);
    return $connection_update;
}

function update_unlikes($id){
    global $connection;
    $query_get_post_like = "SELECT post_like FROM posts WHERE post_id = '{$id}'";
    $connection_select = mysqli_query($connection, $query_get_post_like);
    $result_select = mysqli_fetch_assoc($connection_select);
    $count = $result_select['post_like'];
    $new_count = $count - 1;
    $query_update = "UPDATE posts SET post_like = '{$new_count}' WHERE post_id = '{$id}'";
    $connection_update = mysqli_query($connection, $query_update);
    return $connection_update;
}
?>