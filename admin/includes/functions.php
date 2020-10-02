<?php

function user_online()
{
    if (isset($_GET['request'])) {
        global $connection;
        if(!$connection){
            include('../../include/db.php');
        }
        session_start();
        $session = session_id();
        $time = time();
        $time_out = $time - 30;
        $query = mysqli_query($connection, "SELECT * from users_online where session = '$session'");
        if (mysqli_num_rows($query) == null) {
            $query = mysqli_query($connection, "INSERT INTO users_online(session,time) VALUES('$session','$time')");
        } else {

            $query = mysqli_query($connection, "UPDATE users_online SET time ='$time' WHERE session = '$session'");
        }

        $query = mysqli_query($connection,"SELECT * from users_online where time > '$time_out'");
        echo mysqli_num_rows($query);
    }
}
user_online();
function table_category()
{

    global $connection;

    $query = "SELECT * from categoria";
    $data = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($data)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        $cat_logo = $row['cat_logo'];

        $link_delete =  "{$_SERVER['PHP_SELF']}?action=delete&id={$cat_id}";
        echo "<tr>";
        echo "<input type='hidden' name='cat_logo' id='cat_logo' value='" . $row['cat_logo'] . "'>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><img src='../discipline-logo/{$cat_logo}' width='100px' class='rounded-circle'></td>";
        echo "
        <td> 

        <form method='get' action='{$_SERVER['PHP_SELF']}'>
            <a class='btn btn-danger' href='$link_delete'>delete</a>
        </form>
      
        <button class='btn btn-secondary modal-call'>update</button>
            
     
        </td>";

        echo "</tr>";
    }
}

function delete_data(int $id, string $table)
{

    global $connection;

    $query = "DELETE from $table ";
    $query .= "WHERE cat_id = '$id';";


    if ($er = mysqli_query($connection, $query)) echo "deleted successfully";
    else echo mysqli_error($connection);
    header("location:categories.php");
}

