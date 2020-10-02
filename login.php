<?php include "include/login-back.php" ?>
<?php if (isset($_SESSION['user_id'])) {
    header("location:/public_html/");
} ?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<!DOCTYPE html>
<html lang="en">

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
            background-image: url('/public_html/images/bg.png');

        }

        .container {

            padding: 50px;

        }

        select {
            width: 100%;
            padding: 16px 20px;
            border: none;
            border-radius: 4px;
            background-color: #f1f1f1;
        }

        .logo_div {
            width: 100%;
            height: 300px;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            background-color: rgba(56, 56, 56, 0.9);


        }

        .logo_img {
            width: 300px;
            height: 300px;

        }

        @media only screen and (max-width: 600px) {
            .logo_img {
                width: 200px;
                height: 200px;
            }

            .logo_div {
                height: 200px;
            }
        }
    </style>

    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <!---- Font awesom link local ----->
</head>
<?php
// the message
$msg = "First line of text \n Second line of text";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg, 70);

// send email
$v = mail("rafaeldjzinn15c@gmail.com", "My subject", $msg, "rafaelYMG0@gmail.com");
if ($v) echo "ok";
else {
    ini_set('display_errors', 'On');
    error_reporting(E_ALL);
}

?>

<body>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <div class="logo_div">
                        <img src="/public_html/images/logo_transparent.png" alt="" class="logo_img">
                    </div>

                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-5" style="background-color: rgba(226, 225, 225,0.7)">
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" role="login">
                        <fieldset>
                            <h3>
                                <p class="text-uppercase"> Logar </p>
                            </h3>
                            <hr>
                            <div class="form-group">
                                <input type="text" name="user" id="username" class="form-control input-lg" placeholder="Nome do Usuário ou Email" autocomplete="on" value="<?php echo isset($user) ? $user : '' ?>">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Senha">
                                <a href="/public_html/forgot_password.php">Forgot password?</a>
                            </div>
                            <div>
                                <input type="submit" class="btn btn-danger" name="login" value="Logar">
                            </div>

                        </fieldset>
                        <div>
                            <?php
                            if ($login_check != false) {
                                echo $login_check;
                            }
                            ?>
                        </div>
                    </form>
                </div>


                <div class="col-md-2">
                    <!-------null------>
                </div>
                <?php if (isset($emailSent)) : ?>
                    <div class="col-md-5" style="background-color: rgba(226, 225, 225,0.7)">

                        <div class="alert alert-info"><h1>check your email.</h1></div>

                    </div>
                <?php else : ?>
                    <div class="col-md-5" style="background-color: rgba(226, 225, 225,0.7)">
                        <form role="signup" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                            <fieldset>
                                <h3>
                                    <p class="text-uppercase pull-center"> CADASTRO</p>
                                </h3>
                                <hr>
                                <div class="form-group">
                                    <input type="text" name="username" id="username" class="form-control input-lg" placeholder="Nome do Usuário" autocomplete="on" value="<?php echo isset($username) ? $username : '' ?>">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="firstname" id="firstname" class="form-control input-lg" placeholder="Primeiro Nome" autocomplete="on" value="<?php echo isset($firstname) ? $firstname : '' ?>">
                                    <input type="text" name="lastname" id="lastname" class="form-control input-lg" placeholder="Último Nome" autocomplete="on" value="<?php echo isset($lastname) ? $lastname : '' ?>">
                                </div>

                                <!-- <div class="form-group">
                                    <select name="role" id="" value="<?php //echo isset($role) ? $role : '' ?>">
                                        <option value="student" selected disabled hidden>--Posição--</option>
                                        <option value="student">Estudante</option>
                                        <option value="teacher">Professor</option>
                                        <option value="admin" disabled>Admin</option>
                                    </select>
                                </div> -->

                                <div class="form-group">
                                    <input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email" autocomplete="on" value="<?php echo isset($email) ? $email : '' ?>">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Senha">
                                </div>

                                <div>
                                    <input type="submit" class="btn btn-lg btn-dark" name="singup" value=" Cadastrar">
                                </div>
                            </fieldset>
                            <?php
                            if ($signup_check != false) {
                                echo $signup_check;
                            }
                            ?>
                        </form>
                    </div>
                <?php endif; ?>

            </div>
        </div>

    </div>
</body>

</html>