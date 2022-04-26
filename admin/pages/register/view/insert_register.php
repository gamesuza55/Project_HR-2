<?php 
// print_r($_POST);
// print_r($_FILES);
require_once('../conn.php');
// $username 	 = mysqli_real_escape_string($conn, $_POST['username']);
// $password    = mysqli_real_escape_string($conn, $_POST['password']);
// $password 	 = md5($password);

$username 	 = $_POST['username'];
$password    = $_POST['password'];
$fistname    = $_POST['fistname'];
$lastname    = $_POST['lastname'];
$nickname    = $_POST['nickname'];
$start_work  = date('Y-m-d', strtotime($_POST['start_work']));
$birthday    = date('Y-m-d', strtotime($_POST['birthday']));
$department  = $_POST['department'];
$email       = $_POST['email'];
$address     = $_POST['address'];
$gendar      = $_POST['gendar'];
$tel         = $_POST['tel'];

// if(isset($_POST['username'])) {
// 	echo "success";
//} 
$url = "../../../../images/user/";
$fileupload = $_FILES['fileupload']['name'];
@$newfilename = rand(1,99999) . '.' . end(explode(".",$fileupload));


	$sql = mysqli_query($conn, "INSERT INTO member (username, password, email, fistname, lastname, nickname, start_work, birthday, department, address, tel, gendar, status, image_user) VALUES ('$username','$password','$email','$fistname','$lastname','$nickname','$start_work','$birthday','$department','$address','$tel','$gendar','user','$newfilename')");

	if($sql) {
		echo "success";
		move_uploaded_file($_FILES["fileupload"]["tmp_name"],$url.$newfilename);
	} else {
		echo "error";
	}


mysqli_close($conn);
?>