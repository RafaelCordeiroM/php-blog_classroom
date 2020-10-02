<?php session_start() ?>
<?php include "include/db.php" ?>
<?php

if (isset($_GET['token']) && $_GET['token'] != '' && isset($_GET['email'])) {

    $token = $_GET['token'];
    
    if ($query = mysqli_prepare($connection, "SELECT user_id,user_verified,user_email from users where user_token = ?")) {
        mysqli_stmt_bind_param($query, "s", $token);
        mysqli_stmt_execute($query);
        mysqli_stmt_bind_result($query, $id, $verified, $email);
        mysqli_stmt_fetch($query);
        mysqli_stmt_close($query);

    } 

    if ($_GET['email'] == $email) {
        if ($verified == "no") {

            if ($stmt = mysqli_prepare($connection, "UPDATE users SET user_token = DEFAULT, user_status = 'active', user_verified = 'yes' WHERE user_id = ?")) {
                mysqli_stmt_bind_param($stmt, "s", $id);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                $_SESSION['user_id'] = $id;
                header("location: /public_html/");
                
            }
        }
    } else echo mysqli_error($connection)."here";
}
else echo mysqli_error($connection)."hee";
