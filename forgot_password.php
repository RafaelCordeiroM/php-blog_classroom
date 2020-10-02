<?php

use PHPMailer\PHPMailer\PHPMailer;

session_start();
?>

<?php include "include/db.php"; ?>
<?php include "include/functions.php"; ?>

<?php
require "./vendor/autoload.php";
?>

<?php 
//redirect the user if he is logeed in
if (isset($_SESSION['user_id'])) {
    header("location:./");
}
?>
<?php
$server = "localhost:8080./forgot_password.php";
if (isset($_POST['email_submit'])) {

    $email = $_POST['email'];
    $length = 50;
    $token = bin2hex(openssl_random_pseudo_bytes($length));

    //checking if the email exists
    $query = mysqli_prepare($connection, "SELECT user_id from users WHERE user_email = ?");
    mysqli_stmt_bind_param($query, "s", $email);
    mysqli_stmt_execute($query);
    mysqli_stmt_bind_result($query, $id);
    mysqli_stmt_fetch($query);
    mysqli_stmt_close($query);

    if ($id) {
        //updating token by the id's email
        if ($stmt = mysqli_prepare($connection, "UPDATE users SET user_token = '{$token}' WHERE user_id = ?")) {
            mysqli_stmt_bind_param($stmt, "s", $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            $msg = "follow the link in order to recuperate \n <a href='" . $server . "?source=recuperate&token=" . $token . "'>click here</a>";

            $mail = new PHPMailer();
            //Server settings                    
            $mail->isSMTP();
            $mail->Host       = Config::SMTP_HOST;
            $mail->Port       = Config::SMTP_PORT;
            $mail->SMTPAuth   = true;
            $mail->Username   = Config::SMTP_USER;
            $mail->Password   = Config::SMTP_PASSWORD;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->isHTML(true);
            $mail->CharSet    = 'UTF-8';

            $mail->setFrom('rafaeldjzinn15c@gmail.com', 'Rafael C. Martins');
            $mail->addAddress($email);
            $mail->Subject    = 'Recuperate password';
            $mail->Body       = "$msg";
            
            //sending email with the actual link by the new token
            if ($mail->send()) {
                $emailSent = true;
            } else {
                echo "<div class='alert alert-warning col-sm-12 text-center'>" . mysqli_error($connection) . "</div>";
            }
        } else {

            echo "<div class='alert alert-warning col-sm-12 text-center'>" . mysqli_error($connection) . "</div>";
        }
    } else {

        echo "<div class='alert alert-warning col-sm-12 text-center'>Email does not exists</div>";
    }
}
?>
<?php
if (isset($_GET['source']) && $_GET['source'] == "recuperate" && isset($_GET['token']) && $_GET['token'] != '') {
    $token = $_GET['token'];

    //query based on token in the url
    $query = mysqli_prepare($connection, "SELECT user_email,user_randSalt from users where user_token = ?");
    mysqli_stmt_bind_param($query, "s", $token);
    mysqli_stmt_execute($query);
    mysqli_stmt_bind_result($query, $email_byToken, $salt_byToken);
    mysqli_stmt_fetch($query);
    mysqli_stmt_close($query);

    if (!$email_byToken) $_GET['token'] = null;
}
?>
<?php

if (isset($_POST['password_input'])) {

    if (isset($_POST['password']) == isset($_POST['password_2'])) {
        $pass1 = $_POST['password'];
        $pass2 = $_POST['password_2'];
        if (verify_password($pass1) && verify_password($pass2)) {
            //inserting new password in the database referred by the token
            if ($update_password = mysqli_prepare($connection, "UPDATE users SET user_password = ?, user_token = DEFAULT  WHERE user_email = '{$email_byToken}'")) {
                $pass = crypt($pass1, $salt_byToken);
                mysqli_stmt_bind_param($update_password, "s", $pass);
                mysqli_stmt_execute($update_password);
                mysqli_stmt_close($update_password);

                header("location: ./");
            } else echo mysqli_error($connection);
        }
    }
}
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<!DOCTYPE html>
<html lang="PT-BR">

<title>Blog 3º B</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<head>
    <script src="jquery/jquery.min.js"></script>
    <!---- jquery link local dont forget to place this in first than other script or link or may not work ---->

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!---- boostrap.min link local ----->

    <link rel="stylesheet" href="css/style.css">
    <!---- boostrap.min link local ----->

    <script src="js/bootstrap.min.js"></script>
    <!---- Boostrap js link local ----->

    <link rel="icon" href="images/icon.png" type="image/x-icon" />
    <!---- Icon link local ----->

    <style>
        body {
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            background-image: url('./images/bg.png');

        }

        .container {
            padding: 50px
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="container">
            <div class="row d-flex">

                <?php
                if (isset($_GET['source']) && $_GET['source'] == "recuperate" && isset($_GET['token'])) { ?>

                    <div class="col-sm-3"></div>
                    <div class="col-sm-6 p-4" style="background-color:rgba(226,225,225,0.7);">
                        <h1>Recuperate</h1>
                        <hr>
                        <form action="" method="post">
                            Email : <?= $email_byToken ?>
                            <br>
                            <input type="password" class="form-control" name="password" placeholder="New Password">
                            <input type="password" class="form-control" name="password_2" placeholder="Repeat password">
                            <input type="submit" value="create new password" name="password_input" class="form-control">
                        </form>
                    </div>
                    <div class="col-sm-3"></div>


                <?php } else { ?>
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6 p-4" style="background-color:rgba(226,225,225,0.7);">
                        <h1>Forgot Password</h1>
                        <hr>

                        <?php if (isset($emailSent)) : ?>

                            <div class="col-sm-12 text-center alert alert-info">Check your email</div>

                        <?php else : ?>

                            <form action="" method="post">
                                <div class="col-auto">
                                    <label class="sr-only" for="inlineFormInputGroup">Email</label>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">&#9993;</div>
                                        </div>
                                        <input type="email" name="email" class="form-control" id="" placeholder="email">
                                    </div>
                                </div>
                                <input type="submit" value="recuperate" name="email_submit" class="form-control">
                            </form>

                        <?php endif; ?>

                    </div>
                    <div class="col-sm-3"></div>
                <?php } ?>
            </div>
        </div>
    </div>
</body>

</html>