<?php include "include/header.php" ?>
<?php
if (isset($_POST['edit_post'])) {

    $post_id = $_POST['id'];
    $post_category_id = $_POST['category'];
    $post_title = $_POST['title'];

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_content = $_POST['content'];
    $post_demo = $_POST['demo'];
    $post_author = $user['username'];
    $post_tags = $_POST['tags'];
    $post_status = $_POST['status'];

    $query = "UPDATE posts SET post_title = '$post_title', post_category_id = '$post_category_id', ";
    $query .= "post_content = '$post_content', post_demo = '$post_demo', post_author = '$post_author', ";
    $query .= "post_tags = '$post_tags', post_status = '$post_status' ";

    if (!empty($post_image)) {
        move_uploaded_file($post_image_temp, "../images/$post_image");
        $query .= ", post_image = '$post_image' WHERE post_id = '$post_id'";

        $c = mysqli_query($connection, $query);
        header("location: user.php?source=user_posts&updated");
    } else {
        $query .= " WHERE post_id = '$post_id'";
        $c = mysqli_query($connection, $query);
        header("location:user.php?source=user_posts&updated");
    }
    if (!$c) echo mysqli_error($connection);
}

?>
<?php
if (isset($_GET['updated'])) {
    echo "<div class='alert alert-success text-center m-2'>Updated.<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
}

if (isset($_POST['update'])) {

    $column = escape($_POST['column']);
    $user_id = escape($user['user_id']);

    if ($column == 'user_password') {
        $query = "SELECT user_randSalt from users WHERE user_id='$user_id'";
        $query = mysqli_query($connection, $query);
        $salt = mysqli_fetch_assoc($query);
        $value = crypt($value, $salt['user_randSalt']);
    }
    if ($column == 'user_email' || $column == 'user_role') {
        die("Opss..");
    }
    if ($column == 'user_image') {

        $value = $_FILES['value']['name'];
        $value_temp = $_FILES['value']['tmp_name'];
        move_uploaded_file($value_temp, "images/$value");
    } else {

        $value = escape($_POST['value']);
    }

    $query = "UPDATE users set $column = '$value' WHERE user_id ='$user_id'";
    $query = mysqli_query($connection, $query);

    if ($query) {
        header("location:$_SERVER[PHP_SELF]");
    } else echo mysqli_error($connection);
}

?>
<?php include "include/header_html.php"; ?>
<style>
    select {
        width: 100%;
        padding: 16px 20px;
        border: none;
        border-radius: 4px;
        background-color: #f1f1f1;
    }
</style>
<!-- //////////////////////////// Nav Bar //////////////////////////////// -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco-navbar-light">
    <div class="container d-flex align-items-center px-4" id="navbar_main">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a href="/public_html" class="nav-link pl-0">Home</a></li>
                <li class="nav-item"><a href="blog" class="nav-link">Blog</a></li>
                <li class="nav-item"><a href="library" class="nav-link">Library</a></li>
            </ul>
        </div>
    </div>

</nav>
<?php


if (isset($_GET['source'])) {
    $source = escape($_GET['source']);
    switch ($source) {
        case 'user_posts':
            include "user_posts.php";
            break;
        case 'user_posts_edit':
            include "user_posts_edit.php";
            break;
        case 'user_profile':
                include "user_profile.php";
            break;
        default:
            include "user_dashboard.php";
            break;
    }
} else {
    include "user_dashboard.php";
}

?>







</div>
</div>

<?php include "include/footer.php" ?>