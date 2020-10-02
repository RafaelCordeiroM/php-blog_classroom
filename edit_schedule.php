<?php include "include/header.php"; ?>

<?php
if (isset($_POST['edit_schedule'])) {
    $date = escape($_POST['schedule_date']);
    $title = escape($_POST['schedule_title']);
    $content = escape($_POST['schedule_content']);
    $author = escape($_POST['schedule_author']);
    $discipline = escape($_POST['schedule_discipline']);
    $topic = escape($_POST['schedule_topic']);

    $id = escape($_POST['schedule_id']);

    $query = "UPDATE schedule SET schedule_date='$date', schedule_title='$title', schedule_content='$content', schedule_author='$author', schedule_discipline='$discipline', schedule_topic='$topic' ";
    $query .= " WHERE schedule_id ='$id' ";
    $query = mysqli_query($connection, $query);
    if ($query) {
        header("location:schedule_page.php?single_s=$id&updated");
    } else echo "ops.." . mysqli_error($connection);
}
?><?php
    if (isset($_GET['schedule_id'])) {
        $id = escape($_GET['schedule_id']);
        $query = "SELECT * from schedule WHERE schedule_id ='$id'";
        $query = mysqli_query($connection, $query);
        $data = mysqli_fetch_assoc($query);
    }
    if (empty($_GET['schedule_id'])) exit("<div class='alert alert-warning col-sm-12 text-center'>Opss.</div>");
    ?>
<?php include "include/header_html.php"; ?>

<!-- //////////////////////////// Nav Bar //////////////////////////////// -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container d-flex align-items-center px-4">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a href="./" class="nav-link pl-0">Home</a></li>
                <li class="nav-item"><a href="blog" class="nav-link">Blog</a></li>
                <li class="nav-item"><a href="library" class="nav-link">Library</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4 mb-4 p-2" style="background-color:#ececec;color:black;">
    <div class="col-sm-9">
        <form action="<?PHP echo $_SERVER['PHP_SELF'] ?>" method="post">

            <input type="hidden" name="schedule_id" value="<?php echo $_GET['schedule_id'] ?>">
            <input type="hidden" name="schedule_author" value="<?php echo $data['schedule_author']; ?>">

            <div class="button-group"><label for="schedule_date">Date</label>
                <input class="form-control" type="date" value="<?php echo $data['schedule_date'] ?>" name="schedule_date">
            </div>
            <div class="button-group"><label for="schedule_title">Title</label>
                <input class="form-control" type="text" value="<?php echo $data['schedule_title'] ?>" name="schedule_title">
            </div>
            <div class="button-group"><label for="schedule_content">Content</label>
                <textarea name="schedule_content" value="" cols="30" rows="10" id="editor-content">
                        <?php echo $data['schedule_content'] ?>
                        </textarea>
                <script>
                    ClassicEditor
                        .create(document.querySelector('#editor-content'))
                        .catch(error => {
                            console.error(error);
                        });
                </script>
            </div>
            <div class="button-group"><label for="role_user">Discipline</label>
                <select name="schedule_discipline" class="form-control">
                    <?php
                    $query = "SELECT * from categoria";
                    $query = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_assoc($query)) {
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];

                    ?>
                        <option value="<?php echo $cat_id ?>" <?php if ($data['schedule_discipline'] == $cat_id) echo "selected" ?>><?php echo $cat_title ?></option>

                    <?php } ?>

                </select>
                <div class="button-group"><label for="schedule_topic">Topic</label>
                    <textarea class="form-control" name="schedule_topic" id="editor-topic"><?php echo $data['schedule_topic'] ?></textarea>
                    <script>
                        ClassicEditor
                            .create(document.querySelector('#editor-topic'))
                            .catch(error => {
                                console.error(error);
                            });
                    </script>
                </div>
            </div>
            <button name="edit_schedule" type="submit" class="btn btn-primary">Edit Schedule</button>
        </form>
    </div>
</div>
<?php include "include/footer.php"; ?>