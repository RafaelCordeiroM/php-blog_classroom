<?php include "includes/header.php"; ?>

<?php

if (isset($_POST['upload'])) {
    $discipline = $_POST['discipline'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $author = $_POST['author'];
    $date = date("Y-m-d");
    $user = $user['username'];

    if (isset($_FILES['file'])) {
        $file = $_FILES['file']['name'];
        $file_temp = $_FILES['file']['tmp_name'];
        move_uploaded_file($file_temp, "../books/$file");
    }
    $query = "INSERT into books (book_title,book_cat_id,book_description,book_src,book_author,book_date,book_user) VALUES ('$title','$discipline','$description','$file','$author','$date','$user')";
    $query = mysqli_query($connection, $query);

    if ($query) echo "<div class='alert alert-success'>Upload<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
    else echo "<div class='alert alert-danger'>" . mysqli_error($connection) . "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
}
if (isset($_GET['delete'])) {
    if ($user['user_role'] == "admin") {
        $id = $_GET['delete'];

        $query = "DELETE from books WHERE book_id = '$id'";
        $query = mysqli_query($connection, $query);

        if ($query) echo "<div class='alert alert-success'>Deleted<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
        else echo "<div class='alert alert-danger'>" . mysqli_error($connection) . "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
    }
}
if (isset($_POST['edit_book'])) {
    $id = $_POST['book_id'];
    $discipline = $_POST['book_discipline'];
    $title = $_POST['book_title'];
    $description = $_POST['book_description'];
    $author = $_POST['book_author'];

    $query = "UPDATE books SET book_cat_id='$discipline',book_title='$title',book_author='$author'";
    if (isset($_FILES['book_file'])) {
        $file = $_FILES['book_file']['name'];
        $file_temp = $_FILES['book_file']['tmp_name'];
        move_uploaded_file($file_temp, "../books/$file");

        $query .= " book_src = '$file' WHERE book_id = '$id'";
    } else $query .= " WHERE book_id = '$id'";

    $query = mysqli_query($connection, $query);

    if ($query) echo "<div class='alert alert-success'>Edited<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
    else echo "<div class='alert alert-danger'>" . mysqli_error($connection) . "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
}

?>

<div id="page-wrapper">
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="jumbotron">
                <h1 class="display-4">Books</h1>
                <hr class="my-4">
            </div>

            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <hr>
                    <h1>Create book</h1>
                    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                        <fieldset style="border:1px solid #bfbebe;padding:10px;">
                            <label for="file">File</label>
                            <input type="file" class="form-control" name="file">

                            <label for="discipline">Discipline</label>
                            <select name="discipline" class="form-control">
                                <option hidden default value="1">Select discipline</option>
                                <?php
                                $query = "SELECT * from categoria";
                                $query = mysqli_query($connection, $query);

                                while ($row = mysqli_fetch_assoc($query)) {
                                    echo "<option value='" . $row['cat_id'] . "'>" . $row['cat_title'] . "</option>";
                                }

                                ?>
                            </select>
                            <br>
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" placeholder="title">
                            <br>
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" cols="30" rows="5" placeholder="enter description"></textarea>
                            <br>
                            <label for="description">Author</label>
                            <input type="text" name="author" class="form-control" placeholder="enter author">
                            <br>
                            <input type="submit" class='btn btn-primary' name="upload" value="upload">
                        </fieldset>
                    </form>
                </div>
            </div>
            <hr>
            <h1>Table</h1>
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-hover table-bordered">

                        <thead>
                            <th>ID</th>
                            <th>SRC</th>
                            <th>DISCIPLINE</th>
                            <th>DESCRIPTION</th>
                            <th>TITLE</th>
                            <th>AUTHOR</th>
                            <th>DATE</th>
                            <th>USER</th>
                            <th></th>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * from books";
                            $query = mysqli_query($connection, $query);

                            while ($row = mysqli_fetch_assoc($query)) {
                                $id = $row['book_cat_id'];

                                $query_cat = "SELECT cat_title from categoria WHERE cat_id ='$id'";
                                $the_cat_title = mysqli_query($connection, $query_cat);
                                $the_cat_title = mysqli_fetch_assoc($the_cat_title);

                                echo "<tr>";
                                echo "<input type='hidden' id='book_id_discipline' value='" . $row['book_cat_id'] . "' >";
                                echo "<td>" . $row['book_id'] . "</td>";
                                echo "<td>" . $row['book_src'] . "</td>";
                                echo "<td>" . $the_cat_title['cat_title'] . "</td>";
                                echo "<td>" . $row['book_description'] . "</td>";
                                echo "<td>" . $row['book_title'] . "</td>";
                                echo "<td>" . $row['book_author'] . "</td>";
                                echo "<td>" . $row['book_date'] . "</td>";
                                echo "<td>" . $row['book_user'] . "</td>";
                                echo "
                                        <td>
                                        <div class='btn-group'>
                                            <a href='" . $_SERVER['PHP_SELF'] . "?delete=" . $row['book_id'] . "' class='btn btn-danger'>delete</a>
                                            <button class='btn btn-primary btn-edit-book' data-toggle='modal' data-target='#modal-edit-book'>edit</button>
                                        </div>
                                        </td>
                                        ";
                                echo "</tr>";
                            }


                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Modal -->
<div id="modal-edit-book" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                    <h4 class="modal-title">UPDATE BOOK</h4>
                    <!-- hidden id -->
                    <input type="hidden" class="form-control" name="book_id" id="book_id">

                    <label for="book_file">File</label>
                    <input type="file" class="form-control" name="book_file">

                    <label for="book_discipline">Discipline</label>
                    <select class="form-control" name="book_discipline" id="book_discipline">
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

                    <label for="book_title">Title</label>
                    <input type="text" class="form-control" name="book_title" id="book_title">

                    <label for="book_description">Description</label>
                    <input type="text" class="form-control" name="book_description" id="book_description">

                    <label for="book_author">Author</label>
                    <input type="text" class="form-control" name="book_author" id="book_author">

                </div>
                <div class="modal-footer">
                    <button type="submit" name="edit_book" class='btn btn-primary'>Edit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include "includes/footer.php"; ?>



<script>
    $(document).ready(function() {
        $('.btn-edit-book').on('click', function() {

            //extracting values from db
            $tr = $(this).closest('tr');
            var value_cat_id = $(this).closest('tr').find("#book_id_discipline").attr("value");

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();


            //placing all values into the inputs
            $('#book_id').val(data[0]);
            document.getElementById("book_discipline").value = value_cat_id;
            $('#book_description').val(data[3]);
            $('#book_title').val(data[4]);
            $('#book_author').val(data[5]);
            $('#book_user').val(data[7]);
        });
    });
</script>