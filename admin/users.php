<?php include "includes/header.php"; ?>
<div id="page-wrapper">
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="jumbotron">
                <h1 class="display-4">Users</h1>
                <hr class="my-4">
            </div>
            <div class="col-sm-12">
                <?php

                if (isset($_GET['delete'])) {
                    if ($user['user_role'] == "admin") {
                        delete_user($_GET['delete']);
                    }
                }
                if (isset($_POST['edit'])) {
                    edit_user();
                }

                ?>
                <?php


                if (isset($_GET['source'])) {
                    switch ($_GET['source']) {
                        case 'add_user':
                            include "includes/add_user.php";
                            break;
                        default:
                            include "includes/view_user.php";
                            break;
                    }
                } else {
                    include "includes/view_user.php";
                }
                ?>

            </div>

        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container-fluid -->


<?php include "includes/footer.php"; ?>
<script>
    $(document).ready(function() {
        $('.btn-user-edit').on('click', function() {

            //extracting values from db
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();



            //placing all values into the inputs
            $('#id-edit').val(data[0]);
            $('#username-edit').val(data[1]);
            $('#email-edit').val(data[2]);
            // $('#password-edit').val(data[3]);
            $('#firstname-edit').val(data[3]);
            $('#lastname-edit').val(data[4]);
            $('#role-edit').val(data[6]);
            $('#salt-edit').val(data[7]);

        });
    });
</script>