<?php include "includes/header.php"; ?>




<div id="page-wrapper">
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="jumbotron">
                <h1 class="display-4">Week</h1>
                <hr class="my-4">
            </div>
            <?php

            if (isset($_POST['add_week'])) {

                $time = $_POST['time'];
                $day = $_POST['day'];
                $class = $_POST['class'];

                $query = "INSERT into week (week_day,week_time,week_class) VALUES('$day','$time','$class')";
                $query = mysqli_query($connection, $query);

                if ($query) echo "<div class='alert alert-success'>Added</div>";
                else echo "<div class='alert alert-danger'>" . mysqli_error($connection) . "</div>";
            }
            if (isset($_GET['delete'])) {
                if ($user['user_role'] == "admin") {
                    $id = $_GET['delete'];
                    $query = "DELETE from week where week_id = '$id'";
                    $query = mysqli_query($connection, $query);
                    if ($query) echo "<div class='alert alert-success'>deleted</div>";
                    else echo "<div class='alert alert-danger'>" . mysqli_error($connection) . "</div>";
                }
            }


            ?>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <button class="btn btn-lg btn-block btn-info " data-toggle="modal" data-target="#week_Modal">Add</button>
                </div>
            </div>


            <?php

            function week_day($day)
            {
                global $connection;
                $query = "SELECT * from week WHERE week_day='$day' ORDER BY week_time";
                $query = mysqli_query($connection, $query);
                echo "<table class='table table-hover'>";
                echo "<thead class='thead-light'><th>" . strtoupper($day) . "</th></thead>";
                echo "<tbody>";
                while ($row = mysqli_fetch_assoc($query)) {
                    $week_class = $row['week_class'];
                    $week_time = date_create($row['week_time']);
                    $week_id = $row['week_id'];

                    echo "
		<tr>
			<td><a href='" . $_SERVER['PHP_SELF'] . "?delete=$week_id' class='btn btn-danger'>X</a> {$week_class} - " . date_format($week_time, "G") . ":" . date_format($week_time, "i") . " </td>
		</tr>
		";
                }
                echo "</tbody>";
                echo "</table>";
            }

            ?>
            <session>
                <div class="m-4" style="display:flex;">
                    <?php
                    week_day('monday');
                    week_day('tuesday');
                    week_day('wednesday');
                    week_day('thursday');
                    week_day('friday');
                    ?>
                </div>
            </session>
        </div>

    </div>
</div>
<?php include "includes/footer.php"; ?>


<!-- Modal -->
<div class="modal fade" id="week_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" class="">


                    <label for="day">Day</label>
                    <select name="day" class="form-control">
                        <option value="monday">monday</option>
                        <option value="tuesday">tuesday</option>
                        <option value="wednesday">wednesday</option>
                        <option value="thursday">thursday</option>
                        <option value="friday">friday</option>
                    </select>

                    <label for="class">Class</label>
                    <select name="class" class="form-control">
                        <?php

                        $query = "SELECT * from categoria";
                        $query = mysqli_query($connection, $query);

                        while ($row = mysqli_fetch_assoc($query)) {
                            echo "<option value='" . $row['cat_title'] . "'>" . $row['cat_title'] . "</option>";
                        }

                        ?>
                    </select>
                    <label for="time">Time</label>
                    <input type="time" name="time" class="form-control">
                    <input type="submit" name="add_week" class="form-control">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>