<?php include "include/db.php"; ?>
<?php
$statement = mysqli_prepare($connection,"SELECT post_title from posts WHERE post_id = ?");
 $id = 37;
mysqli_stmt_bind_param($statement,"i",$id);
mysqli_stmt_execute($statement);
mysqli_stmt_bind_result($statement,$result);
mysqli_stmt_fetch($statement);

echo $result." : ";

?>