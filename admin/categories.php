<?php include "includes/header.php"; ?>


<div id="page-wrapper">
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="jumbotron">
                <h1 class="display-4">Manage Categories</h1>
                <hr class="my-4">
            </div>
            <div class="col-sm-4">


                <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="cat_title">Category title</label>
                        <input type="text" name="cat_title" class="form-control" placeholder="enter category's title">
                    </div>
                    <div class="form-group">
                        <label for="cat_title">Category logo</label>
                        <input type="file" name="cat_logo" class="form-control" placeholder="enter category's logo">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="add_category" value="Add">
                    </div>
                </form>
                <?php

                if (isset($_POST['add_category'])) {

                    if (!empty($_POST['cat_title'])) {
                        add_category($_POST['cat_title']);
                    } else {
                        echo "
                    <div class='alert alert-warning' role='alert'>
                    Fill Blanket!
                    </div>
                    ";
                    }
                }

                ?>


            </div>
            <div class="col-sm-8">

                <table class="table table-hover table-dark text-center">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Category's title</th>
                            <th>logo</th>
                            <th>modify</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php table_category(); ?>
                        <?php

                        if (isset($_GET['action']) && isset($_GET['id'])) {

                            if ($_GET['action'] == "delete") {
                                if ($user['user_role'] == "admin") {
                                    delete_data($_GET['id'], "categoria");
                                }
                            }
                        }
                        if (isset($_POST['edit-submit'])) {
                            if (!empty($_POST['title-edit'])) {
                                update_data($_POST['id-edit'], $_POST['title-edit'], "categoria");
                            } else {
                                echo "<div class='alert alert-danger' role='alert'>
                                    Fill Blanket!
                                    </div>";
                            }
                        }

                        ?>
                    </tbody>
                </table>

            </div>



        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
<?php include "includes/footer.php"; ?>
<script>
    $(document).ready(function() {
        $('.modal-call').on('click', function() {
            $("#modal_edit").modal('show');

            $tr = $(this).closest('tr');
            var value_cat_logo = $(this).closest('tr').find("#cat_logo").attr("value");


            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            value_cat_logo = "../discipline-logo/".concat(value_cat_logo);
            alert(value_cat_logo);
            $('#id-edit').val(data[0]);
            $('#title-edit').val(data[1]);
            document.getElementById("edit-img").src = value_cat_logo;

        });
    });
</script>
<div class='modal fade' id='modal_edit' role='dialog'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal'>&times;</button>
                <h4 class='modal-title'>Edit</h4>
            </div>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method='post' enctype="multipart/form-data">
                <div class='modal-body'>
                    <?php if (isset($_GET['update'])) {
                        echo $_GET['update'];
                    } else {
                        echo mysqli_error($connection);
                    } ?>

                    <div class="form-group">
                        <label for="update_input">new category's title</label>
                        <input type="hidden" name='id-edit' id='id-edit'>
                        <input type="text" class="form-control" id="title-edit" name="title-edit" placeholder="enter the new title">
                        <label for="logo-edit">Logo</label>
                        <img id="edit-img" width="100px" class="rounded-circle" alt="">
                        <input type="file" class="form-control" id="logo-edit" name="cat_logo">
                        <br>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="edit" name="edit-submit">
                </div>
            </form>

        </div>
    </div>