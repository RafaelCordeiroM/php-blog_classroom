<?php include "includes/header.php"; ?>
<div id="page-wrapper">
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="jumbotron">
                <h1 class="display-4">Schedule</h1>
                <hr class="my-4">
            </div>
            <div class="col-sm-12">
                <?php
                if (isset($_POST['edit_schedule'])) {
                    edit_schedule();
                }
                if (isset($_GET['delete'])) {
                    if ($user['user_role'] == "admin") {
                        delete_schedule($_GET['delete']);
                    }
                }

                ?>
                <?php


                if (isset($_GET['source'])) {
                    switch ($_GET['source']) {
                        case 'add_schedule':
                            include "includes/add_schedule.php";
                            break;
                        default:
                            include "includes/view_schedule.php";
                            break;
                    }
                } else {
                    include "includes/view_schedule.php";
                }
                ?>

            </div>

        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container-fluid -->


<?php include "includes/footer.php"; ?>
<style>
    textarea {
        width: 100%;
        height: 150px;
        padding: 12px 20px;
        box-sizing: border-box;
        border: 2px solid #ccc;
        border-radius: 4px;
        background-color: #f8f8f8;
        resize: none;
    }

    select {
        width: 100%;
        padding: 16px 20px;
        border: none;
        border-radius: 4px;
        background-color: #f1f1f1;
    }

    hr.style3 {
        border-top: 1px dashed #8c8b8b;
    }
</style>
<script>
    $(document).ready(function() {
        $('.btn-schedule-edit').on('click', function() {

            //extracting values from db
            $tr = $(this).closest('tr');
            var value_cat_id = $(this).closest('tr').find("#id_cat_schedule").attr("value");

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            //placing all values into the inputs
            $('#schedule_id').val(data[0]);
            $('#schedule_date').val(data[1]);
            $('#schedule_title').val(data[2]);
            $('#schedule_content').val(data[3]);
            $('#schedule_author').val(data[4]);
            document.getElementById('schedule_discipline').value = value_cat_id;
            $('#schedule_topic').val(data[6]);
        });
    });
</script>