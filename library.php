<?php include "include/header.php"; ?>
<?php include "include/header_html.php"; ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco-navbar-light">
    <div class="container d-flex align-items-center px-4" id="navbar_main">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>
        <!-- search form -->
        <form action="<?= $_SERVER['PHP_SELF'] ?>?source=search" method="post" class="searchform order-lg-last">
            <div class="form-group d-flex">
                <input type="text" class="form-control pl-3" name="key" placeholder="Search">
                <button type="submit" name="search_btn_submit" class="form-control search"><span class="ion-ios-search"></span></button>
            </div>
        </form>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a href="./" class="nav-link pl-0">Home</a></li>
                <li class="nav-item"><a href="blog" class="nav-link">Blog</a></li>
                <li class="nav-item active"><a href="library" class="nav-link">Library</a></li>
            </ul>
        </div>
    </div>
</nav>

<?php
if (isset($_GET['source'])) {
    $source = escape($_GET['source']);
    switch ($source) {
        case 'book_school':
            include "library_school_books.php";
            break;
        case 'library':
            include "library_base.php";
            break;
        case 'search':
            include "library_search.php";
            break;
        default:
            include "library_intro.php";
            break;
    }
} else include "library_intro.php";
?>


<?php include "include/footer.php"; ?>