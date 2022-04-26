<?php 
include('../controller/conn.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Kanit&display=swap&subset=thai" rel="stylesheet">
	
</head>
<style>
	.container{
		max-width: 1200px;
	}
	#loader {
		position: absolute;
		left: 50%;
		top: 50%;
		z-index: 1;
		width: 150px;
		height: 150px;
		margin: -75px 0 0 -75px;
		border: 16px solid #f3f3f3;
		border-radius: 50%;
		border-top: 16px solid #3498db;
		width: 120px;
		height: 120px;
		-webkit-animation: spin 2s linear infinite;
		animation: spin 2s linear infinite;
	}

	@-webkit-keyframes spin {
		0% { -webkit-transform: rotate(0deg); }
		100% { -webkit-transform: rotate(360deg); }
	}

	@keyframes spin {
		0% { transform: rotate(0deg); }
		100% { transform: rotate(360deg); }
	}

	/* Add animation to "page content" */
	.animate-bottom {
		position: relative;
		-webkit-animation-name: animatebottom;
		-webkit-animation-duration: 1s;
		animation-name: animatebottom;
		animation-duration: 1s
	}

	@-webkit-keyframes animatebottom {
		from { bottom:-100px; opacity:0 } 
		to { bottom:0px; opacity:1 }
	}

	@keyframes animatebottom { 
		from{ bottom:-100px; opacity:0 } 
		to{ bottom:0; opacity:1 }
	}
	*,
	*:before,
	*:after {
		box-sizing: inherit;
	}
	.intro {
	}
	.table-scroll {
		position: relative;
		width:100%;
		z-index: 1;
		margin: auto;
		overflow: auto;
		height: 600px;
	}
	.table-scroll table {
		width: 100%;
		margin: auto;
		border-collapse: separate;
		border-spacing: 0;
	}
	.table-wrap {
		position: relative;
	}
	.table-scroll th,
	.table-scroll td {

		background: #fff;
		vertical-align: top;
	}
	.table-scroll thead th {
		background: #333;
		color: #fff;
		position: -webkit-sticky;
		position: sticky;
		top: 0;
	}
	/* safari and ios need the tfoot itself to be position:sticky also */
	.table-scroll tfoot,
	.table-scroll tfoot th,
	.table-scroll tfoot td {
		position: -webkit-sticky;
		position: sticky;
		bottom: 0;
		background: #666;
		color: #fff;
		z-index:4;
	}

	a:focus {
		background: red;
		} /* testing links*/

		th:first-child {
			position: -webkit-sticky;
			position: sticky;
			left: 0;
			z-index: 2;
			background: #ccc;
		}
		thead th:first-child,
		tfoot th:first-child {
			z-index: 5;
		}

	</style>
	<body onload="myFunction()" >
		<div id="loader"></div>
		<div class="container mt-3">
			<div class="row">
				<div class="col-md-4">
					<h2>ยอดรวมทั้งหมด</h2>
				</div>
				<div class="col-md-8">
					<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" name="search_date">
						<select name="search_year" id="search_year" class="custom-select float-right ml-2 " style="width:40%;" onchange="search_date.submit();">

							<option value="none">ทั้งหมด(ปี)</option>
							<?php
							$currently_selected = date('Y');
							$earliest_year = 2010; 
							$latest_year = date('Y'); 
							foreach ( range( $latest_year, $earliest_year ) as $i ) {
								$date_thai  = $i + 543;
								?>
								<option value="<?php echo $i; ?>" <?php if(@$_POST['search_year'] == $i) { echo "selected";} ?>><?php echo $date_thai; ?></option>';
								// 
								<?php
							} 

							?>
						</select>
						<select name="search_mounth" id="search_mounth" class="custom-select float-right" style="width:40%" onchange="search_date.submit();">
							<option value="none">ทั้งหมด(เดือน)</option>
							<option value="01" <?php if(@$_POST['search_mounth'] == '01') { echo "selected"; } ?>>มกราคม</option>
							<option value="02" <?php if(@$_POST['search_mounth'] == '02') { echo "selected"; } ?>>กุมภาพันธ์</option>
							<option value="03" <?php if(@$_POST['search_mounth'] == '03') { echo "selected"; } ?>>มีนาคม</option>
							<option value="04" <?php if(@$_POST['search_mounth'] == '04') { echo "selected"; } ?>>เมษายน</option>
							<option value="05" <?php if(@$_POST['search_mounth'] == '05') { echo "selected"; } ?>>พฤษภาคม</option>
							<option value="06" <?php if(@$_POST['search_mounth'] == '06') { echo "selected"; } ?>>มิถุนายน</option>
							<option value="07" <?php if(@$_POST['search_mounth'] == '07') { echo "selected"; } ?>>กรกฏาคม</option>
							<option value="08" <?php if(@$_POST['search_mounth'] == '08') { echo "selected"; } ?>>สิงหาคม</option>
							<option value="09" <?php if(@$_POST['search_mounth'] == '09') { echo "selected"; } ?>>กันยายน</option>
							<option value="10" <?php if(@$_POST['search_mounth'] == '10') { echo "selected"; } ?>>ตุลาคม</option>
							<option value="11" <?php if(@$_POST['search_mounth'] == '11') { echo "selected"; } ?>>พฤศจิกายน</option>
							<option value="12" <?php if(@$_POST['search_mounth'] == '12') { echo "selected"; } ?>>ธันวาคม</option>
						</select>

					</form>
				</div>
			</div>
			<div id="table-scroll" class="table-scroll">
				<table class="table table-bordered main-table" style="width:100%;display:none;" id="myDiv">
					<thead class="bg-light">
						<tr >	
							<th scope="col" class="text-center">ครั้งที่</th>
							<th scope="col" class="text-center">วันที่</th>
							<th scope="col" class="text-center">รายรับ <i class="fas fa-hand-holding-usd text-success h3"></i></th>
							<th scope="col" class="text-center">รายจ่าย <i class="fas fa-hand-holding-usd text-danger h3"></i></th>
							<th scope="col" class="text-center">เงินสุทธิ</th>
							<!-- <th scope="col">วันที่</th> -->
						</tr>
					</thead>
					<tbody>
						<?php
						if(isset($_POST['search_year']) && isset($_POST['search_mounth'])) {
							$search_year = $_POST['search_year'];
							$search_mounth  = $_POST['search_mounth'];
							$sql = "SELECT *  FROM order_payroll WHERE date_format(date_order, '%m %Y')='$search_mounth $search_year' ";

							if($_POST['search_year'] == "none" && $_POST['search_mounth'] ) {
				// echo 'เดือน';
								$sql = "SELECT *  FROM order_payroll WHERE date_format(date_order, '%m ')='$search_mounth'  ";
							}
							if($_POST['search_mounth'] == "none" && $_POST['search_year']) {
				// echo 'ปี';
								$sql = "SELECT *  FROM order_payroll WHERE date_format(date_order, '%Y ')='$search_year'  ";
							}
							if($_POST['search_year'] == "none" && $_POST['search_mounth'] == "none" ) {
				// echo 'ว่าง';
								$sql = "SELECT *  FROM order_payroll ";
							} 
						} else {
							$sql = "SELECT *  FROM order_payroll ";
						}
						$result = mysqli_query($conn, $sql);
						$sum_revenue_total = 0;
						$sum_expenditrue_total = 0;
						$total = 0;
						$total_revenue = 0;

						if(mysqli_num_rows($result) > 0){
							while($row = mysqli_fetch_assoc($result)) {
								?>
								<tr>
									<td align="center" ><?php echo $row['id_order'] ?></td>
									<td align="center" ><?php echo DateThai($row['date_order']); ?></td>
									<td >
										<?php 
										$sql_revenue = "SELECT * FROM revenue_payroll where id_order = '".$row['id_order']."'";
										$result_revenue = mysqli_query($conn, $sql_revenue);
										$num_revenue = mysqli_num_rows($result_revenue);
										while($revenue = mysqli_fetch_assoc($result_revenue)){
											?>
											<div class="row">
												<div class="col-md-6" style="word-break: break-all;">
													<a href="delete_payroll.php?list-revenue=<?php echo $revenue['id_revenue'];?>" class="text-danger" onclick="return confirm('ต้องการลบข้อมูลนี้หรือไม่?')">
														<i class="<?php if($num_revenue > 1) { echo 'fas fa-minus-circle'; } ?>" ></i>
													</a>
													<?php echo $revenue['detail_revenue'];?>
												</div>
												<div class="col-md-6 text-right">
													<?php echo $revenue['revenue']; ?>
												</div>
											</div>
											<hr>
											<?php
										}
										?>
									</td>
									<td >
										<?php 
										$sql_expenditure = "SELECT * FROM expenditure_payroll where id_order = '".$row['id_order']."'";
										$result_expenditure = mysqli_query($conn, $sql_expenditure);
										$num_expenditure = mysqli_num_rows($result_expenditure);
										while($expenditure = mysqli_fetch_assoc($result_expenditure)){
											?>
											<div class="row">
												<div class="col-md-6" style="word-break: break-all;">
													<a href="delete_payroll.php?list-expenditure=<?php echo $expenditure['id_expenditure'];?>" class="text-danger" onclick="return confirm('ต้องการลบข้อมูลนี้หรือไม่?')">
														<i class="<?php if($num_expenditure > 1) { echo 'fas fa-minus-circle'; } ?>" ></i>
													</a>
													<?php echo $expenditure['detail_expenditure'];?>
												</div>
												<div class="col-md-6 text-right">
													<?php echo $expenditure['expenditure']; ?>
												</div>
											</div>
											<hr>
											<?php
										}
										?>
									</td>
									<td align="center" >
										<a href="delete_payroll.php?del=<?php echo $row['id_order']?>" class="close text-danger h-100 float-none" style="line-height: 200px;" data-toggle="tooltip" data-placement="bottom" title="ลบ" onclick="return confirm('ต้องการลบข้อมูลนี้หรือไม่?');"><i class="fas fa-trash align-middle h1"></i></a>
									</td>
								</tr>

								<tr align="center" class="bg-light">
									<td colspan="2">รวม ครั้งที่ <?php echo $row['id_order']; ?></td>
									<td class="text-success" scope="row"> 
										<?php 
										$sql_sum_revenue = "SELECT SUM(REPLACE(revenue,',','')) AS revenue FROM revenue_payroll WHERE id_order = '".$row['id_order']."' ";
										$result_sum_revenue = mysqli_query($conn, $sql_sum_revenue);
										while($sum_revenue = mysqli_fetch_assoc($result_sum_revenue)) {
											echo number_format($sum_revenue['revenue']).' ฿';
											$sum_revenue_total += $sum_revenue['revenue'];
										}

										?>
									</td>
									<td class="text-danger ">
										<?php 
										$sql_sum_expenditure = "SELECT SUM(REPLACE(expenditure,',','')) AS expenditure FROM expenditure_payroll WHERE id_order = '".$row['id_order']."' ";
										$result_sum_expenditure = mysqli_query($conn, $sql_sum_expenditure);
										while($sum_expenditure = mysqli_fetch_assoc($result_sum_expenditure)) {
											echo number_format($sum_expenditure['expenditure']).' ฿';
											$sum_expenditrue_total += $sum_expenditure['expenditure'];
										}

										?>
									</td>
									<td>
										<?php
										$sql_minus_revenue = "SELECT SUM(REPLACE(revenue,',','')) AS revenue FROM revenue_payroll WHERE id_order = '".$row['id_order']."'  ";
										$result_minus_revenue = mysqli_query($conn, $sql_minus_revenue);
										while($minus_revenue = mysqli_fetch_assoc($result_minus_revenue)) {

											$sql_minus_expenditure = "SELECT SUM(REPLACE(expenditure,',','')) AS expenditure FROM expenditure_payroll WHERE id_order = '".$row['id_order']."'  ";
											$result_minus_expenditure = mysqli_query($conn, $sql_minus_expenditure);

											while($minus_expenditure = mysqli_fetch_assoc($result_minus_expenditure)) {

												$sum_total = $minus_revenue['revenue'] - $minus_expenditure['expenditure']  ;
												if($sum_total < 0) {
													echo '<span class="text-danger" style="text-decoration:underline;">'.number_format($sum_total).'฿ </span> ';
												} else {
													echo '<span class="text-success" style="text-decoration:underline;">'.number_format($sum_total).'฿ </span> ';
												}
												$total = $sum_revenue_total - $sum_expenditrue_total ;
											}
										}
										?>
									</td>	
								</tr>
								<?php 
							}
						}
						?>
					</tbody>
					<tfoot >
						<tr align="center" class="bg-light">
							<td colspan="2" class="fixed"><h4>รวมทั้งหมด</h4></td>
							<td class="fixed"><b><?php echo "<h4>".number_format($sum_revenue_total)."฿</h4>";?></b></td>
							<td class="fixed"><b><?php echo "<h4>".number_format($sum_expenditrue_total)."฿<h4>"; ?></b></td>
								<td class="fixed">
									<?php 
									if($total < 0){
										echo "<h4 class='text-danger'>".number_format($total)."฿</h4>"; 
									} else {
										echo "<h4 class='text-success'>".number_format($total)."฿</h4>"; 
									}
									$vat = $total*7/100;
									?>
								</td>
							</tr>
							<!-- <td>Vat <?php echo $vat ; ?></td> -->
						</tfoot>

					</table>
				</div>
			</div>
		</body>
		</html>

		<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

		<script src="https://kit.fontawesome.com/a58fea8e8b.js"></script>
		<script>
			var myVar;

			function myFunction() {
				myVar = setTimeout(showPage, 500);
			}

			function showPage() {
				document.getElementById("loader").style.display = "none";
				document.getElementById("myDiv").style.display = "";
			}
		</script>
		<script>
			$(function () {
				$('[data-toggle="tooltip"]').tooltip()
			})

		</script>
		<?php
		function DateThai($strDate)
		{
			$strYear = date("Y",strtotime($strDate)) + 543;
			$strMonth= date("n",strtotime($strDate));
			$strDay= date("j",strtotime($strDate));

			$strMonthCut = Array("","มกราคม", "กุมภาพันธ์", "มีนาคม",
				"เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม",
				"สิงหาคม", "กันยายน", "ตุลาคม",
				"พฤศจิกายน", "ธันวาคม");
			$strMonthThai=$strMonthCut[$strMonth];
			return "$strDay $strMonthThai $strYear" ;/*, $strHour:$strMinute";*/
		}

		?>


