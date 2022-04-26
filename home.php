<?php
session_start();
require('config.php');
require('conn.php'); 
// require('controller/conn.php'); 
$sql_user = mysqli_query($conn, "SELECT * FROM member WHERE username = '".$_SESSION['user']."' ");
$row_user = mysqli_fetch_assoc($sql_user);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php require('controller/head.php'); ?> 
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
</head>
<style>
body,html {
	height: 100%;
	background-color: #fafbfa;
}
.hovereffect {
	width: 100%;
	height: 100%;
	overflow: hidden;
	text-align: center;
	cursor: default;
	background-color: black;

}

.hovereffect .overlay {
	width: 100%;
	height: 100%;
	position: absolute;
	overflow: hidden;
	top: 0;
	left: 0;
	padding: 50px 20px;
	
}

/*.hovereffect img {
	display: block;
	position: relative;
	max-width: none;
	width: calc(100% + 20px);
	-webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
	transition: opacity 0.35s, transform 0.35s;
	-webkit-transform: translate3d(-10px,0,0);
	transform: translate3d(-10px,0,0);
	-webkit-backface-visibility: hidden;
	backface-visibility: hidden;
}
*/
/*.hovereffect:hover img {
	opacity: 0.4;
	filter: alpha(opacity=40);
	-webkit-transform: translate3d(0,0,0);
	transform: translate3d(0,0,0);
	}*/
	.hovereffect:hover .bg-warning {
		opacity: 0.7;
		filter: alpha(opacity=40);
		-webkit-transform: translate3d(0,0,0);
		transform: translate3d(0,0,0);

	}

	.hovereffect h2 {
		text-transform: uppercase;
		color: #fff;
		text-align: center;
		position: relative;
		font-size: 17px;
		overflow: hidden;
		padding: 0.5em 0;
		background-color: transparent;
	}

	.hovereffect h2:after {
		position: absolute;
		bottom: 0;
		left: 0;
		width: 100%;
		height: 2px;
		background: #fff;
		content: '';
		-webkit-transition: -webkit-transform 0.35s;
		transition: transform 0.35s;
		-webkit-transform: translate3d(-100%,0,0);
		transform: translate3d(-100%,0,0);
	}

	.hovereffect:hover h2:after {
		-webkit-transform: translate3d(0,0,0);
		transform: translate3d(0,0,0);
	}

	.hovereffect a, .hovereffect p {
		color: #FFF;
		opacity: 0;
		filter: alpha(opacity=0);
		-webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
		transition: opacity 0.35s, transform 0.35s;
		-webkit-transform: translate3d(100%,0,0);
		transform: translate3d(100%,0,0);
	}

	.hovereffect:hover a, .hovereffect:hover p {
		opacity: 1;
		text-decoration: underline;
		filter: alpha(opacity=100);
		-webkit-transform: translate3d(0,0,0);
		transform: translate3d(0,0,0);
	}
	</style>
	<body>
		<header class="header-global">
			<nav id="navbar-main" class="navbar navbar-main navbar-expand-lg navbar-transparent">
				<div class="container position-relative">
					<a class="navbar-brand mr-lg-5">
						<img class="navbar-brand-light" src="./images/brand/home.svg" alt="Logo dark" style="height:100px;">
					</a>
					<div class="navbar-collapse collapse" id="navbar_global">
						<div class="navbar-collapse-header">
							<div class="row">
								<div class="col-6 collapse-brand">
									<a href="./index.html">
										<img src="./images/brand/secondary.svg" alt="menuimage">
									</a>
								</div>
								<div class="col-6 collapse-close">
									<a href="#navbar_global" role="button" class="fas fa-times" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation"></a>
								</div>
							</div>
							<div class="row mt-4">
								<div class="col-12 text-center">
									<img src="images/user/<?php echo $row_user['image_user'];?>" class="rounded-circle" height="150" width="150" alt="profile">
								</div>
								<div class="col-12 text-center mt-2">
									<a href="logout.php" class="nav-link text-danger">ออกจากระบบ</a>
								</div>
							</div>
						</div>
					</div>
					<div class="d-flex align-items-center">
						<ul class="flex-row list-style-none d-none d-sm-flex">
							<li class="nav-item dropdown">
								<a href="#" class="nav-link" data-toggle="dropdown" role="button" style="padding:0.25rem 0.5rem;">
									<img src="images/user/<?php echo $row_user['image_user'];?>" alt="profile" class="rounded-circle" height="40" width="50" style="opacity:1;">
									<i class="fas fa-angle-down nav-link-arrow"></i>
								</a>
								<ul class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
									<li><a class="dropdown-item" href="home.php">Home</a></li>
									<li class="border-bottom"></li>
									<li><a class="dropdown-item" href="logout.php">ออกจากระบบ</a></li>
								</ul>
							</li>
						</ul>
						<button class="navbar-toggler ml-2" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
					</div>
				</div>
			</nav>
		</header>
		<div class="container d-flex h-100 animated fadeInDownBig delay">
			<div class="row align-self-center w-100">
				<div class="col-6 mx-auto">
					<h2 class="text-center mb-4">เลือกระบบ</h2>
					<div class="row text-center">

						<div class="col-md-6">
							<div class="hovereffect">
								<div class="bg-warning py-6 text-white mh-100 w-100" > 
									
									<img src="images/home/leave.png" alt="Summer" height="150">
								</div>
								<div class="bg-primary text-white">ระบบลาออนไลน์</div>
								<div class="overlay">
									<h2>ระบบลาออนไลน์</h2>
									<p><a href="<?php echo PATH; ?>/user">เข้าสู่เว็บไซต์</a></p> 
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="hovereffect">
								<div class="bg-warning py-6 h-5 text-white mh-100 w-100" style="max-height:100px;">
									<img src="images/home/acounting.png" alt="Acounting" height="150">
								</div>
								<div class="bg-primary text-white">ระบบบัญชี</div>
								<div class="overlay" >
									<h2>ระบบบัญชี</h2>
									<p><a href="<?php echo PATH; ?>/payroll">เข้าสู่เว็บไซต์</a></p> 
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</body>
	</html>
	<?php require('controller/script.php'); ?> 