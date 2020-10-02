<?php

if(isset($_POST['add_schedule'])){

    $date = $_POST['schedule_date'];
    $title = $_POST['schedule_title'];
    $content = $_POST['schedule_content'];
    $author = $_POST['schedule_author'];
    $discipline = $_POST['schedule_discipline'];
    $topic = $_POST['schedule_topic'];

    $query = "INSERT INTO schedule (schedule_date,schedule_title,schedule_content,schedule_author,schedule_discipline,schedule_topic)";
    $query .= " VALUES('$date','$title','$content','$author','$discipline','$topic')";

    $query = mysqli_query($connection,$query);

    if($query) echo "<div class='alert alert-success col-sm-12 text-center'>Schedule Added</div>";
    else echo mysqli_error($connection);

}

?>


<form action="<?PHP echo $_SERVER['PHP_SELF']?>?source=add_schedule" method="post">
    <h4 class="modal-title">UPDATE SCHEDULE</h4>
    <!-- hidden id -->

    <div class="button-group"><label for="schedule_date">Date</label>
        <input class="form-control" type="date" name="schedule_date" >
    </div>
    <div class="button-group"><label for="schedule_title">Title</label>
        <input class="form-control" type="text" name="schedule_title" >
    </div>
    <div class="button-group"><label for="schedule_content">Content</label>
        <textarea name="schedule_content"  value="" cols="30" rows="10"></textarea>
    </div>
    <div class="button-group"><label for="schedule_author">Author</label>
        <input class="form-control" type="text" name="schedule_author" >
    </div>
    <div class="button-group"><label for="role_user">Discipline</label>
        <select name="schedule_discipline">
            <?php
            $query = "SELECT * from categoria";
            $query = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($query)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

            ?>
                <option value="<?php echo $cat_id ?>"><?php echo $cat_title ?></option>

            <?php } ?>

        </select>
        <div class="button-group"><label for="schedule_topic">Topic</label>
                        <input class="form-control" type="text" name="schedule_topic" id="schedule_topic">
                    </div>
    </div>
    <button name="add_schedule" type="submit" class="btn btn-primary">Add Schedule</button>
</form>