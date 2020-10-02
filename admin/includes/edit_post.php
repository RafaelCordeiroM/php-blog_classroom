    <?php

    if(isset($_POST['publish_post'])){
        update_post();
    }
    if (isset($_GET['p_id'])) {
        $id = $_GET['p_id'];
        $query = "SELECT * from posts WHERE post_id='$id'";
        $data = mysqli_query($connection, $query);
        $data = mysqli_fetch_assoc($data);

        $post_id = $data['post_id'];
        $post_category_id = $data['post_category_id'];
        $post_title = $data['post_title'];
        $post_date = $data['post_date'];
        $post_image = $data['post_image'];
        $post_content = $data['post_content'];
        $post_demo = $data['post_demo'];
        $post_author = $data['post_author'];
        $post_tags = $data['post_tags'];
        $post_comment_count = $data['post_comment_count'];
        $post_status = $data['post_status'];
    }


    ?>
    <form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $post_id ?>">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" value="<?php echo $post_title ?>" name="title">
        </div>

        <div class="form-group">
            <select name="category" value="<?php echo $post_category_id ?>">

                <?php
                $query = "SELECT * from categoria";
                $data = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($data)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                ?>
                    <option value="<?php echo $cat_id; ?>" <?php if ($cat_id == $post_category_id) {
                                                                echo "selected";
                                                            } ?>>
                        <?php
                        echo $cat_title;
                        ?>
                    </option>

                <?php } ?>

            </select>
        </div>

        <div class="form-group">
            <label for="content">content</label>
            <textarea name="content" id="editor-content" cols="30" rows="10"><?php echo $post_content ?></textarea>
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
            <textarea class="form-control" name="demo" col="30" rows="5" maxlength="100"><?php echo $post_title ?></textarea>
        </div>
        <div class="form-group">
            <label for="image">image</label>
            <img src="../images/<?php echo $post_image?>" class="m-2" width="200px"alt="">
             
            <input type="file" class="form-control" value="" name="image">
        </div>
        <div class="form-group">
            <label for="author">author</label>
            <input type="text" value="<?php echo $post_author ?>" class="form-control" name="author">
        </div>
        <div class="form-group">
            <label for="tags">tags</label>
            <input type="text" value="<?php echo $post_tags ?>" class="form-control" name="tags">
        </div>
        <div class="form-group">
            <label for="status">status</label>
            <select name="status" value="<?php echo $post_status ?>">
                <option value="draft" <?php if ($post_status == "draft") {
                                            echo "selected";
                                        } ?>>draft</option>
                <option value="published" <?php if ($post_status == "published") {
                                                echo "selected";
                                            } ?>>published</option>
            </select>
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-primary" name="publish_post" value="Update">
        </div>
    </form>