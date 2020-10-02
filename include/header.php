<?php session_start();?>
<?php include "include/db.php"; ?>
<?php include "functions.php"; ?>
<?php
if (!isset($_SESSION['user_id'])) header("location:/public_html/login");
else{
 $user_id = $_SESSION['user_id']; 
}
$query_data = "SELECT * from users WHERE user_id='$user_id'";
$query_data = mysqli_query($connection, $query_data);
$user = mysqli_fetch_assoc($query_data);

$session = session_id();
$time = time();
$time_out = $time - 30;
$query = mysqli_query($connection, "SELECT * from users_online where session = '$session'");
if (mysqli_num_rows($query) == null) {
	$query = mysqli_query($connection, "INSERT INTO users_online(session,time) VALUES('$session','$time')");
} else {

	$query = mysqli_query($connection, "UPDATE users_online SET time ='$time' WHERE session = '$session'");
}
?><?php
if (isset($_GET['logout'])) {
	unset($_SESSION['user_id']);
	session_destroy();
	header("location:/public_html/login");
}
?>
