<?php

if (isset($_POST['upload'])) {
    $discipline = escape($_POST['discipline']);
    $title = escape($_POST['title']);
    $description = escape($_POST['description']);
    $author = escape($_POST['author']);
    $date = date("Y-m-d");
    $user = escape($user['username']);

    if (isset($_FILES['file'])) {
        $file = $_FILES['file']['name'];
        $file_temp = $_FILES['file']['tmp_name'];
        move_uploaded_file($file_temp, "books/$file");
    }
    $query = "INSERT into books (book_title,book_cat_id,book_description,book_src,book_author,book_date,book_user) VALUES ('$title','$discipline','$description','$file','$author','$date','$user')";
    $query = mysqli_query($connection, $query);

    if ($query) echo "<div class='alert alert-success'>Upload<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
    else echo "<div class='alert alert-danger'>".mysqli_error($connection)."<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
}
if(isset($_GET['delete']) ){

    $id = escape($_GET['delete']);
    $query_check = "SELECT book_user from books where book_id='$id'";
    $query_check = mysqli_query($connection,$query_check);
    $query_check = mysqli_fetch_assoc($query_check);

    if($user['username'] == $query_check['book_user']){

        $query = "DELETE from books WHERE book_id = '$id'";
        $query = mysqli_query($connection,$query);

        if($query) echo "<div class='alert alert-success'>Deleted<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
        else echo "<div class='alert alert-danger'>".mysqli_error($connection)."<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
    }
}

?>

<style>
    .modal_book {
        background-color: transparent;
        font-size: 20px;
    }
</style>

<div class="col-sm-12 text-center m-2">
    <button class="btn btn-outline-info" data-toggle="modal" data-target="#modal_upload">upload doc</button>
</div>
<div class="container d-flex" style="background-color:#dcdcdc;">
    <div class="row m-1 p-2">
        <?php

        $query = "SELECT * from categoria";
        $query = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($query)) {
            $cat_id = $row['cat_id'];
            $qtd = "SELECT * from books where book_cat_id = '$cat_id'";
            $qtd = mysqli_query($connection, $qtd);
            $qtd = mysqli_num_rows($qtd);

        ?>

            <div class="col-sm-4">

                <form action="library.php?source=library" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['cat_id'] ?>">

                    <ul>
                        <li class="list-group-item list-group-item-dark">
                            <div class="col-sm-12 text-center">
                                <img src="discipline-logo/<?php echo $row['cat_logo'] ?>" width="100px" class="rounded-circle" alt="">
                            </div>
                            <button class=" btn btn-block btn-lg btn-dark" type="submit" name="modal_book"><?php echo $row['cat_title'] ?></button>
                        </li>
                        <li class="list-group-item"><i class="fa fa-archive"></i> <?php echo $qtd; ?> files</li>

                    </ul>

                    <hr>
                </form>
            </div>


        <?php } ?>
    </div>
</div>

<style>
    .hoverDiv:hover {
        background: #f5f5f5;
    }
</style>
<!-- Modal -->
<div class="modal fade" id="modal_book" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $id = $_POST['id'];

                $query = "SELECT * from books WHERE book_cat_id = '$id' ";
                $query = mysqli_query($connection, $query);
                echo "<ul>";
                while ($row = mysqli_fetch_assoc($query)) {
                    $date = date_create($row['book_date']);
                    if($row['book_user']==$user['username']){
                        echo "<div class='col-sm-12 text-right'><a class='btn btn-danger' href='".$_SERVER['PHP_SELF']."?source=library&delete=".$row['book_id']."'>X</a></div>";
                    }
                    echo "
                    <div class='row list-group-item hoverDiv' style='background-color:#e6e6e6;margin:0 0 0 0;'>
                        <i class='fa fa-book' style='font-size:25px;color:#007bff;'></i>
                        ".date_format($date,"d")."/".date_format($date,"m")."/".date_format($date,"Y")."
                         &#128336;
                        <hr>
                        <div class='col-sm-6'>
                            <div class='d-flex'>
                            Title:&nbsp;&nbsp;&nbsp;<h5> " . $row['book_title'] . "</h5>
                            </div>
                            <div class='d-flex'>
                            Author:&nbsp;&nbsp;&nbsp;<h5> " . $row['book_author'] . "</h5>
                            </div>
                        </div>
                        <hr>
                    <div class='col-sm-6 '>
                    <button class='btn btn-outline-primary' type='button' data-toggle='collapse' data-target='#collapse" . $row['book_id'] . "' aria-expanded='false' aria-controls='collapseExample'>
                        Description &dArr;
                    </button>
                    <a href='/public_html/books/" . $row['book_src'] . "' target='_blank' class='btn btn-dark'>View <i class='fa fa-eye'></i></a>
                    </div>
                    <div class='collapse' id='collapse" . $row['book_id'] . "'>
                        <div class='card card-body'>
                            " . $row['book_description'] . "
                        </div>
                    </div>
                    
                    
                    </div>
                    <br>
                    ";
                }
                echo "</ul>";
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal_upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload doc</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="library.php?source=library" method="post" enctype="multipart/form-data">

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
                    <input type="submit" name="upload" value="upload">
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>