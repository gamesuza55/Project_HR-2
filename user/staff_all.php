<?php

require_once('conn_main.php');
function DateThai($strDate)
{
	$strYear = date("Y",strtotime($strDate))+543;
	$strMonth= date("n",strtotime($strDate));
	$strDay= date("j",strtotime($strDate));
	$strHour= date("H",strtotime($strDate));
	$strMinute= date("i",strtotime($strDate));
	$strSeconds= date("s",strtotime($strDate));
	$strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
	$strMonthThai=$strMonthCut[$strMonth];
	return "$strDay $strMonthThai $strYear" ;/*, $strHour:$strMinute";*/
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Page Title</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="css/icofont.min.css">
	<link href="https://fonts.googleapis.com/css?family=Kanit&display=swap&subset=thai" rel="stylesheet"> 
</head>
<style>
	html, body {
		font-family: Kanit, Arial, Verdana, sans-serif;
		background-color:#353434;
	}</style>
	<body>
		<a href="index.php" class="text-primary h1 p-2" data-toggle="tooltip" data-placement="right" title="ย้อนกลับ"><i class="icofont-arrow-right icofont-rotate-180"></i></a>  
		<div class="center">
			<div class="container bg-light p-4">
				<h3 class="text-center"> พนักงานทั้งหมด </h3>
				<div class="table-responsive">
					<table class="table table-bordered table-hover w-100">
						<thead class="thead-dark">
							<tr class="text-center">
								<th scope="col">รูปภาพ</th>
								<th scope="col">ชื่อ-นามสกุล</th>
								<th scope="col">ข้อมูลส่วนตัว</th>
								<th scope="col">แผนก</th>
								<th scope="col">ที่อยู่</th>

							</tr>
						</thead>
						<tbody>
							<?php
							$sql = mysqli_query($conn,"SELECT * FROM member WHERE status = 'user' ");
							while($row = mysqli_fetch_assoc($sql)) { 
								?>
								<tr class="text-center">
									<th><img src="../images/user/<?php echo $row['image_user']; ?>" height="50" ></th>
									<td align="left">
										<?php echo $row['fistname'].'&nbsp;'.$row['lastname'];?>
										<p class="text-muted">
											ชื่อเล่น&nbsp;<?php echo $row['nickname']; ?><br/>
											<?php  if($row['gendar'] == 'male') { echo 'เพศ&nbsp;ผู้ชาย<i class="icofont-businessman"></i>';} elseif($row['gendar'] == 'female') { echo 'เพศ&nbsp; ผู้หญิง<i class="icofont-businesswoman"></i> ';}  ?>
										</p>

										
									</td>
									<td align="left">
										<i class="icofont-email"></i> อีเมลล์&nbsp;<?php echo $row['email'];?>
										<p class="text-muted">
											<i class="icofont-birthday-cake text-dark"></i> วันเกิด&nbsp;<?php echo DateThai($row['birthday']);?><br/>
											<i class="icofont-telephone text-dark"></i> เบอร์โทรศัพท์&nbsp;<?php echo $row['tel']; ?>
										</p>
									</td>
									<td>
										<?php if($row['department'] == "Accounting") { ?>
											ฝ่ายบัญชี
										<?php } elseif($row['department'] == "Programer") { ?>
											โปรแกรมเมอร์
										<?php } elseif($row['department'] == "Marketing") { ?>
											ฝ่ายการตลาด
										<?php } elseif($row['department'] == "Graphic") { ?>
											ฝ่ายกราฟิค
										<?php } ?>
									</td>
									<td class="text-break" width="20%" >&nbsp;<?php echo $row['address'];?></td>
								</tr>
							<?php } ?> 
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
	</body>
	</html>
	<script>
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})
	</script>