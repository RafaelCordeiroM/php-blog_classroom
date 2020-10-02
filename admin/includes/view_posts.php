<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'delete' && !empty($_GET['id'])) {
        if ($user['user_role'] == "admin") {
            delete_post($_GET['id']);
        }
    } else {
        echo 'problem';
    }
}
if (isset($_POST['publish_post'])) {
    update_post();
}
if (isset($_GET['status'])) {

    if ($_GET['status'] == "published" || $_GET['status'] == "draft") {
        set_status_post($_GET['status'], $_GET['p_id']);
    }
}
if (isset($_GET['updated'])) {
    $page_id = $_GET['updated'];
    echo "<div class='alert alert-success'>updated successfully, <a href='../blog-single.php?page_id=$page_id'> go to post </a><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
}
if (isset($_GET['post_id']) && isset($_GET['post_status'])) {
    echo "<div class='alert alert-success'>Post with the id <b>" . $_GET['post_id'] . "</b> was updated successfully to <b>" . $_GET['post_status'] . "</b>.<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
}
if (isset($_POST['apply']) && !empty($_POST['check']) && isset($_POST['option_act'])) {

    post_mult_act($_POST['check'], $_POST['option_act']);
}
if (isset($_GET['clone'])) {
    $clone = $_GET['clone'];

    $query = "SELECT * from posts WHERE post_id ='$clone'";
    $query = mysqli_query($connection, $query);

    $row = mysqli_fetch_assoc($query);

    $post_category_id = $row['post_category_id'];
    $post_title = $row['post_title'];
    $post_date = $row['post_date'];
    $post_image = $row['post_image'];
    $post_content = $row['post_content'];
    $post_demo = $row['post_demo'];
    $post_author = $row['post_author'];
    $post_author_id = $row['post_author_id'];
    $post_tags = $row['post_tags'];
    $post_status = $row['post_status'];
    $post_comment_count = 0;

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



<form action="" method="post">
    <div class="col-sm-4">
        <select class="form-group" name="option_act" id="">
            <option value="" selected disabled hidden>--Select a option--</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
            <option value="delete">Delete</option>
        </select>
    </div>
    <div class="col-sm-4 button-group">
        <input type="submit" class="btn btn-success" name="apply" value="apply">
        <a href="posts.php?source=add_post" class="btn btn-primary">Add new</a>
    </div>

    <table class="table table-bordered table-hover  text-center ">

        <thead>
            <th><label>all<input type="checkbox" class="check-all"></label></th>
            <th></th>
            <th>id</th>
            <th>category_id</th>
            <th>title</th>
            <th>date</th>
            <th>image</th>
            <th>content</th>
            <th>demo</th>
            <th>author</th>
            <th>tags</th>
            <th>comment_count</th>
            <th>status</th>
        </thead>
        <tbody>

            <?php

            showTable_posts();

            ?>


        </tbody>
    </table>
</form>




<style>
    input[type=text] {
        border: none;
        border-bottom: 2px solid black;
    }

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

<div class="modal fade" id="modal_delete_post" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal post delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <a href='' class="btn btn-danger btn_delete">Delete</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>

$(document).ready(function(){

    $(".btn_modal_post_delete").on("click",function(){
        var link = $(this).attr("rel");
        link_delete = "posts.php?action=delete&id="+link;
        $(".btn_delete").attr("href",link_delete);
        $("#modal_delete_post").modal('show');
    });

});

</script>