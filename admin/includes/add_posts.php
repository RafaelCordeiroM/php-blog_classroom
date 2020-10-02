<?php

if (isset($_POST['publish_post'])) {
    $post_title = $_POST['title'];
    $post_category_id = $_POST['category'];
    $post_author = $_POST['author'];
    $query_author_id = "SELECT user_id from users WHERE username = '$post_author' ";
    $query_author_id = mysqli_query($connection,$query_author_id);
    if(mysqli_num_rows($query_author_id) != 0){
        
    $post_author_id = mysqli_fetch_assoc($query_author_id);
    $post_author_id = $post_author_id['user_id'];
    }
    else $post_author_id = 0;
    $post_status = $_POST['status'];
    $post_comment_count = 0;

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tags = $_POST['tags'];
    $post_content = $_POST['content'];
    $post_demo = $_POST['demo'];
    $post_date = date('Y-m-d');

    move_uploaded_file($post_image_temp, "../images/$post_image");

    if(!isset($post_image)){
        $post_image = "default_img.jpg";
    }

    $query = "INSERT into posts (post_category_id,post_title,post_date,post_image,post_content,post_demo,post_author,post_author_id,post_tags,post_comment_count,post_status)";
    $query .= " VALUES('{$post_category_id}','{$post_title}', '{$post_date}','{$post_image}','{$post_content}','{$post_demo}','{$post_author}','{$post_author_id}','{$post_tags}','{$post_comment_count}','{$post_status}')";

    if (mysqli_query($connection, $query)) {
        $post_id = mysqli_insert_id($connection);
        echo "<div class='alert alert-success'><a href='../blog-single.php?page_id=$post_id'>go to post</a></div>";
    } else {
        echo mysqli_error($connection);
    }
}

?>
<style>

    textarea {
        width: 100%;
        height: 150px;
        padding: 12px 20px;
        box-sizing: border-box;
        border: 2px solid #ccc;
        border-radius: 4px;
        background-color: #f8f8f8;
        resize: none;
    }

    select {
        width: 100%;
        padding: 16px 20px;
        border: none;
        border-radius: 4px;
        background-color: #f1f1f1;
    }
</style>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <label for="category">category</label>
        <select name="category">

            <?php

            $query = "SELECT * from categoria";
            $data = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($data)) {

                $id = $row['cat_id'];
                $title = $row['cat_title'];



            ?>
                <option value="<?php echo $id;?>">
                    <?php
                    echo $title;
                    ?>
                </option>

            <?php } ?>


        </select>

    </div>
 
    <div class="form-group">
            <label for="content">content</label>
            <textarea name="content" id="editor-content" cols="30" rows="10"></textarea>
        </div>
        <script>
            ClassicEditor
                .create(document.querySelector('#editor-content'))
                .catch(error => {
                    console.error(error);
                });
        </script>
    <div class="form-group">
        <label for="demo">demo</label>
        <textarea class="form-control" name="demo" col="10" rows="5" maxlength="200"></textarea>
    </div>
    <div class="form-group">
        <label for="image">image</label>
        <input type="file" class="form-control" name="image">
    </div>
    <div class="form-group">
        <label for="author">author</label>
        <input type="text" class="form-control" name="author">
    </div>
    <div class="form-group">
        <label for="tags">tags</label>
        <input type="text" class="form-control" name="tags">
    </div>
    <div class="form-group">
        <label for="status">status</label>
        <select name="status" id="">
                <option value="draft">draft</option>
                <option value="published">published</option>
        </select>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="publish_post" value="Publish">
    </div>
</form>
