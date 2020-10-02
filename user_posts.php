<style> 
  .btn_user {
    display: inline-block;
    border-top: 2px solid transparent;
    border-bottom: 2px solid transparent;
    padding: 10px;
  }

  .btn_user:hover {
    border-bottom: 2px solid #0d1128;
    border-top: 2px solid #0d1128;
  }

  .btn_user_active {
    display: inline-block;
    border-top: 2px solid transparent;
    border-bottom: 2px solid #0d1128;
    padding: 10px;
  }

  .btn_user_active:hover {
    border-top: 2px solid #0d1128;
  }
</style>

<div class="row">
  <div class="col-sm-12 text-center btn-group-justified" style="background-color:#e3e3e3;display:inline-flex;">

    <hr>
    <a href="<?php echo $_SERVER['PHP_SELF'] ?>" class=" btn-lg">
      <div class="btn_user btn-lg">
        Dashboard
      </div>
    </a>

    <a href="<?php echo $_SERVER['PHP_SELF'] ?>?source=user_profile" class=" btn-lg">
      <div class="btn_user btn-lg">
        Profile
      </div>
    </a>
    <a href="<?php echo $_SERVER['PHP_SELF'] ?>?source=user_posts" class=" btn-lg">
      <div class="btn_user_active btn-lg">
        My posts
      </div>
    </a>
    <hr>

  </div>
</div>
<hr>
<div class="col-12 text-center bg-dark">
  <a class="btn-lg btn-info" href="create_post.php">Create post</a>
</div>
<hr>
<?php

if (isset($_GET['delete_post']) && !empty($_GET['post_id'])) {
  $id = $_GET['post_id'];

  $query = "DELETE from posts WHERE post_id = '$id'";
  $query = mysqli_query($connection, $query);

  if ($query) {
    echo "<div class='alert alert-success text-center'>deleted.<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
  } else  echo "<div class='alert alert-danger text-center'>" . mysqli_error($connection) . ".<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
}

if (isset($_GET['updated'])) {
  echo "<div class='alert alert-success text-center'>updated.<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
}


?>
<div class="row">
  <?php
  $user_author = $user['user_id'];

  $query = "SELECT * FROM posts WHERE post_author_id ='$user_author' ORDER BY post_id DESC ";
  $array_post = mysqli_query($connection, $query);

  while ($row = mysqli_fetch_assoc($array_post)) {

    $post_id = $row['post_id'];
    $post_title = $row['post_title'];
    $post_author = $row['post_author'];
    $post_demo = $row['post_demo'];
    $post_comment_count = $row['post_comment_count'];
    $post_image = $row['post_image'];
    $post_date = date_create($row['post_date']);
  ?>



    <!-- post content -->
    <div class="col-md-6 col-lg-4 m-4 ftco-animate">
      <div class="p-2 text-right" style="background-color:#e3e3e3;">

        <a href="<?php echo $_SERVER['PHP_SELF'] . '?source=user_posts_edit&post_id=' . $post_id; ?>" class="btn btn-outline-info">Edit</a>
        <a href="<?php echo $_SERVER['PHP_SELF'] . '?source=user_posts&delete_post&post_id=' . $post_id; ?>" class="btn btn-outline-danger">delete</a>

      </div>
      <div class="blog-entry">
        <a href="/blog-single/<?php echo $post_id ?>" class="block-20 d-flex align-items-end" style="background-image: url('images/<?php echo $post_image; ?> ');">
          <div class="meta-date text-center p-2">
            <!-- data -->
            <span class="day"><?php echo date_format($post_date, 'd'); ?></span>
            <span class="mos">
              <?php
              switch (date_format($post_date, 'm')) {
                case 1:
                  echo "Janeiro";
                  break;
                case 2:
                  echo "Fevereiro";
                  break;
                case 3:
                  echo "Março";
                  break;
                case 4:
                  echo "Abril";
                  break;
                case 5:
                  echo "Maio";
                  break;
                case 6:
                  echo "Junho";
                  break;
                case 7:
                  echo "Julho";
                  break;
                case 8:
                  echo "Agosto";
                  break;
                case 9:
                  echo "Setembro";
                  break;
                case 10:
                  echo "Outubro";
                  break;
                case 11:
                  echo "Novembro";
                  break;
                case 12:
                  echo "Dezembro";
                  break;
              }
              ?>
            </span>
            <span class="yr"><?php echo date_format($post_date, 'Y'); ?></span>
          </div>
        </a>
        <div class="text bg-white p-4">
          <!-- title -->
          <h3 class="heading"><a href="/blog-single/<?php echo $post_id ?>"><?php echo $post_title; ?></a></h3>
          <!-- content -->
          <p><?php echo $post_demo; ?></p>
          <div class="d-flex align-items-center mt-4">
            <p class="mb-0"><a href="/blog-single/<?php echo $post_id ?>" class="btn btn-primary"> Ver Mais <span class="ion-ios-arrow-round-forward"></span></a></p>
            <p class="ml-auto mb-0">
              <!-- author -->
              <a href="#" class="mr-2"><?php echo $post_author; ?></a>
              <!-- count of comments -->
              <a href="#" class="meta-chat"><span class="icon-chat"></span> <?php echo  $post_comment_count; ?>
              </a>
            </p>
          </div>
        </div>
      </div>

    </div>

  <?php } ?>
</div>