function add_category(string $title)
{
    global $connection;
    $logo = $_FILES['cat_logo']['name'];
    $logo_temp = $_FILES['cat_logo']['tmp_name'];
    move_uploaded_file($logo_temp, "../discipline-logo/$logo");
    $query = mysqli_prepare($connection,"INSERT INTO categoria (cat_title,cat_logo) value(?,?)");
    mysqli_stmt_bind_param($query,"ss",$title,$logo);
    mysqli_stmt_execute($query);
    if ($query) {

        echo "
        <br>
        <div class='alert alert-success' role='alert'>
        $title was added successfully.<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        </div>
        ";
    }
    mysqli_stmt_close($query);
}
function update_data(string $id, string $title, string $table)
{

    global $connection;


    $query = "UPDATE $table SET cat_title='$title'";

    if (isset($_FILES['cat_logo'])) {
        $logo = $_FILES['cat_logo']['name'];
        $logo_temp = $_FILES['cat_logo']['tmp_name'];
        move_uploaded_file($logo_temp, "../discipline-logo/$logo");
        $query .= ",cat_logo='$logo' where cat_id='$id'";
        header("location:categories.php");
        
    }else {
        $query .= " WHERE cat_id='$id'";
        header("location:categories.php");
    }

    if (mysqli_query($connection, $query)) echo "great";
    else echo mysqli_error($connection);
}
function showTable_posts()
{

    global $connection;

    $query = "SELECT * from posts";
    $data = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($data)) {
        $post_id = $row['post_id'];
        $post_category_id = $row['post_category_id'];
        $post_title = $row['post_title'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
        $post_demo = $row['post_demo'];
        $post_author = $row['post_author'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_status = $row['post_status'];

        echo "<tr>";
        echo "<td><input type='checkbox' class='form-control check-target' name='check[]' value='$post_id'></td>";

        echo "<td>
        
        <a href='posts.php?source=edit_post&p_id=$post_id' class='btn btn-primary'>Edit</a>
        <a rel='$_SERVER[PHP_SELF]?action=delete&id=$post_id' href='javascript:void(0)' class='btn btn-danger btn_modal_post_delete'>delete</button>
        <a href='../blog-single.php?page_id=$post_id' class='btn btn-success'>View</a>
        <a href='posts.php?clone=$post_id' class='btn btn-warning'>clone</a>
        </td>";
        echo "<td>$post_id</td>";

        //show entire title of category
        $query_cat = "SELECT cat_title from categoria WHERE cat_id ='$post_category_id'";
        $the_cat_title = mysqli_query($connection, $query_cat);
        $the_cat_title = mysqli_fetch_assoc($the_cat_title);
        echo "<td>{$the_cat_title['cat_title']}</td>";

        echo "<td>$post_title</td>";
        echo "<td>$post_date</td>";
        echo "<td><img src='../images/$post_image' width='100' ></td>";
        echo "<td id='content-id' value='$post_content'>$post_content</td>";
        echo "<td>$post_demo</td>";
        echo "<td>$post_author</td>";
        echo "<td>$post_tags</td>";
        echo "<td>$post_comment_count</td>";
        echo "<td>$post_status</td>";

        if ($post_status == "draft") {
            echo "
        <td> 
            <a class='btn btn-primary'href='$_SERVER[PHP_SELF]?status=published&p_id=$post_id'>Publish</a> 
        </td>
        ";
        } else if ($post_status == "published") {
            echo "
            <td>
                <a class='btn btn-danger' href='$_SERVER[PHP_SELF]?status=draft&p_id=$post_id'>Draft</a>            
            </td>
            ";
        }
        echo "</tr>";
    }
}

function delete_post(string $id)
{

    global $connection;

    $query = "DELETE from posts WHERE post_id = '$id'";
    if (mysqli_query($connection, $query)) {
        echo "
        <div class='alert alert-success'>
        <strong>Post was deleted.<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></strong> 
      </div>";
    } else {
        echo mysqli_error($connection);
    }
}

function update_post()
{
    global $connection;

    $post_id = $_POST['id'];
    $post_category_id = $_POST['category'];
    $post_title = $_POST['title'];

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_content = $_POST['content'];
    $post_demo = $_POST['demo'];
    $post_author = $_POST['author'];
    $post_tags = $_POST['tags'];
    $post_status = $_POST['status'];

    $query = "UPDATE posts SET post_title = '$post_title', post_category_id = '$post_category_id', ";
    $query .= "post_content = '$post_content', post_demo = '$post_demo', post_author = '$post_author', ";
    $query .= "post_tags = '$post_tags', post_status = '$post_status' ";

    if (!empty($post_image)) {
        move_uploaded_file($post_image_temp, "../images/$post_image");
        $query .= ", post_image = '$post_image' WHERE post_id = '$post_id'";

        $c = mysqli_query($connection, $query);
        header("location:posts.php?updated=$post_id");
    } else {
        $query .= " WHERE post_id = '$post_id'";
        $c = mysqli_query($connection, $query);
        header("location:posts.php?updated=$post_id");
    }
    if (!$c) echo mysqli_error($connection);
}

function post_mult_act($array_id, $action)
{
    global $connection;
    switch ($action) {
        case "delete":
            foreach ($array_id as $id) {
                $query = "DELETE from posts WHERE post_id='$id'";
                $query = mysqli_query($connection, $query);
                if ($query) {
                    echo "<div class='alert alert-success col-sm-12 text-center'>Deleted successfully.<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
                } else {
                    echo mysqli_error($connection);
                }
            }

            break;
        case "published" || "draft":
            foreach ($array_id as $id) {
                $query = "UPDATE posts SET post_status='$action' WHERE post_id='$id'";
                $query = mysqli_query($connection, $query);

                if ($query) {
                    echo "<div class='alert alert-success col-sm-12 text-center'>Updated successfully.<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
                } else {
                    echo mysqli_error($connection);
                }
            }

            break;
    }
}

function delete_comment($id, $p_id)
{

    global $connection;

    $query = "DELETE from comments where comment_id ='$id'";
    $query_delete = mysqli_query($connection, $query);

    if ($query_delete) {
        $query = "UPDATE posts SET post_comment_count = post_comment_count - 1 WHERE post_id = '$p_id'";
        if (mysqli_query($connection, $query)) {
        }
        header("location:$_SERVER[PHP_SELF]");
    }
}

function set_status_comment($comment_id, $status)
{

    global $connection;

    $query = "UPDATE comments SET comment_status='$status' WHERE comment_id='$comment_id'";

    if (mysqli_query($connection, $query)) {
        header("location:$_SERVER[PHP_SELF]");
    }
}

function set_status_post($status, $id)
{
    global $connection;

    $query = "UPDATE posts SET post_status ='$status' WHERE post_id = '$id' ";

    if (mysqli_query($connection, $query)) {
        header("location:$_SERVER[PHP_SELF]?post_id=$id&post_status=$status");
    } else {
        echo "<script>alert(" . mysqli_error($connection) . ")</script>";
    }
}

function delete_user($id)
{
    global $connection;

    $query = "DELETE from users where user_id ='$id'";
    $r = mysqli_query($connection, $query);
    if (!$r) {
        echo "<script>alert(" . mysqli_error($connection) . ")</script>";
    }
}

function edit_user()
{
    global $connection;
    $salt = $_POST['salt'];
    $user_id = $_POST['id_user'];
    $username = $_POST['username_user'];
    $user_email = $_POST['email_user'];
    $user_firstname = $_POST['firstname_user'];
    $user_lastname = $_POST['lastname_user'];
    $user_role = $_POST['role_user'];
    $user_image = null;

    $user_oldPass = $_POST['oldPassword_user'];
    $user_newPass = $_POST['newPassword_user'];

    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];
    move_uploaded_file($user_image_temp, "../images/$user_image");

    echo "<script>alert(" . $user_image . ")</script>";

    $query = "UPDATE users SET username='{$username}', user_email='{$user_email}', user_firstname='{$user_firstname}', user_lastname='{$user_lastname}',user_role = '{$user_role}' ";
    if (empty($user_image)) $query .= "WHERE user_id = {$user_id}";
    else $query .= ",user_image='$user_image' WHERE user_id = {$user_id}";

    $q = mysqli_query($connection, $query);
    if (!$q) echo mysqli_error($connection);

    if (!empty($user_oldPass) && !empty($user_newPass)) {
        $query = "SELECT user_password from users WHERE user_id='$user_id'";
        $query = mysqli_query($connection, $query);
        $pass = mysqli_fetch_assoc($query);

        if (crypt($user_oldPass, $salt) == $pass['user_password']) {
            $user_newPass = crypt($user_newPass, $salt);
            $c = mysqli_query($connection, "UPDATE users SET user_password='$user_newPass'");
            echo "<div class='alert alert-success col-sm-12 text-center'>password updated.<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
        } else {
            echo "<div class='alert alert-warning col-sm-12 text-center'>password does not coincide with the old one.<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
        }
    }
}

