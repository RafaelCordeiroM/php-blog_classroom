<?php ob_start(); ?>
<?php session_start();?>
<?php include_once "../include/db.php" ?>
<?php include_once "functions.php" ?>
<?php
$use_id = $_SESSION['user_id'];
if (!isset($use_id)) {
  unset($_SESSION['user_id']);
  header("location:../login.php");
}
$query_data = "SELECT * from users WHERE user_id='$use_id'";
$query_data = mysqli_query($connection, $query_data);
$user = mysqli_fetch_assoc($query_data);

?>
<?php

$query_user = "SELECT * from users WHERE user_id ='$use_id'";
$query_user = mysqli_query($connection, $query_user);
$user = mysqli_fetch_assoc($query_user);


?>
<?php
if ($user['user_role'] != 'admin') {
  header("location:../index.php");
}
?>
<?php

if (isset($_GET['logout'])) {
  unset($_SESSION['user_id']);
  session_destroy();
  header("location:../login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin</title>

  <!-- Bootstrap Core CSS -->
  <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
  <!-- bootstrap 3 -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


  <!-- Custom CSS -->
  <link href="css/sb-admin.css" rel="stylesheet">


  <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

  <!-- Custom Fonts -->
  <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="js/jquery.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>

<body>

  <div id="wrapper">

    <?php include_once "navigation.php" ?>