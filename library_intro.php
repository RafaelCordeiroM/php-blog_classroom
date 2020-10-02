<style>
    .block_book {
        padding: 100px;
        text-align: center;
        vertical-align: middle;
        line-height: 90px;
        color: white;
    }

    .block_book:hover {
        -webkit-box-shadow: 0px 0px 8px 0px rgba(0, 0, 0, 0.87);
        -moz-box-shadow: 0px 0px 8px 0px rgba(0, 0, 0, 0.87);
        box-shadow: 0px 0px 8px 0px rgba(0, 0, 0, 0.87);
    }

    .block_book h1 {
        color: white;
    }

    .btn-1 {
        border: 2px solid black;
        transition-duration: 0.5s;
    }

    .btn-1:hover {
        border: 2px solid #dc3545;
        background-color: #dc3545;

    }

    .btn-1:hover h1 {
        color: white;
        letter-spacing: 3px;
        text-decoration: underline;
    }

    .btn-1 h1 {
        color: black;
    }

    .btn-2 {
        transition-duration: 0.5s;
    }

    .btn-2:hover h1 {
        letter-spacing: 3px;
        text-decoration: underline;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-sm-6" align="right">
            <a href="<?php echo $_SERVER['PHP_SELF'] ?>?source=book_school" class="block_book_a">
                <div class="block_book btn-1 m-4 p-4">
                    <h1><i class="fa fa-book"></i> School Books</h1>
                </div>
            </a>
        </div>
        <div class="col-sm-6 " align="left">
            <a href="<?php echo $_SERVER['PHP_SELF'] ?>?source=library" class="block_book_a">
                <div class="block_book bg-info btn-2 m-4 p-4">
                    <h1><i class="fa fa-archive"></i> Library</h1>
                </div>
            </a>
        </div>
    </div>
</div>