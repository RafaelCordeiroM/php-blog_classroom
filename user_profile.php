<style>
    .btn_user {
        display: inline-block;
        border-top: 2px solid transparent;
        border-bottom: 2px solid transparent;
        padding: 10px;
    }

    .btn_user:hover {
        border-bottom: 2px solid #0d1128;
        border-top: 2px solid #0d1128;
    }

    .btn_user_active {
        display: inline-block;
        border-top: 2px solid transparent;
        border-bottom: 2px solid #0d1128;
        padding: 10px;
    }

    .btn_user_active:hover {
        border-top: 2px solid #0d1128;
    }
</style>
<div class="row">
    <div class="col-sm-12 text-center btn-group-justified" style="background-color:#e3e3e3;display:inline-flex;">

    <hr>
        <a href="<?php echo $_SERVER['PHP_SELF'] ?>" class=" btn-lg">
            <div class="btn_user btn-lg">
                Dashboard
            </div>
        </a>

        <a href="<?php echo $_SERVER['PHP_SELF'] ?>?source=user_profile" class=" btn-lg">
            <div class="btn_user_active btn-lg">
                Profile
            </div>
        </a>
        <a href="<?php echo $_SERVER['PHP_SELF'] ?>?source=user_posts" class=" btn-lg">
            <div class="btn_user btn-lg">
                My posts
            </div>
        </a>
        <hr>

    </div>
</div>
<hr>

