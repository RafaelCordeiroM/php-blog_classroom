
<table class="table table-bordered table-hover">
    <thead>
        <th>id</th>
        <th>username</th>
        <th>email</th>
        <th>firstname</th>
        <th>lastname</th>
        <th>image</th>
        <th>role</th>
        <th>salt</th>
    </thead>
    <tbody>
        <?php

        $query = "SELECT * from users";
        $query = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($query)) {
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_password = $row['user_password'];
            $user_email = $row['user_email'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
            $user_salt = $row['user_randSalt'];


            echo "<tr>";
            echo "<td>$user_id</td>";
            echo "<td>$username</td>";
            echo "<td>$user_email</td>";
            echo "<td>$user_firstname</td>";
            echo "<td>$user_lastname</td>";
            echo "<td>$user_image</td>";
            echo "<td>$user_role</td>";
            echo "<td>$user_salt</td>";
            echo "
            <td>
                <div class='button_group'>
                    <a href='$_SERVER[PHP_SELF]?delete=$user_id' class='btn btn-danger'>delete</a>
                    <button class='btn btn-primary btn-user-edit' data-toggle='modal' data-target='#modal_user'>edit</button>
                </div>
            </td>
            ";
            echo "</tr>";
        }


        ?>
    </tbody>
</table>

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



<!-- Modal -->
<div id="modal_user" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="salt" id="salt-edit">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <h4 class="modal-title">UPDATE USER</h4>
                    <!-- hidden id -->
                    <input type="hidden" name="id_user" id="id-edit">

                    <div class="button-group"><label for="username_user">Username</label>
                        <input class="form-control" type="text" name="username_user" id="username-edit">
                    </div>
                    <div class="button-group"><label for="email_user">Email</label>
                        <input class="form-control" type="email" name="email_user" id="email-edit">
                    </div>
                    <div class="button-group"><label for="firstname_user">Firstname</label>
                        <input class="form-control" type="text" name="firstname_user" id="firstname-edit">
                    </div>
                    <div class="button-group"><label for="lastname_user">Lastname</label>
                        <input class="form-control" type="text" name="lastname_user" id="lastname-edit">
                    </div>
                    <div class="button-group"><label for="role_user">Role</label>
                        <select name="role_user" id="role-edit">
                            <option value="student">--Select a option--</option>
                            <option value="admin">ADMIN</option>
                            <option value="teacher">TEACHER</option>
                            <option value="student">STUDENT</option>
                        </select>
                    </div>
                    <div class="button-group"><label for="image">Image</label>
                        <input class="form-control" type="file" name="user_image"/>
                    </div>
                    <hr class="style3">
                    <h4 class="modal-title">UPDATE PASSWORD</h4>
                    <div class="button-group"><label for="oldPassword_user">Old password</label>
                        <input class="form-control" type="password" name="oldPassword_user" id="oldPassword-edit">
                    </div>
                    <div class="button-group"><label for="newPassword_user">New password</label>
                        <input class="form-control" type="password" name="newPassword_user" id="newPassword_user-edit">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="edit" class='btn btn-primary'>Edit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>