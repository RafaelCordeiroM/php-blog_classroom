<?php include "include/header.php" ?>
<?php include "include/header_html.php"; ?>
<!-- //////////////////////////// Nav Bar //////////////////////////////// -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container d-flex align-items-center px-4">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <!-- search form -->


        <form action="search.php" method="get" class="searchform order-lg-last">
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
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Blog<i class="ion-ios-arrow-forward"></i></span></p>
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
        <a href='category.php?category_id=<?= $id_cat ?>' class='btn btn-outline-dark m-2 <?php if ($_GET['category_id'] == $id_cat) echo "active"; ?>' id='<?= $id_cat ?>'>
            <img src="discipline-logo/<?php echo $row['cat_logo'] ?>" width="100px" class="rounded-circle" alt="">
            <br><?= $name_cat ?>
        </a>

    <?php } ?>
    <hr>

</div>
<!-- //////////////////////////////////POSTS////////////////////////////////// -->
<section class="ftco-section bg-light">
    <div class="container">
        <div class="row">
            <?php
            if (isset($_GET['search_btn_submit'])) {
                if (!empty($_GET['search_input'])) {

                    $search_input = escape($_GET['search_input']);
                    if ($user['user_role'] == 'teacher') {
                        $teacher = $user['username'];
                        $query = "SELECT * from posts WHERE post_tags like '%$search_input%' and post_author='{$teacher}'";
                    } else $query = "SELECT * from posts WHERE post_tags like '%$search_input%'; ";
                    $query_search = mysqli_query($connection, $query);

                    if ($connection) {
                        if (mysqli_num_rows($query_search) > 0) {

                            while ($row = mysqli_fetch_assoc($query_search)) {
                                $post_id = $row['post_id'];
                                $post_title = $row['post_title'];
                                $post_author = $row['post_author'];
                                $post_content = $row['post_content'];
                                $post_comment_count = $row['post_comment_count'];
                                $post_image = $row['post_image'];
                                $post_date = date_create($row['post_date']);


            ?>

                                <!-- post content -->
                                <div class="col-md-6 col-lg-4 ftco-animate">
                                    <div class="blog-entry">
                                        <a href="blog-single.php?page_id=<?php echo $post_id ?>" class="block-20 d-flex align-items-end" style="background-image: url('images/<?php echo $post_image; ?> ');">
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
                                                <span class="yr"><?php echo date_format($post_date, 'y'); ?></span>
                                            </div>
                                        </a>
                                        <div class="text bg-white p-4">
                                            <!-- title -->
                                            <h3 class="heading"><a href="blog-single.php?page_id=<?php echo $post_id ?>"><?php echo $post_title; ?></a></h3>
                                            <!-- content -->
                                            <p><?php echo $post_content; ?></p>
                                            <div class="d-flex align-items-center mt-4">
                                                <p class="mb-0"><a href="blog-single.php?page_id=<?php echo $post_id ?>" class="btn btn-primary"> Ver Mais <span class="ion-ios-arrow-round-forward"></span></a></p>
                                                <p class="ml-auto mb-0">
                                                    <!-- author -->
                                                    <a href="#" class="mr-2"><?php echo $post_author; ?></a>
                                                    <!-- count of comments -->
                                                    <a href="#" class="meta-chat"><span class="icon-chat"></span> <?php echo $post_comment_count; ?></a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

            <?php
                            }
                        } else {
                            echo "<div align='center' class='alert alert-warning col-sm-12' width='100%'>tag was not found!</div>";
                        }
                    }
                }
            }


            ?>

        </div>
    </div>
</section>

<?php include "include/footer.php" ?>