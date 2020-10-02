<?php include "include/header.php"; ?>
<?php
if (isset($_GET['delete']) && isset($_GET['schedule_id'])) {

    $id = $_GET['schedule_id'];
    $query = "DELETE from schedule WHERE schedule_id ='$id' ";
    $delete = mysqli_query($connection, $query);
    if ($delete) {
        header("location:index.php");
    } else echo "<div class='alert alert-danger text-center col-sm-12'>" . mysqli_error($connection) . "</div>";
}

?>
<?php include "include/header_html.php"; ?>

<?php
function schedule($id)
{
    global $connection;
    $query = "SELECT * from schedule WHERE schedule_id = '$id'";
    $query = mysqli_query($connection, $query);
    if (mysqli_num_rows($query) > 0) {
        if ($query) {
            $data_schedule = mysqli_fetch_assoc($query);
            $date = date_create($data_schedule['schedule_date']);
            $schedule_discipline = $data_schedule['schedule_discipline'];
            $query_cat = "SELECT cat_title from categoria WHERE cat_id = '$schedule_discipline'";
            $query_cat = mysqli_query($connection, $query_cat);
            $cat_title = mysqli_fetch_assoc($query_cat);

            echo "
    <div class='container bg-calendar-div mt-2 mb-2' style='background-color:#eaeaea;'>
    <div class='row'>
        <div class='col-sm-12 text-right'>
        <a class='btn btn-light' href='" . $_SERVER['PHP_SELF'] . "?delete&schedule_id={$data_schedule['schedule_id']}'><h5>delete</h5></a>
            <a class='btn btn-light' href='./edit_schedule/{$data_schedule['schedule_id']}'><h5><b>&#9998;</b></h5></a>
        </div>
    </div>
        <div class='row'>
            <div class='col-sm-12 text-center'>
                <h1>{$data_schedule['schedule_title']}</h1>
                <div class='circle p-2'>
                    {$cat_title['cat_title']}
                </div>
                <div class='date_div p-2'>
                    <span class='day'>" . date_format($date, 'd') . "</span>
                    <span class='mos'> / " . date_format($date, 'm') . " / </span>
                    <span class='yr'>" . date_format($date, 'Y') . "</span>
                </div>
                <div>Author : " . $data_schedule['schedule_author'] . "</div>


            </div>
        </div>
        <hr>
        <div class='row'>
            <div class='col-sm-6 p-4 text-right'>
                <h3>Description</h3>
                {$data_schedule['schedule_content']}
            </div>
            <div class='col-sm-4  p-4 text-left' style='background-color:#232323; color:white;'>
                <h3 style='color:#9a9898;border-bottom:1px solid #9a9898;'>Topics</h3>
                 {$data_schedule['schedule_topic']}
            </div>
        </div>
    </div>
    ";
        } else {
            echo mysqli_error($connection);
        }
    } else {
        echo "<div class='alert alert-danger col-sm-12 text-center'>Page was not found</div>";
    }
}

?>

<!-- //////////////////////////// Nav Bar //////////////////////////////// -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container d-flex align-items-center px-4">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a href="./" class="nav-link pl-0">Home</a></li>
                <li class="nav-item"><a href="blog" class="nav-link">Blog</a></li>
                <li class="nav-item"><a href="library" class="nav-link">Library</a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- //////////////////////////////// MAIN nav ///////////////////////////////////////-->

<section class="hero-wrap hero-wrap-2" style="background-image: url('./images/bg_9.jpg');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <h1 class="mb-2 bread">Calendar</h1>
                <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Calendar<i class="ion-ios-arrow-forward"></i></span></p>
            </div>
        </div>
    </div>
</section>
<style>
    .date_div {
        display: inline-block;
        background: #5d50c6;
        font-size: 25px;
    }

    .date_div span {
        color: #fff;
    }

    .date_div.day {
        font-weight: 700;
        font-size: 25px;
    }

    .date_div .mos,
    .date_div .yr {
        font-size: 18px;
    }

    .circle {
        display: inline-block;
        border-radius: 30%;
        font-size: 20px;
        color: #fff;
        text-align: center;
        background: #fa623f;
    }
</style>

<?php
if (isset($_GET['updated'])) {
    echo "<div class='alert alert-success col-sm-12 text-center'>Updated<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
}

if (isset($_GET['mon']) && isset($_GET['day'])) {
    $month = $_GET['mon'];
    $day = $_GET['day'];

    $query = "SELECT * from schedule";
    $query = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($query)) {
        $date = date_create($row['schedule_date']);
        $month_data = date_format($date, "m");
        $day_data = date_format($date, "d");

        if ($day == $day_data && $month == $month_data) {
            $id = $row['schedule_id'];
            schedule($id);
        }
    }
}

?>
<?php
if (isset($_GET['single_s'])) {
    $id = $_GET['single_s'];
    schedule($id);
}
?>



<?php include "include/footer.php"; ?>