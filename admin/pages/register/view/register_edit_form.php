<?php
require('../conn.php');
$username = $_POST['username'];
$password = $_POST['password'];
$fistname = $_POST['fistname'];
$lastname = $_POST['lastname'];
$nickname = $_POST['nickname'];
$birthday = $_POST['birthday'];
$department = $_POST['department'];
$email = $_POST['email'];
$address = $_POST['address'];
$gendar = $_POST['gendar'];
$tel = $_POST['tel'];

$fileuploadOld = $_POST['fileuploadOld']; 
$url = "../../../../images/user/";
$fileupload = $_FILES['fileupload']['name'];
$newfilename = rand(1,99999) . '.' . end(explode(".",$fileupload));

if($fileupload != "") {
	if(move_uploaded_file($_FILES["fileupload"]["tmp_name"],$url.$newfilename)) {
		unlink($url.$fileuploadOld);
		$sql = mysqli_query($conn, "UPDATE `member` SET `password` = '$password',`fistname` = '$fistname',`lastname` = '$lastname',`nickname` = '$nickname',`birthday` = '$birthday',`department` = '$department',`email` = '$email',`address` = '$address',`gendar` = '$gendar',`tel` = '$tel',`image_user` = '$newfilename' WHERE `username` = '$username';");
		header("location:../register_staff.php");
	}
} else {
	$sql = mysqli_query($conn, "UPDATE `member` SET `password` = '$password',`fistname` = '$fistname',`lastname` = '$lastname',`nickname` = '$nickname',`birthday` = '$birthday',`department` = '$department',`email` = '$email',`address` = '$address',`gendar` = '$gendar',`tel` = '$tel' WHERE `username` = '$username';");
	header("location:../register_staff.php");
} 
mysqli_close($conn);
?>