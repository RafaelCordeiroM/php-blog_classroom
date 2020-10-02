<table class="table table-bordered table-hover">
    <thead>
        <th>id</th>
        <th>date</th>
        <th>title</th>
        <th>content</th>
        <th>author</th>
        <th>discipline</th>
        <th>topic</th>
        <th></th>

    </thead>
    <tbody>
        <?php

        $query = "SELECT * from schedule";
        $query = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($query)) {
            $schedule_id = $row['schedule_id'];
            $schedule_date = $row['schedule_date'];
            $schedule_title = $row['schedule_title'];
            $schedule_content = $row['schedule_content'];
            $schedule_author = $row['schedule_author'];
            $schedule_discipline = $row['schedule_discipline'];
            $schedule_topic = $row['schedule_topic'];




            echo "<tr>";
            echo "<td>$schedule_id</td>";
            echo "<td>$schedule_date</td>";
            echo "<td>$schedule_title</td>";
            echo "<td>$schedule_content</td>";
            echo "<td>$schedule_author</td>";

            $query_cat = "SELECT cat_title from categoria WHERE cat_id ='$schedule_discipline'";
            $the_cat_title = mysqli_query($connection, $query_cat);
            $the_cat_title = mysqli_fetch_assoc($the_cat_title);
            echo "<td>".$the_cat_title['cat_title']."</td>";
            echo "<input type='hidden' value='$schedule_discipline' id='id_cat_schedule'>";
            
            echo "<td>$schedule_topic</td>";
            echo "
            <td>
                <div class='button_group'>
                    <a href='$_SERVER[PHP_SELF]?delete=$schedule_id' class='btn btn-danger'>delete</a>
                    <button class='btn btn-primary btn-schedule-edit' data-toggle='modal' data-target='#modal_schedule'>edit</button>
                </div>
            </td>
            ";
            echo "</tr>";
        }


        ?>
    </tbody>
</table>





<!-- Modal -->
<div id="modal_schedule" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                    <h4 class="modal-title">UPDATE SCHEDULE</h4>
                    <!-- hidden id -->
                    <input type="hidden" name="schedule_id" id="schedule_id">

                    <div class="button-group"><label for="schedule_date">Date</label>
                        <input class="form-control" type="date" name="schedule_date" id="schedule_date">
                    </div>
                    <div class="button-group"><label for="schedule_title">Title</label>
                        <input class="form-control" type="text" name="schedule_title" id="schedule_title">
                    </div>
                    <div class="button-group"><label for="schedule_content">Content</label>
                        <textarea name="schedule_content" id="schedule_content" value="" cols="30" rows="10"></textarea>
                    </div>
                    <div class="button-group"><label for="schedule_author">Author</label>
                        <input class="form-control" type="text" name="schedule_author" id="schedule_author">
                    </div>
                    <div class="button-group"><label for="role_user">Discipline</label>
                        <select name="schedule_discipline" id="schedule_discipline">
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
                    </div>
                    <div class="button-group"><label for="schedule_topic">Topic</label>
                        <input class="form-control" type="text" name="schedule_topic" id="schedule_topic">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="edit_schedule" class='btn btn-primary'>Edit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>