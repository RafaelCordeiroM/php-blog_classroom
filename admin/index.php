<?php include "includes/header.php"; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"></script>
<div id="page-wrapper">
    <div class="container-fluid">

        <!-- /.row -->

        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-file-text fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class='huge'>
                                    <?php $q = mysqli_query($connection, "SELECT * from posts");
                                    echo $post_count = mysqli_num_rows($q);
                                    ?>
                                </div>
                                <div>Posts</div>
                            </div>
                        </div>
                    </div>
                    <a href="posts.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class='huge'>
                                    <?php $q = mysqli_query($connection, "SELECT * from comments");
                                    echo $comment_count = mysqli_num_rows($q);
                                    ?>
                                </div>
                                <div>Comments</div>
                            </div>
                        </div>
                    </div>
                    <a href="comments.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class='huge'>
                                    <?php $q = mysqli_query($connection, "SELECT * from users");
                                    echo $users_count = mysqli_num_rows($q);
                                    ?>
                                </div>
                                <div> Users</div>
                            </div>
                        </div>
                    </div>
                    <a href="users.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-calendar fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class='huge'>
                                    <?php $q = mysqli_query($connection, "SELECT * from schedule");
                                    echo $schedule_count = mysqli_num_rows($q);
                                    ?></div>
                                <div>Schedule</div>
                            </div>
                        </div>
                    </div>
                    <a href="schedule.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>

        </div>
        <?php

        $query = mysqli_query($connection, "SELECT * from posts WHERE post_status = 'draft'");
        $draft_post_count = mysqli_num_rows($query);

        ?>
        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['bar']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([

                    <?php
                    $element_column = ['Graphic', 'Posts', 'Draft Posts', 'Comments', 'Users', 'Schedule'];
                    $element_value = ['', $post_count, $draft_post_count, $comment_count, $users_count, $schedule_count];

                    for ($i = 0; $i < 6; $i++) {
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
        <div class="col-sm-12">
            <div id="columnchart_material" style="width: auto; height: 500px;"></div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include "includes/footer.php"; ?>
<script src="https://js.pusher.com/5.0/pusher.min.js"></script>

<script>
    $(document).ready(function() {

        var pusher = new Pusher('f92f49fbfb59f0c85915', {
            cluster: 'us2',
            encrypted: true
        });
        var notification_channel = pusher.subscribe('notifications');

        notification_channel.bind('new_user', function(notification) {
            var message = notification.message;
            alert(`${message} published a post`);
        });

    });
</script>