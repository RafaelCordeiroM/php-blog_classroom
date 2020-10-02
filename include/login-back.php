<?php session_start(); ?>
<?php include "db.php"; ?>
<?php

use PHPMailer\PHPMailer\PHPMailer; ?>
<?php require "./vendor/autoload.php" ?>
<?php

$login_check = false;
$password_check = false;
if (isset($_POST['login'])) {

    $user = mysqli_real_escape_string($connection, $_POST['user']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    $query = "SELECT * from users WHERE username='$user' or user_email='$user'";
    $q = mysqli_query($connection, $query);

    if (mysqli_num_rows($q) == 0) {
        $login_check .= "| email does not exist ";
    } else {

        while ($row = mysqli_fetch_assoc($q)) {
            $salt = $row['user_randSalt'];
            if (crypt($password, $salt) == $row['user_password'] && $row['user_status'] == 'active') {

                $_SESSION['user_id'] = $row['user_id'];
                $password_check = true;
            }
        }
        if ($password_check == false) {
            $login_check .= "| invalid password or email was not confirmed.";
        }
    }
}


$signup_check = false;
if (isset($_POST['singup'])) {

    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    // $role = $_POST['role'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $ver = ['username' => true, 'email' => true, 'password' => true, 'fullfiled' => true];

    $username_check = "SELECT * from users WHERE username = '$username'";
    $username_check = mysqli_query($connection, $username_check);
    if (strlen($username) > 20) {
        $ver['username'] = false;
        $signup_check .= "| username longer than 20";
    } else if (mysqli_num_rows($username_check) > 0) {
        $ver['username'] = false;
        $signup_check .= "| username invalid";
    }

    $email_check = "SELECT * from users WHERE user_email = '$email' or username = '$username'";
    $email_check = mysqli_query($connection, $email_check);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 40 || mysqli_num_rows($email_check) > 0) {

        $ver['email'] = false;
        $signup_check .= "| email invalid ";
    }


    if (strlen($password) > 30) {
        $ver['password'] = false;
        $signup_check .= "| password longer than 30 ";
    }
    if (empty($username) || empty($email) || empty($password)) {
        $ver['fullfiled'] = false;
        $signup_check .= "| invalid input ";
    }


    if (!in_array(false, $ver)) {

        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randSalt = substr(str_shuffle($permitted_chars), 0, 22);

        $password = crypt($password, $randSalt);

        $length = 50;
        $token = bin2hex(openssl_random_pseudo_bytes($length));

        /*
        *query roles
        */
        $fullname = $firstname . " " . $lastname;
        $stmt = mysqli_prepare($connection, "SELECT role from users_role where role_fullName = ?");
        mysqli_stmt_bind_param($stmt, "s", $fullname);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $role);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        $query = "INSERT INTO users (username,user_email,user_password,user_firstname,user_lastname,user_role,user_image,user_randSalt,user_token) ";
        $query .= "VALUES ('$username','$email','$password','$firstname','$lastname','$role','default_avatar.jpg','$randSalt','$token')";
        $query = mysqli_query($connection, $query);

        if ($query) {
            // session_start();
            // $id = "SELECT user_id from users where user_email='$email'";
            // $id = mysqli_query($connection, $id);
            // $user_id = mysqli_fetch_assoc($id);

            // $_SESSION['user_id'] = $user_id['user_id'];
            // header("location:/public_html/");

            $mail = new PHPMailer();
            //Server settings                    
            $mail->isSMTP();
            $mail->SMTPDebug = 2;
            $mail->Host       = Config::SMTP_HOST;
            $mail->Port       = Config::SMTP_PORT;
            $mail->SMTPAuth   = true;
            $mail->Username   = Config::SMTP_USER;
            $mail->Password   = Config::SMTP_PASSWORD;
            $mail->SMTPSecure = 'tls';
            $mail->isHTML(true);
            $mail->CharSet    = 'UTF-8';

            $mail->setFrom('rafaelYMG0@gmail.com', 'Rafael C. Martins');
            $mail->addAddress($email, $firstname);
            $mail->Subject    = 'Verify user';
            $msg = "click in the link to confirm:
            <a href='https://localhost:8080/public_html/singup_confirm.php?email=" . $email . "&token=" . $token . "'>Click here</a>;
            ";
            $mail->Body       = "$msg";

            //sending email with the actual link by the new token
            if ($mail->send()) {
                $emailSent = true;
            } else {
                echo "<div class='alert alert-warning col-sm-12 text-center'>" . mysqli_error($connection) . "</div>";
            }

            $singupSent = true;
        } else {
            echo mysqli_error($connection);
        }
    } else {

        // echo $signup_check;
    }
}
