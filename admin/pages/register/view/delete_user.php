<?php
require_once('../conn.php');
$username =  $_POST['username'];

$sql = mysqli_query($conn,"SELECT * FROM member WHERE username = '$username'");
$row = mysqli_fetch_assoc($sql); 

$sql_del = mysqli_query($conn, "DELETE FROM member WHERE username = '$username'");
if($sql_del) {
	unlink('../../../../images/user/'.$row['image_user']);
	echo 'success';
} else {
	echo 'error';
}
?>