                    <?php

                    if (isset($_POST['add_user'])) {
                        add_user();
                    }

                    ?>
                    <style>
                        select {
                            width: 100%;
                            padding: 16px 20px;
                            border: none;
                            border-radius: 4px;
                            background-color: #f1f1f1;
                        }
                    </style>
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>?source=add_user" method="post" enctype="multipart/form-data">
                        <h4 class="title">ADD USER</h4>
                        <!-- hidden id -->


                        <div class="button-group"><label for="username_user">Username</label>
                            <input class="form-control" type="text" name="username_user">
                        </div>

                        <div class="button-group"><label for="email_user">Email</label>
                            <input class="form-control" type="email" name="email_user">
                        </div>

                        <div class="button-group"><label for="firstname_user">Firstname</label>
                            <input class="form-control" type="text" name="firstname_user">
                        </div>

                        <div class="button-group"><label for="lastname_user">Lastname</label>
                            <input class="form-control" type="text" name="lastname_user">
                        </div>

                        <div class="button-group"><label for="role_user">Role</label>
                            <select name="role_user" id="">
                                <option value="student">--Select a option--</option>
                                <option value="admin">ADMIN</option>
                                <option value="teacher">TEACHER</option>
                                <option value="student">STUDENT</option>
                            </select>
                        </div>
                        <div class="button-group"><label for="image">Image</label>
                            <input type="file" class="form-control"  name="image">
                        </div>

                        <hr class="style3">

                        <div class="button-group"><label for="oldPassword_user">Password</label>
                            <input class="form-control" type="password" name="password_user">
                        </div>

                        <div class="button-group"><label for="newPassword_user">Repeat password</label>
                            <input class="form-control" type="password" name="password__user">
                        </div>

                        <div class="button-group">
                            <button type="submit" name="add_user">Add User</button>
                        </div>
                    </form>