function add_user()
{
    global $connection;

    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $salt = substr(str_shuffle($permitted_chars), 0, 22);
    $username = $_POST['username_user'];
    $user_email = $_POST['email_user'];
    $user_firstname = $_POST['firstname_user'];
    $user_lastname = $_POST['lastname_user'];
    $user_role = $_POST['role_user'];
    $user_image = "default_avatar.jpg";

    if (isset($_FILES['image'])) {
        $user_image = $_FILES['image']['name'];
        $user_image_temp = $_FILES['image']['tmp_name'];
        move_uploaded_file($user_image_temp,"../images/$user_image");
    }

    if ($_POST['password_user'] == $_POST['password__user']) {
        $user_password = $_POST['password_user'];
        $user_password = crypt($user_password, $salt);
        $query = "INSERT INTO users (username,user_password,user_firstname,user_lastname,user_email,user_role,user_image,user_randSalt)";
        $query .= " VALUES ('$username','$user_password','$user_firstname','$user_lastname','$user_email','$user_role','$user_image','$salt');";

        if (mysqli_query($connection, $query)) echo "<div class='alert alert-success col-sm-12 text-center'>user added.<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
        else echo "<div class='alert alert-warning col-sm-12 text-center'>" . mysqli_error($connection) . "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
    }
}

function edit_schedule()
{
    global $connection;

    $date = $_POST['schedule_date'];
    $title = $_POST['schedule_title'];
    $content = $_POST['schedule_content'];
    $author = $_POST['schedule_author'];
    $discipline = $_POST['schedule_discipline'];
    $topic = $_POST['schedule_topic'];

    $id = $_POST['schedule_id'];

    $query = "UPDATE schedule SET schedule_date='$date', schedule_title='$title', schedule_content='$content', schedule_author='$author', schedule_discipline='$discipline', schedule_topic='$topic' ";
    $query .= " WHERE schedule_id ='$id' ";

    $query = mysqli_query($connection,$query);

    if ($query) {
        echo "<div class='alert alert-success col-sm-12 text-center'>Updated<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
    } else echo "ops.." . mysqli_error($connection);
}
function delete_schedule($id)
{

    global $connection;
    $query = "DELETE from schedule where schedule_id='$id'";
    $query = mysqli_query($connection, $query);

    if ($query) echo "<div class='alert alert-success col-sm-12 text-center'>Deleted<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
    else echo mysqli_error($connection);
}
