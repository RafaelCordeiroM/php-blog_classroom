<?php include "includes/header.php"; ?>
<div id="page-wrapper">
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="jumbotron">
                <h1 class="display-4">Profile</h1>
                <hr class="my-4">
            </div>
            <?php

            if (isset($_POST['update'])) {

                $column = $_POST['column'];
                $value = $_POST['value'];

                if($column == 'user_password'){
                    $value = crypt($value,"12s3bdysndjndu3hd3u2d6");
                }

                $user_id = $user['user_id'];
                $query = "UPDATE users set $column = '$value' WHERE user_id ='$user_id'";
                $query = mysqli_query($connection, $query);

                if ($query) {
                    header("location: profile.php");
                } else echo mysqli_error($connection);
            }

            ?>

            <div class="container text-center" align="center" style=" padding:5px;">

                <div class="row">
                    <div class="col-sm-12 text-center">
                        <img src="../images/person_1.jpg" class="rounded-circle" alt="" width="200">
                    </div>
                </div>
                <hr>
                <div align="center">

                    <div class="row rowData text-center mt-4">
                        <form action="" method="post">
                            <div class="col-sm-2 ">
                                Username:
                            </div>
                            <div class="col-sm-4">
                                <input type="hidden" name="column" value="username">
                                <input type="text" class="form-control" name="value" value="<?php echo $user['username']; ?>" <?php if (!isset($_GET['username'])) echo "disabled" ?>>
                            </div>
                            <div class="col-sm-1 text-right">

                                <?php if (isset($_GET['username'])) {
                                    echo "<input type='submit' class='btn' id='submit_input' value='update' name='update'>";
                                } ?>

                                <a class="btn" href="profile.php?username">
                                    <h5><b>&#9998;</b></h5>
                                </a>

                            </div>
                        </form>
                    </div>

                    <hr>

                    <div class="row rowData text-center mt-4">
                        <form action="" method="post">
                            <div class="col-sm-2 ">
                                Email:
                            </div>
                            <div class="col-sm-4">
                                <input type="hidden" name="column" value="user_email">
                                <input type="email" class="form-control" name="value" value="<?php echo $user['user_email']; ?>" <?php if (!isset($_GET['user_email'])) echo "disabled" ?>>
                            </div>
                            <div class="col-sm-1 text-right">

                                <?php if (isset($_GET['user_email'])) {
                                    echo "<input type='submit' class='btn' id='submit_input' value='update' name='update'>";
                                } ?>

                                <a class="btn" href="profile.php?user_email">
                                    <h5><b>&#9998;</b></h5>
                                </a>

                            </div>
                        </form>
                    </div>

                    <hr>

                    <div class="row rowData text-center mt-4">
                        <form action="" method="post">
                            <div class="col-sm-2 ">
                                Firstname:
                            </div>
                            <div class="col-sm-4">
                                <input type="hidden" name="column" value="user_firstname">
                                <input type="text" class="form-control" name="value" value="<?php echo $user['user_firstname']; ?>" <?php if (!isset($_GET['user_firstname'])) echo "disabled" ?>>
                            </div>
                            <div class="col-sm-1 text-right">

                                <?php if (isset($_GET['user_firstname'])) {
                                    echo "<input type='submit' class='btn' id='submit_input' value='update' name='update'>";
                                } ?>

                                <a class="btn" href="profile.php?user_firstname">
                                    <h5><b>&#9998;</b></h5>
                                </a>

                            </div>
                        </form>
                    </div>

                    <hr>

                    <div class="row rowData text-center mt-4">
                        <form action="" method="post">
                            <div class="col-sm-2 ">
                                Lastname:
                            </div>
                            <div class="col-sm-4">
                                <input type="hidden" name="column" value="user_lastname">
                                <input type="text" class="form-control" name="value" value="<?php echo $user['user_lastname']; ?>" <?php if (!isset($_GET['user_lastname'])) echo "disabled" ?>>
                            </div>
                            <div class="col-sm-1 text-right">

                                <?php if (isset($_GET['user_lastname'])) {
                                    echo "<input type='submit' class='btn' id='submit_input' value='update' name='update'>";
                                } ?>

                                <a class="btn" href="profile.php?user_lastname">
                                    <h5><b>&#9998;</b></h5>
                                </a>

                            </div>
                        </form>
                    </div>

                    <hr>

                    <div class="row rowData text-center mt-4">
                        <form action="" method="post">
                            <div class="col-sm-2 ">
                                Role:
                            </div>
                            <div class="col-sm-4">
                                <input type="hidden" name="column" value="user_role">
                                <select class="form-control" name="value" <?php if (!isset($_GET['user_role'])) echo "disabled" ?>>
                                    <option value="student" <?php if($user['user_role'] == 'student') echo 'selected'; ?>>Student</option>
                                    <option value="teacher" <?php if($user['user_role'] == 'teacher') echo 'selected'; ?>>Teacher</option>
                                    <option value="admin" <?php if($user['user_role'] == 'admin') echo 'selected'; ?>>Admin</option>
                                </select>
                            </div>
                            <div class="col-sm-1 text-right">

                                <?php if (isset($_GET['user_role'])) {
                                    echo "<input type='submit' class='btn' id='submit_input' value='update' name='update'>";
                                } ?>

                                <a class="btn" href="profile.php?user_role">
                                    <h5><b>&#9998;</b></h5>
                                </a>

                            </div>
                        </form>
                    </div>

                    <hr>

                    <div class="row rowData text-center mt-4">
                        <form action="" method="post">
                            <div class="col-sm-2 ">
                                Password:
                            </div>
                            <div class="col-sm-4">
                                <input type="hidden" name="column" value="user_password">
                                <input type="password" class="form-control" name="value" placeholder="**************" <?php if (!isset($_GET['user_password'])) echo "disabled" ?>>
                            </div>
                            <div class="col-sm-1 text-right">

                                <?php if (isset($_GET['user_password'])) {
                                    echo "<input type='submit' class='btn' id='submit_input' value='update' name='update'>";
                                } ?>

                                <a class="btn" href="profile.php?user_password">
                                    <h5><b>&#9998;</b></h5>
                                </a>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>