<div class="container  text-center" align="center" style="padding:5px;">

    <div class="row">
        <form class="input-group border" method="post" enctype="multipart/form-data">

            <div class="col-sm-12 text-center">
                <img src="images/<?php echo $user['user_image']; ?>" class="rounded-circle" alt="" width="200" alt="user image">
            </div>
            <hr>
            <div class="col-sm-3"></div>
            <div class="col-sm-5">
                <input type="hidden" name="column" value="user_image">
                <input type="file" name="value" disabled id="image_input">
            </div>
            <div class="col-sm-1 text-right input-group">
                <div class="button-group d-flex">
                    <input type="submit" hidden class='btn btn-primary btn-primary' id='submit_input_image' name='update' value="update">
                    <btn class="btn btn-light" id="image_open" onClick="image()">
                        <h5><b>&#9998;</b></h5>
                    </btn>
                    <btn class="btn btn-light" id="image_close" hidden onClick="image_close()">
                        <h5><b>X</b></h5>
                    </btn>
                </div>
            </div>
            <script>
                function image() {

                    document.getElementById("image_input").disabled = false;
                    document.getElementById("submit_input_image").hidden = false;
                    document.getElementById("image_open").hidden = true;
                    document.getElementById("image_close").hidden = false

                }

                function image_close() {

                    document.getElementById("image_input").disabled = true;
                    document.getElementById("submit_input_image").hidden = true;
                    document.getElementById("image_open").hidden = false;
                    document.getElementById("image_close").hidden = true;

                }
            </script>
        </form>

    </div>
    <hr>
    <div class="col-sm-12">

        <div class=" text-center mt-4">
            <form action="" class="input-group" method="post">
                <div class="col-sm-2 ">
                    Username:
                </div>
                <div class="col-sm-7">
                    <input type="hidden" name="column" value="username">
                    <input type="text" class="form-control" name="value" id="username_input" value="<?php echo $user['username']; ?>" disabled>
                </div>
                <div class="col-sm-1 text-right input-group">
                    <div class="button-group d-flex">
                        <input type="submit" hidden class='btn btn-primary btn-primary' id='submit_input_username' value='update' name='update'>
                        <btn class="btn btn-light" id="username_open" onClick="username()">
                            <h5><b>&#9998;</b></h5>
                        </btn>
                        <btn class="btn btn-light" id="username_close" hidden onClick="username_close()">
                            <h5><b>X</b></h5>
                        </btn>
                    </div>
                </div>
                <script>
                    function username() {

                        document.getElementById("username_input").disabled = false;
                        document.getElementById("submit_input_username").hidden = false;
                        document.getElementById("username_open").hidden = true;
                        document.getElementById("username_close").hidden = false

                    }

                    function username_close() {

                        document.getElementById("username_input").disabled = true;
                        document.getElementById("submit_input_username").hidden = true;
                        document.getElementById("username_open").hidden = false;
                        document.getElementById("username_close").hidden = true;

                    }
                </script>
            </form>
        </div>

        <hr>

        <div class=" text-center mt-4">
            <form action="" class="input-group" method="post">
                <div class="col-sm-2 ">
                    Email:
                </div>
                <div class="col-sm-7">
                    <input type="hidden" name="column" value="user_email">
                    <input type="email" class="form-control" name="value" id="email_input" value="<?php echo $user['user_email']; ?>" disabled>
                </div>
                <div class="col-sm-1 text-right input-group">
                    <div class="d-flex">
                        <input type="submit" hidden class='btn btn-primary btn-primary' id='submit_input_email' value='update' name='update'>
                        <btn class="btn btn-light" id="email_open" onClick="email()">
                            <h5><b>&#9998;</b></h5>
                        </btn>
                        <btn class="btn btn-light" id="email_close" hidden onClick="email_close()">
                            <h5><b>X</b></h5>
                        </btn>
                    </div>
                </div>
                <script>
                    // function email() {

                    //     document.getElementById("email_input").disabled = false;
                    //     document.getElementById("submit_input_email").hidden = false;
                    //     document.getElementById("email_open").hidden = true;
                    //     document.getElementById("email_close").hidden = false

                    // }

                    // function email_close() {

                    //     document.getElementById("email_input").disabled = true;
                    //     document.getElementById("submit_input_email").hidden = true;
                    //     document.getElementById("email_open").hidden = false;
                    //     document.getElementById("email_close").hidden = true;

                    // }
                </script>
            </form>
        </div>

        <hr>

        <div class=" text-center mt-4">
            <form action="" class="input-group" method="post">
                <div class="col-sm-2 ">
                    Firstname:
                </div>
                <div class="col-sm-7">
                    <input type="hidden" name="column" value="user_firstname">
                    <input type="text" class="form-control" name="value" id="firstname_input" value="<?php echo $user['user_firstname']; ?>" disabled>
                </div>
                <div class="col-sm-1 text-right input-group">
                    <div class="d-flex">
                        <input type="submit" hidden class='btn btn-primary btn-primary' id='submit_input_firstname' value='update' name='update'>
                        <btn class="btn btn-light" id="firstname_open" onClick="firstname()">
                            <h5><b>&#9998;</b></h5>
                        </btn>
                        <btn class="btn btn-light" id="firstname_close" hidden onClick="firstname_close()">
                            <h5><b>X</b></h5>
                        </btn>
                    </div>
                </div>
                <script>
                    function firstname() {

                        document.getElementById("firstname_input").disabled = false;
                        document.getElementById("submit_input_firstname").hidden = false;
                        document.getElementById("firstname_open").hidden = true;
                        document.getElementById("firstname_close").hidden = false

                    }

                    function firstname_close() {

                        document.getElementById("firstname_input").disabled = true;
                        document.getElementById("submit_input_firstname").hidden = true;
                        document.getElementById("firstname_open").hidden = false;
                        document.getElementById("firstname_close").hidden = true;

                    }
                </script>
            </form>
        </div>

        <hr>

        <div class=" text-center mt-4">
            <form action="" class="input-group" method="post">
                <div class="col-sm-2 ">
                    Lastname:
                </div>
                <div class="col-sm-7">
                    <input type="hidden" name="column" value="user_lastname">
                    <input type="text" class="form-control" name="value" id="lastname_input" value="<?php echo $user['user_lastname']; ?>" disabled>
                </div>
                <div class="col-sm-1 text-right input-group">
                    <div class="d-flex">
                        <input type="submit" hidden class='btn btn-primary btn-primary' id='submit_input_lastname' value='update' name='update'>
                        <btn class="btn btn-light" id="lastname_open" onClick="lastname()">
                            <h5><b>&#9998;</b></h5>
                        </btn>
                        <btn class="btn btn-light" id="lastname_close" hidden onClick="lastname_close()">
                            <h5><b>X</b></h5>
                        </btn>
                    </div>
                </div>
                <script>
                    function lastname() {

                        document.getElementById("lastname_input").disabled = false;
                        document.getElementById("submit_input_lastname").hidden = false;
                        document.getElementById("lastname_open").hidden = true;
                        document.getElementById("lastname_close").hidden = false

                    }

                    function lastname_close() {

                        document.getElementById("lastname_input").disabled = true;
                        document.getElementById("submit_input_lastname").hidden = true;
                        document.getElementById("lastname_open").hidden = false;
                        document.getElementById("lastname_close").hidden = true;

                    }
                </script>
            </form>
        </div>

        <hr>
        <div class=" text-center mt-4">
            <form action="" class="input-group" method="post">
                <div class="col-sm-2 ">
                    role:
                </div>
                <div class="col-sm-7">
                    <input type="hidden" name="column" value="user_role">
                    <select class="form-control" id="role_input" name="value" disabled>
                        <option value="student" <?php if ($user['user_role'] == 'student') echo 'selected'; ?>>Student</option>
                        <option value="teacher" <?php if ($user['user_role'] == 'teacher') echo 'selected'; ?>>Teacher</option>
                        <option value="admin" <?php if ($user['user_role'] == 'admin') echo 'selected'; ?> disabled>Admin</option>
                    </select>
                </div>
                <div class="col-sm-1 text-right input-group">
                    <div class="d-flex">
                        <input type="submit" hidden class='btn btn-primary btn-primary' id='submit_input_role' value='update' name='update'>
                        <btn class="btn btn-light" id="role_open" onClick="role()">
                            <h5><b>&#9998;</b></h5>
                        </btn>
                        <btn class="btn btn-light" id="role_close" hidden onClick="role_close()">
                            <h5><b>X</b></h5>
                        </btn>
                    </div>
                </div>
                <script>
                    // function role() {

                    //     document.getElementById("role_input").disabled = false;
                    //     document.getElementById("submit_input_role").hidden = false;
                    //     document.getElementById("role_open").hidden = true;
                    //     document.getElementById("role_close").hidden = false

                    // }

                    // function role_close() {

                    //     document.getElementById("role_input").disabled = true;
                    //     document.getElementById("submit_input_role").hidden = true;
                    //     document.getElementById("role_open").hidden = false;
                    //     document.getElementById("role_close").hidden = true;

                    // }
                </script>
            </form>
        </div>




        <hr>
        <div class=" text-center mt-4">
            <form action="" class="input-group" method="post">
                <div class="col-sm-2 ">
                    password:
                </div>
                <div class="col-sm-7">
                    <input type="hidden" name="column" value="user_password">
                    <input type="password" class="form-control" name="value" id="password_input" placeholder="**********" disabled>
                </div>
                <div class="col-sm-1 text-right input-group">
                    <div class="d-flex">
                        <input type="submit" hidden class='btn btn-primary btn-primary' id='submit_input_password' value='update' name='update'>
                        <btn class="btn btn-light" id="password_open" onClick="password()">
                            <h5><b>&#9998;</b></h5>
                        </btn>
                        <btn class="btn btn-light" id="password_close" hidden onClick="password_close()">
                            <h5><b>X</b></h5>
                        </btn>
                    </div>
                </div>
                <script>
                    function password() {

                        document.getElementById("password_input").disabled = false;
                        document.getElementById("submit_input_password").hidden = false;
                        document.getElementById("password_open").hidden = true;
                        document.getElementById("password_close").hidden = false

                    }

                    function password_close() {

                        document.getElementById("password_input").disabled = true;
                        document.getElementById("submit_input_password").hidden = true;
                        document.getElementById("password_open").hidden = false;
                        document.getElementById("password_close").hidden = true;

                    }
                </script>
            </form>
        </div>