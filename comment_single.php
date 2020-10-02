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
<div class="row">
<div class="col-sm-3"></div>    
<div class="comments col-sm-6">
    <fieldset class="border p-5">
        <legend>
            <a href="./comment_single/<?= $post_id ?>">
                <h3 class="mb-5 h4 font-weight-bold">
                    <?php
                    $n = "SELECT * from comments where comment_post_id = '{$_GET['post_id']}'";
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
            $post_id = $_GET['post_id'];
            $query_comment = "SELECT * from comments where comment_post_id='$post_id' and comment_status='approved'";
            $query_comment .= " ORDER by comment_id DESC";
            $query_comment = mysqli_query($connection, $query_comment);
            while ($comment_chara = mysqli_fetch_assoc($query_comment)) {
                $date = date_create($comment_chara['comment_date']);
                $date = date_format($date, 'd') . "/" . date_format($date, 'm') . "/" . date_format($date, 'Y') . " as " . date_format($date, 'H') . ":" . date_format($date, 'i');

            ?>

                <li class="comment p-2" style="background:lightsalmon;border-radius:20%;">
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
                        <hr>
                        <p><?php echo $comment_chara['comment_content']; ?></p>
                    </div>
                </li>
            <?php } ?>

        </ul>
    </fieldset>
</div>
</div>


<?php include "include/footer.php"; ?>