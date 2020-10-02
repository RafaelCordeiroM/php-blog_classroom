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
            <div class="btn_user_active btn-lg">
                Dashboard
            </div>
        </a>

        <a href="<?php echo $_SERVER['PHP_SELF'] ?>?source=user_profile" class=" btn-lg">
            <div class="btn_user btn-lg">
                Profile
            </div>
        </a>
        <a href="<?php echo $_SERVER['PHP_SELF'] ?>?source=user_posts" class=" btn-lg">
            <div class="btn_user btn-lg">
                My posts
            </div>
        </a>
        <hr>

    </div>
</div>
<hr>
<?php
//first graph
$username = $user['username'];
$q = mysqli_query($connection, "SELECT * from posts where post_author = '$username'");
$post_count = mysqli_num_rows($q);

$q = mysqli_query($connection, "SELECT * from comments where comment_author = '$username'");
$comment_count = mysqli_num_rows($q);

$q = mysqli_query($connection, "SELECT * from books where book_author = '$username'");
$files_count = mysqli_num_rows($q);

$q = mysqli_query($connection, "SELECT * from schedule where schedule_author = '$username'");
$schedule_count = mysqli_num_rows($q);

//second graph
$q = mysqli_query($connection, "SELECT * from users where user_role = 'student'");
$num_student = mysqli_num_rows($q);

$q = mysqli_query($connection, "SELECT * from users where user_role = 'teacher'");
$num_teacher = mysqli_num_rows($q);
?>
<div class="container">
    <div class="row">


        <!-- First graph -->

        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['bar']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([

                    <?php
                    $element_column = ['Graphic', 'Posts', 'Comments', 'Files', 'Schedule'];
                    $element_value = ['', $post_count, $comment_count, $files_count, $schedule_count];

                    for ($i = 0; $i < 5; $i++) {
                        $column = $element_column[$i];
                        $value = $element_value[$i];
                        echo "['$column' " . "," . " '$value'],";
                    }
                    ?>

                ]);

                var options = {
                    chart: {
                        title: '',
                        subtitle: ''
                    }
                };

                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                chart.draw(data, google.charts.Bar.convertOptions(options));
            }
        </script>
        <div class="col-sm-6">
            <div id="columnchart_material" style="width: auto; height: 500px;"></div>
        </div>


        <!-- Second graph -->

        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                    ['Task', 'Hours per Day'],
                    ['teachers', <?= $num_teacher ?>],
                    ['Students', <?= $num_student ?>]
                ]);

                var options = {
                    title: 'number of users',
                    is3D: true,
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));

                chart.draw(data, options);
            }
        </script>
        <div class="col-sm-6">
            <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
        </div>
    </div>
</div>