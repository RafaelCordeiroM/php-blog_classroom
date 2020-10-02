<?php
if (isset($_GET['post_id'])) {
    $id = escape($_GET['post_id']);
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
else header("location: ./user.php?source=user_posts"); 
?>
<style>
  select {
    width: 100%;
    padding: 16px 20px;
    border: none;
    border-radius: 4px;
    background-color: #f1f1f1;
  }
</style>
<section>

    <div class="container mt-4 mb-4 p-2" style="background-color:#ececec;color:black;">
        <div class="col-sm-12">
            <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $post_id; ?>">
                    <div class="row">
                        <div class="col-sm-2"><label for="title">Title</label></div>
                        <div class="col-sm-10"><input type="text" class="form-control" value="<?php echo $post_title; ?>" name="title"></div>
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
                                    <option value="<?php echo $id; ?>" <?php if($post_category_id == $id) echo "selected";?>>
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
                        <div class="col-sm-10"><textarea name="content" id="editor-content" cols="30" rows="10"><?php echo $post_content; ?></textarea></div>
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
                        <div class="col-sm-10"><textarea class="form-control" name="demo" col="10" rows="3" maxlength="200"><?php echo $post_demo; ?></textarea></div>
                    </div>
                    <div class="row">
                        
                        <div class="col-sm-2"><label for="image">image</label></div>
                        <div class="col-sm-10"><img src="images/<?php echo $post_image;?>" width="100px" alt="" class="m-2"><input type="file" class="form-control" name="image"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2"><label for="tags">tags</label></div>
                        <div class="col-sm-10"><input type="text" value="<?php echo $post_tags; ?>" class="form-control" name="tags"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2"><label for="status">status</label></div>
                        <div class="col-sm-10">
                            <select name="status" id="">
                                <option value="draft"<?php if($post_status=="draft")echo "selected";?>>draft</option>
                                <option value="published"<?php if($post_status=="published")echo "selected";?>>published</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <input type="submit" class="btn btn-primary" name="edit_post" value="Publish">
                        </div>
                    </div>
                
            </form>
        </div>
    </div>
</section>
