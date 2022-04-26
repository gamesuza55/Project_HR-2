<?php
session_start();
 // @ini_set(‘display_errors’, ’0′);

if(($_SESSION['status'] ?? false) == 'admin') {
	header('location:admin/');
	exit;
}elseif(($_SESSION['stauts']?? false) == 'user' || ($_SESSION['department']?? false) == 'Accounting'){
	header('location:home.php');
	exit;

} elseif(($_SESSION['status'] ?? false) == 'user') {
	header('location:user/');
	exit;
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login Member</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(images/bg-01.jpg);">
					<span class="login100-form-title-1">
						Thaiwebeasy
					</span>
				</div>

				<form class="login100-form validate-form" id="form-login" method="post">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Username</span>
						<input class="input100" id="username" type="text" name="username" placeholder="Enter username">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" id="password" type="password" name="password" placeholder="Enter password">
						<span class="focus-input100"></span>
					</div>

					<div class="flex-sb-m w-full p-b-30">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

						<!--<div>
							<a href="#" class="txt1">
								Forgot Password?
							</a>
						</div>-->
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>
	<!--===============================================================================================-->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$("#form-login").submit(function() {
			var username = $('#username').val();
			var password = $('#password').val();
			var link = $(this).attr('href');

			if(username == "") {
				return false;
			}
			else if(password == "") {
				return false;
			}

			/* Act on the event */
			$.ajax({
				url: 'login.php',
				type: 'POST',
				data: $("#form-login").serialize(),
				success: function(data){
					if(data == "<b>Login Failed</b>") {
						console.log(data);
						Swal.fire({
							type: 'error',
							title: 'ลองดูใหม่อีกครั้ง...',
							text: false,
							confirmButtonText: 'ตกลง'
						});
						if(data == "<b>Login Failed</b>"){
							setTimeout(function(){window.location.href="index.php"}, 1000);
						}
						
					} else if(data == "ลาออกแล้วไม่สามารถเข้าใช้งานได้") {
						console.log(data);
						Swal.fire({
							type: 'error',
							title: data,
							text: false,
							timer: 1500,
							confirmButtonText: 'ตกลง'
						});
						if(data == "ออกจากงานแล้วไม่สารถเข้าสู่ระบบได้"){
							setTimeout(function(){window.location.href="index.php"}, 1000);
						}
					} else {
						console.log(data);
						Swal.fire({
							type: 'success',
							title: 'ยินต้อรับเข้าสู่เว็บไซต์',
							text: false,
							timer: 1500,
							confirmButtonText: 'ตกลง'
						});
						if(data == "admin"){
							setTimeout(function(){window.location.href="admin/index.php"}, 1000);
						}
						if(data == "user"){
							setTimeout(function(){window.location.href="user/index.php"}, 1000);
						}
						if(data == "userAccounting"){
							setTimeout(function(){window.location.href="home.php"}, 1000);
						}
					}
				},
				error: function(result){
					Swal.fire({
						type: 'error',
						title: 'ลองดูใหม่อีกครั้ง...',
						text: 'username หรือ password ไม่ถูกต้อง',
						confirmButtonText: 'ตกลง'
					})

				}
			});

			return false;
		});
	});

</script>