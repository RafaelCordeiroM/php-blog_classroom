<?php include "includes/header.php"; ?>
<?php

if (isset($_GET['delete'])) {

    $id = $_GET['delete'];

    $stmt = mysqli_prepare($connection, "DELETE from users_role where role_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: users_role.php");
}
if (isset($_POST['add_role'])) {
    $fullname = $_POST['fullname'];
    $role = $_POST['role'];

    $query = mysqli_prepare($connection, "INSERT INTO users_role (role_fullName,role) VALUES(?,?)");
    mysqli_stmt_bind_param($query, "ss", $fullname, $role);
    mysqli_stmt_execute($query);
    mysqli_stmt_close($query);
}
if (isset($_POST['edit_role'])) {
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $role = $_POST['role'];

    $query = mysqli_prepare($connection,"UPDATE users_role SET role_fullName = ?,role = ? WHERE role_id = ?");
    mysqli_stmt_bind_param($query,"ssi",$fullname,$role,$id);
    mysqli_stmt_execute($query);
    mysqli_stmt_close($query);

    $query = mysqli_prepare($connection,"UPDATE users SET user_role = ? WHERE CONCAT(user_firstname,' ',user_lastname) = ?");
    mysqli_stmt_bind_param($query,"ss",$role,$fullname);
    mysqli_stmt_execute($query);
    mysqli_stmt_close($query);

    header("location: users_role.php");

}
?>
<div id="page-wrapper">

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4">
                <div class="jumbotron">
                    <h5>Add User Role</h5>
                    <hr class="my-4">
                </div>
                <form action="" method="post">
                    <label for="fullname">Full name</label>
                    <input type="text" name="fullname" class="form-control" placeholder="enter fullname">
                    <br>
                    <select name="role" class="form-control">
                        <option value="student" hidden selected disabled>-Select a option-</option>
                        <option value="student">Student</option>
                        <option value="teacher">Teacher</option>
                        <option value="admin">Admin</option>
                    </select>

                    <input type="submit" name="add_role" value="Add">

                </form>
            </div>
            <div class="col-sm-8">
                <div class="jumbotron">
                    <h5>Table</h5>
                    <hr class="my-4">
                </div>
                <table class="table table-hover">
                    <thead>
                        <th>Id</th>
                        <th>Full Name</th>
                        <th>Role</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php

                        $query = mysqli_query($connection, "SELECT * from users_role");
                        while ($row = mysqli_fetch_assoc($query)) {

                            echo "<tr>";
                            echo "<td>" . $row['role_id'] . "</td>";
                            echo "<td>" . $row['role_fullName'] . "</td>";
                            echo "<td>" . $row['role'] . "</td>";
                            echo "<td>
                            <button class='btn btn-success btn-modal'>Edit</button>
                            <a href='" . $_SERVER['PHP_SELF'] . "?delete=" . $row['role_id'] . "'>Delete</a>

                            </td>";

                            echo "</tr>";
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>




<!-- Modal -->
<div class="modal fade" id="modal_role_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <input type="hidden" name="id" id="id-edit">
                    <label for="fullname">Full name</label>
                    <input type="text" name="fullname" id="fullname-edit" class="form-control" placeholder="enter fullname">
                    <br>
                    <select name="role" class="form-control" id="role-edit">
                        <option value="student" hidden selected disabled>-Select a option-</option>
                        <option value="student">Student</option>
                        <option value="teacher">Teacher</option>
                        <option value="admin">Admin</option>
                    </select>

                    <input type="submit" name="edit_role" value="Edit">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php include "includes/footer.php"; ?>
<script>
    $(document).ready(function() {
        $('.btn-modal').on('click', function() {
            $("#modal_role_edit").modal('show');

            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();
            $('#id-edit').val(data[0]);
            $('#fullname-edit').val(data[1]);
            $('#role-edit').val(data[2]);
        });
    });
</script>