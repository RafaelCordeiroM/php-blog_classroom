<?php include "include/header.php" ?>
<?php
require 'vendor/autoload.php';
// $dotenv = Dotenv\Dotenv::create(__DIR__);
// $dotenv->load();
$options = array(
    'cluster' => 'us2',
    'useTLS' => true
  );
// 1 - key , 2 - secret, 3 - app_id , 4 - options(cluster)
$pusher = new \Pusher\Pusher('f92f49fbfb59f0c85915','dd7a20a51b8d96460a2e','941243',$options);


?>
<?php

if (isset($_POST['publish_post'])) {

    $post_title = escape($_POST['title']);
    $post_category_id = escape($_POST['category']);
    $post_author = $user['username'];
    $post_status = escape($_POST['status']);
    $post_comment_count = 0;

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tags = escape($_POST['tags']);
    $post_content = escape($_POST['content']);
    $post_demo = escape($_POST['demo']);
    $post_date = date('Y-m-d');
    $post_author_id = $user['user_id'];

    move_uploaded_file($post_image_temp, "images/$post_image");

    if(!isset($post_image)){
        $post_image = "default_img.jpg";
    }

    $query = "INSERT INTO posts (post_category_id,post_title,post_date,post_image,post_content,post_demo,post_author,post_tags,post_comment_count,post_status,post_author_id)";
    $query .= " VALUES('{$post_category_id}','{$post_title}','{$post_date}','{$post_image}','{$post_content}','{$post_demo}','{$post_author}','{$post_tags}','{$post_comment_count}','{$post_status}','{$post_author_id}')";

    if (mysqli_query($connection, $query)) {
        $post_id = mysqli_insert_id($connection);

        $data['message'] = "{$post_author}";
        $pusher->trigger('notifications','new_user',$data);

        echo "<div class='alert alert-success'><a href='blog-single.php?page_id=$post_id'>go to post</a></div>";
    } else {
        echo mysqli_error($connection);
    }
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
<nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container d-flex align-items-center px-4">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <!-- search form -->



        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a href="/public_html" class="nav-link pl-0">Home</a></li>
                <li class="nav-item active"><a href="blog" class="nav-link">Blog</a></li>
                <li class="nav-item"><a href="library" class="nav-link">Library</a></li>
            </ul>
        </div>
    </div>
</nav>


<section>

    <div class="container mt-4 mb-4 p-2" style="background-color:#ececec;color:black;">
        <div class="col-sm-12">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-2"><label for="title">Title</label></div>
                    <div class="col-sm-10"><input type="text" class="form-control" name="title"></div>
                </div>
                <div class="row">
                    <div class="col-sm-2"><label for="category">category</label></div>
                    <div class="col-sm-10">
                        <select name="category">

                            <?php

                            $query = "SELECT * from categoria";
                            $data = mysqli_query($connection, $query);

                            while ($row = mysqli_fetch_assoc($data)) {

                                $id = $row['cat_id'];
                                $title = $row['cat_title'];



                            ?>
                                <option value="<?php echo $id; ?>">
                                    <?php
                                    echo $title;
                                    ?>
                                </option>

                            <?php } ?>


                        </select>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-2"><label for="content">content</label></div>
                    <div class="col-sm-10"><textarea name="content" id="editor-content" cols="30" rows="10"></textarea></div>
                </div>
                <script>
                    ClassicEditor
                        .create(document.querySelector('#editor-content'))
                        .catch(error => {
                            console.error(error);
                        });
                </script>
                <div class="row">
                    <div class="col-sm-2"><label for="demo">demo</label></div>
                    <div class="col-sm-10"><textarea class="form-control" name="demo" col="10" rows="3" maxlength="200"></textarea></div>
                </div>
                <div class="row">
                    <div class="col-sm-2"><label for="image">image</label></div>
                    <div class="col-sm-10"><input type="file" class="form-control" name="image"></div>
                </div>
                <div class="row">
                    <div class="col-sm-2"><label for="tags">tags</label></div>
                    <div class="col-sm-10"><input type="text" class="form-control" name="tags"></div>
                </div>
                <div class="row">
                    <div class="col-sm-2"><label for="status">status</label></div>
                    <div class="col-sm-10">
                        <select name="status" id="">
                            <option value="draft">draft</option>
                            <option value="published">published</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <input type="submit" class="btn btn-primary" name="publish_post" value="Publish">
                    </div>
                </div>

            </form>
        </div>
    </div>
</section>




<?php include "include/footer.php" ?>