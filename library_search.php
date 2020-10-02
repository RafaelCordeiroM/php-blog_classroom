<?php
if (isset($_POST['key'])) {
    $key = escape($_POST['key']);
    $query = "SELECT * from books where book_title LIKE '%$key%' or book_user LIKE '%$key%'";
    $query .= "or book_author LIKE '%$key%' or book_description LIKE '%$key%'";

    $query = mysqli_query($connection, $query);
    if (!$query) {
        die("<div class='alert alert-warning'>" . mysqli_error($connection) . "</div>");
    }
} else die("<div class='alert alert-warning'>Opss.</div>");

if (mysqli_num_rows($query) == 0) die("<div class='alert alert-warning'><h1 style='font-family:auto;'>No results to :" . $key . "</h1>.</div>");

?>

<div class="row d-flex">
    <div class="col-sm-2"></div>
    <div class="col-sm-8 m-3 border" style="">
        <?php
        echo "<h3 style='letter-spacing:5px;font-family:auto;'>" . mysqli_num_rows($query) . " Results to: '" . $key . "'</h3>";
        echo "<hr>";
        while ($row = mysqli_fetch_assoc($query)) {
            $date = date_create($row['book_date']);
            if ($row['book_user'] == $user['username']) {
                echo "<div class='col-sm-12 text-right'><a class='btn btn-danger' href='" . $_SERVER['PHP_SELF'] . "?source=library_search&delete=" . $row['book_id'] . "'>X</a></div>";
            }
        ?>

            <div class='row list-group-item hoverDiv ' style='background-color:#f1f1f1;margin:0 0 10px 0;border-left:3px solid #107cfab3;'>
                <i class='fa fa-book' style='font-size:25px;color:#007bff;'></i>
                <?= date_format($date, "d") ?>/<?= date_format($date, "m") ?>/<?= date_format($date, "Y") ?>
                &#128336;
                <hr>
                <div class="d-flex">
                    <div class="col-sm-2">
                        book thumbnail
                    </div>
                    <div class='col-sm-4'>
                        <div class='d-flex'>
                            Title:&nbsp;&nbsp;&nbsp;<h5> <?= $row['book_title'] ?></h5>
                        </div>
                        <div class='d-flex'>
                            Author:&nbsp;&nbsp;&nbsp;<h5> <?= $row['book_author'] ?></h5>
                        </div>
                    </div>
                </div>
                <hr>
                <div class='col-sm-6'>
                    <button class='btn btn-outline-primary' type='button' data-toggle='collapse' data-target='#collapse<?= $row['book_id'] ?>' aria-expanded='false' aria-controls='collapseExample'>
                        Description &dArr;
                    </button>
                    <a href='books/<?= $row['book_src'] ?>' target='_blank' class='btn btn-dark'>View <i class='fa fa-eye'></i></a>
                </div>
                <div class='collapse' id='collapse<?= $row['book_id'] ?>'>
                    <div class='card card-body'>
                        <?= $row['book_description'] ?>
                    </div>
                </div>


            </div>
        <?php } ?>
    </div>
</div>