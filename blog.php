<?php include "include/header.php" ?>
<?php
function page_count()
{
  global $connection;
  $query_count = "SELECT * from posts WHERE post_status ='published'";
  $query_count = mysqli_query($connection, $query_count);
  $count = mysqli_num_rows($query_count);

  return ceil($count / 9);
}

if (isset($_GET['next'])) {
  $current_page = escape($_GET['page']);
  $next_page = $current_page + 1;
  if (!($current_page == page_count())) header("location:blog.php?page={$next_page}");
  else header("location:blog.php?page={$current_page}");
}
if (isset($_GET['previous'])) {
  $current_page = escape($_GET['page']);
  $previous_page = $current_page - 1;
  if (!($current_page == 1)) header("location:blog.php?page={$previous_page}");
  else header("location:blog.php?page={$current_page}");
}

?>
<?php include "include/header_html.php";?>
<!-- //////////////////////////// Nav Bar //////////////////////////////// -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco-navbar-light" id="ftco-navbar">
  <div class="container d-flex align-items-center px-4">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="oi oi-menu"></span> Menu
    </button>

    <!-- search form -->
    <form action="search" method="get" class="searchform order-lg-last">
      <div class="form-group d-flex">
        <input type="text" class="form-control pl-3" name="search_input" placeholder="Search">
        <button type="submit" name="search_btn_submit" class="form-control search"><span class="ion-ios-search"></span></button>
      </div>
    </form>


    <div class="collapse navbar-collapse" id="ftco-nav">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item"><a href="/public_html" class="nav-link pl-0">Home</a></li>
        <li class="nav-item active"><a href="blog" class="nav-link">Blog</a></li>
        <li class="nav-item"><a href="library" class="nav-link">Library</a></li>
      </ul>
    </div>
  </div>
</nav>


<!-- //////////////////////////////// MAIN nav ///////////////////////////////////////-->

<section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_6.jpg');">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text align-items-center justify-content-center">
      <div class="col-md-9 ftco-animate text-center">
        <h1 class="mb-2 bread">BLOG</h1>
        <p class="breadcrumbs"><span class="mr-2"><a href="/public_html">Home<i class="ion-ios-arrow-forward"></i></a></span> <span>Blog<i class="ion-ios-arrow-forward"></i></span></p>
      </div>
    </div>
  </div>
</section>


<!-- ////////////////////////////////Categories////////////////////////////////// -->
<div class="col-sm-12 text-center">
  <h3>Categories</h3>
  <?php

  $query = "SELECT * from categoria";
  $result = mysqli_query($connection, $query);
  while ($row = mysqli_fetch_assoc($result)) {
    $name_cat = $row['cat_title'];
    $id_cat = $row['cat_id'];
    ?>
        <a href='category/<?=$id_cat?>' class='btn btn-outline-dark m-2' id='<?=$id_cat?>'>
        <img src="discipline-logo/<?php echo $row['cat_logo'] ?>" width="100px" class="rounded-circle" alt="">
          <br><?=$name_cat?>
        </a>
      
 <?php } ?>


</div>
<hr>
<div class="col-12 text-center bg-dark">
  <a class="btn-lg btn-info" href="create_post.php">Create post</a>
</div>
<hr>
<!-- //////////////////////////////////POSTS////////////////////////////////// -->
<nav class="navbar navbar-lg">
  <ul class="pagination justify-content-end">
    <li class="page-item">
      <a class="page-link <?php if ($_GET['page'] == 1 || $_GET['page'] == null) echo "disabled" ?>" href="<?php if (!isset($_GET['page'])) echo $_SERVER['PHP_SELF'] . '?page=1';
                                                                                                            else echo $_SERVER['PHP_SELF'] . '?page=' . $_GET['page']; ?>&previous" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
    <?php
    $pages = page_count();
    if (isset($_GET['page'])) {
      $mark = $_GET['page'];
    } else $mark = 1;

    for ($i = 1; $i <= $pages; $i++) {
      $activator = "";
      if ($mark == $i) $activator = "active";
    ?>
      <li class="page-item <?= $activator ?>"><a class="page-link" href="blog.php?page=<?= $i ?>"><?= $i ?></a></li>
    <?php } ?>
    <li class="page-item">
      <a class="page-link <?php if ($_GET['page'] == page_count()) echo "disabled" ?>" href="<?php
                                                                                              if (!isset($_GET['page'])) echo $_SERVER['PHP_SELF'] . '?page=1';
                                                                                              else echo $_SERVER['PHP_SELF'] . '?page=' . $_GET['page']; ?>
                                                                                  &next" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
  </ul>
</nav>
<section class="ftco-section bg-light">
  <div class="container">
    <div class="row">

      <?php

      $posts_per_page = 9;
      if (isset($_GET['page'])) {
        $page = $_GET['page'];
      } else {
        $page = 1;
      }

      $page_b = ($page * $posts_per_page) - $posts_per_page;

      if($user['user_role']=='teacher'){
        $teacher = $user['username'];
        $query = "SELECT * FROM posts WHERE post_status ='published' and post_author='{$teacher}' ORDER BY post_id DESC LIMIT $page_b,$posts_per_page";
      }
      else $query = "SELECT * FROM posts WHERE post_status ='published' ORDER BY post_id DESC LIMIT $page_b,$posts_per_page";
      
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
        <div class="col-md-6 col-lg-4 ftco-animate">
          <div class="blog-entry">
            <a href="blog-single/<?php echo $post_id ?>" class="block-20 d-flex align-items-end" style="background-image: url('./images/<?php echo $post_image; ?> ');">
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
              <h3 class="heading"><a href="blog-single/<?php echo $post_id ?>"><?php echo $post_title; ?></a></h3>
              <!-- content -->
              <p><?php echo $post_demo; ?></p>
              <div class="d-flex align-items-center mt-4">
                <p class="mb-0"><a href="blog-single/<?php echo $post_id ?>" class="btn btn-primary"> Ver Mais <span class="ion-ios-arrow-round-forward"></span></a></p>
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
  </div>
</section>
<style>
  a.disabled {
    pointer-events: none;
    cursor: default;
  }
</style>
<hr>
<div class="col-sm-12 text-center">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link <?php if ($_GET['page'] == 1 || $_GET['page'] == null) echo "disabled" ?>" href="<?php if (!isset($_GET['page'])) echo $_SERVER['PHP_SELF'] . '?page=1';
                                                                                                            else echo $_SERVER['PHP_SELF'] . '?page=' . $_GET['page']; ?>&previous" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Previous</span>
      </a>
    </li>
    <?php
    $pages = page_count();
    if (isset($_GET['page'])) {
      $mark = $_GET['page'];
    } else $mark = 1;

    for ($i = 1; $i <= $pages; $i++) {
      $activator = "";
      if ($mark == $i) $activator = "active";
    ?>
      <li class="page-item <?= $activator ?>"><a class="page-link" href="blog.php?page=<?= $i ?>"><?= $i ?></a></li>
    <?php } ?>
    <li class="page-item">
      <a class="page-link <?php if ($_GET['page'] == page_count()) echo "disabled" ?>" href="<?php
                                                                                              if (!isset($_GET['page'])) echo $_SERVER['PHP_SELF'] . '?page=1';
                                                                                              else echo $_SERVER['PHP_SELF'] . '?page=' . $_GET['page']; ?>
                                                                                  &next" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        <span class="sr-only">Next</span>
      </a>
    </li>
  </ul>
</div>

<?php include "include/footer.php" ?>