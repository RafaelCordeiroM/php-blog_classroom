<?php include "include/header.php"; ?>
<?php include "include/header_html.php";?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco-navbar-light" id="ftco-navbar">
  <div class="container d-flex align-items-center px-4">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="oi oi-menu"></span> Menu
    </button>
    <form action="#" class="searchform order-lg-last">
      <div class="form-group d-flex">
        <input type="text" class="form-control pl-3" placeholder="Search">
        <button type="submit" placeholder="" class="form-control search"><span class="ion-ios-search"></span></button>
      </div>
    </form>
    <div class="collapse navbar-collapse" id="ftco-nav">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item"><a href="./" class="nav-link pl-0">Home</a></li>
        <li class="nav-item active"><a href="./blog" class="nav-link">Blog</a></li>
        <li class="nav-item"><a href="./library" class="nav-link">Library</a></li>
      </ul>
    </div>
  </div>
</nav>
<!-- END nav -->

<section class="hero-wrap hero-wrap-2" style="background-image: url('./images/bg_2.png');">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text align-items-center justify-content-center">
      <div class="col-md-9 ftco-animate text-center">
        <h1 class="mb-2 bread">Blog Single</h1>
        <p class="breadcrumbs"><span class="mr-2"><a href=".">Home <i class="ion-ios-arrow-forward"></i></a></span> <span class="mr-2"><a href="blog.php">Blog <i class="ion-ios-arrow-forward"></i></a></span> <span>Blog Single <i class="ion-ios-arrow-forward"></i></span></p>
      </div>
    </div>
  </div>
</section>

<?php

if (isset($_GET['page_id'])) {

  $id = escape($_GET['page_id']);

  $query = "SELECT * from posts WHERE post_id = {$id}";
  $data = mysqli_query($connection, $query);
  $row = mysqli_fetch_assoc($data);

  if ($row['post_status'] == 'published') {
    $post_id = $row['post_id'];
    $post_title = $row['post_title'];
    $post_author = $row['post_author'];
    $post_demo = $row['post_demo'];
    $post_comment_count = $row['post_comment_count'];
    $post_image = $row['post_image'];
    $post_content = $row['post_content'];
    $post_date = date_create($row['post_date']);

?>

    <section class="ftco-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-10 ftco-animate">

            <hr>

            <div class="about-author d-flex p-4 bg-light">
              <div class="bio mr-5">
                <?php $query = "SELECT user_image from users WHERE username ='$post_author'";
                $query = mysqli_query($connection, $query);
                $user_image = mysqli_fetch_assoc($query);
                ?>
                <img src="./images/<?= $user_image['user_image'] ?>" alt="User image" class="img-fluid mb-4 rounded-circle" width="70px">
              </div>
              <div class="desc">
                <h3><?php echo $post_author ?></h3>
                <p><i class="fa fa-clock-o"> </i><?php echo " " . date_format($post_date, "d") . " / " . date_format($post_date, "m") . " / " . date_format($post_date, "Y") ?></p>
              </div>
            </div>

            <hr>

            <h2 class="mb-3"><?php echo $post_title ?></h2>
            <div class="p-4 m-4 bg-light">
              <?php echo $post_demo ?>
            </div>

            <div style="background-image: url(./images/<?= $post_image ?>);background-position:center;background-repeat:no-repeat;background-size:cover;width:100%;height:200px;">
            </div>

            <div class="p-4 m-4 bg-light">
              <?php echo $post_content ?>
            </div>

            <?php

            if (isset($_POST['comm-post'])) {

              $array_comment_data = array('author' => $_POST['comm-author'], 'email' => $_POST['comm-email'], 'message' => $_POST['comm-message'], "post_id" => $_GET['page_id']);
              comment_post($array_comment_data);
            }
            ?>
    
            <div class="pt-5 mt-5">

              <div class="comments">
                <fieldset class="border p-5">
                  <legend>
                    <a href="./comment_single/<?= $post_id ?>">
                      <h3 class="mb-5 h4 font-weight-bold">
                        <?php
                        $n = "SELECT * from comments where comment_post_id = '{$_GET['page_id']}'";
                        $n = mysqli_query($connection, $n);
                        $comment_count = mysqli_num_rows($n);
                        echo $comment_count;
                        ?>
                        Comments
                      </h3>
                    </a>
                  </legend>
                  <ul class="comment-list">

                    <?php
                    $page_id = $_GET['page_id'];
                    $query_comment = "SELECT * from comments where comment_post_id='$page_id' and comment_status='approved'";
                    $query_comment .= " ORDER by comment_id DESC";
                    $query_comment = mysqli_query($connection, $query_comment);
                    while ($comment_chara = mysqli_fetch_assoc($query_comment)) {
                      $date = date_create($comment_chara['comment_date']);
                      $date = date_format($date, 'd') . "/" . date_format($date, 'm') . "/" . date_format($date, 'Y') . " as " . date_format($date, 'H') . ":" . date_format($date, 'i');

                    ?>

                      <li class="comment p-2" style="background:lightsalmon;border-radius:10%;">
                        <div class="vcard bio">
                          <?php
                          $username = $comment_chara['comment_author'];
                          $query = mysqli_query($connection, "SELECT user_image from users where username = '$username'");
                          $image = mysqli_fetch_assoc($query);
                          ?>
                          <img src="./images/<?php echo $image['user_image']; ?>" alt="Image placeholder">
                        </div>
                        <div class="comment-body">
                          <h3><?php echo $comment_chara['comment_author']; ?></h3>
                          <div class="meta mb-2"><?php echo $date; ?></div>
                          <p><?php echo $comment_chara['comment_content']; ?></p>
                        </div>
                      </li>
                    <?php } ?>

                  </ul>
                </fieldset>
              </div>
              <!-- END comment-list -->



              <div class="comment-form-wrap pt-5">
                <h3 class="mb-5 h4 font-weight-bold">Comentário</h3>

                <form action="" method="post" class="p-5" style="background-color:#d6d6d6">

                  <input type="hidden" name="comm-author" value="<?php echo $user['username']; ?>">
                  <input type="hidden" name="comm-email" value="<?php echo $user['user_email']; ?>">

                  <div class="form-group">
                    <label for="message">Mensagem</label>
                    <textarea name="comm-message" id="message" cols="30" rows="10" class="form-control" required></textarea>
                  </div>
                  <div class="form-group">
                    <input type="submit" value="Postar" name="comm-post" class="btn py-3 px-4 btn-primary">
                  </div>

                </form>
              </div>
            </div>
          </div> <!-- .col-md-8 -->


        </div>
      </div>
    </section>
<?php

  } else {
    die("<div class='alert alert-warning col-sm-12 text-center'>page is not published!</div>");
  }
} else {
  die("<div class='alert alert-warning col-sm-12 text-center'>page was not found!</div>");
}


?>

<?php include "include/footer.php"; ?>