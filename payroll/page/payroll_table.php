<?php 
include('../controller/conn.php');
$id_order = $_GET['id'];

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
	<link rel="stylesheet" href="../dist/css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Kanit&display=swap&subset=thai" rel="stylesheet">
	
</head>
<style>
	body 
	.container{
		max-width: 1200px;
	}

</style>
<body>
	<div class="container mt-5">
		<h2>รายการที่ <?php echo $id_order; ?></h2>
		
		<table class="table table-bordered main-table" style="width:100%">
			<thead class="bg-light">
				<tr>	
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
				$sql = "SELECT * FROM order_payroll where id_order = '$id_order'";
				$result = mysqli_query($conn, $sql);
				$sum_revenue_total = 0;
				$sum_expenditrue_total = 0;
				$total = 0;
				$total_revenue = 0;

				if(mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_assoc($result)) {
						?>
						<tr>
							<td align="center" ><?php echo $id_order ?></td>
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
											<a href="delete_payroll.php?list-revenue=<?php echo $revenue['id_revenue'];?>&turn=<?php echo $row['id_order']?>" class="text-danger" onclick="return confirm('ต้องการลบข้อมูลนี้หรือไม่?')">
												<i class="<?php if($num_revenue > 1) { echo 'fas fa-minus-circle'; } ?>" ></i>
											</a>
											<?php echo $revenue['detail_revenue']?>
										</div>
										<div class="col-md-6 text-right">
											<?php echo $revenue['revenue'] ?>
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
											<a href="delete_payroll.php?list-expenditure=<?php echo $expenditure['id_expenditure'];?>&turn=<?php echo $row['id_order']?>" class="text-danger" onclick="return confirm('ต้องการลบข้อมูลนี้หรือไม่?')">
												<i class="<?php if($num_expenditure > 1) { echo 'fas fa-minus-circle'; } ?>" ></i>
											</a>
											<?php echo $expenditure['detail_expenditure']?>
										</div>
										<div class="col-md-6 text-right">
											<?php echo $expenditure['expenditure'] ?>
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
								$sql_sum_revenue = "SELECT SUM(REPLACE(revenue, ',','')) as revenue FROM revenue_payroll WHERE id_order = '".$row['id_order']."' ";
								$result_sum_revenue = mysqli_query($conn, $sql_sum_revenue);
								while($sum_revenue = mysqli_fetch_assoc($result_sum_revenue)) {
									echo number_format($sum_revenue['revenue']).' ฿';
									$sum_revenue_total += $sum_revenue['revenue'];
								}

								?>
							</td>
							<td class="text-danger ">
								<?php 
								$sql_sum_expenditure = "SELECT SUM(REPLACE(expenditure, ',','')) as expenditure  FROM expenditure_payroll WHERE id_order = '".$row['id_order']."' ";
								$result_sum_expenditure = mysqli_query($conn, $sql_sum_expenditure);
								while($sum_expenditure = mysqli_fetch_assoc($result_sum_expenditure)) {
									echo number_format($sum_expenditure['expenditure']).' ฿';
									$sum_expenditrue_total += $sum_expenditure['expenditure'];
								}

								?>
							</td>
							<td>
								<?php
								$sql_minus_revenue = "SELECT SUM(REPLACE(revenue, ',','')) as revenue FROM revenue_payroll WHERE id_order = '".$row['id_order']."'  ";
								$result_minus_revenue = mysqli_query($conn, $sql_minus_revenue);
								while($minus_revenue = mysqli_fetch_assoc($result_minus_revenue)) {

									$sql_minus_expenditure = "SELECT SUM(REPLACE(expenditure, ',','')) as expenditure FROM expenditure_payroll WHERE id_order = '".$row['id_order']."'  ";
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
			<tfoot>
				<tr align="center" class="bg-light">
					<td colspan="2"><h4>รวมทั้งหมด</h4></td>
					<td><b><?php echo "<h4>".number_format($sum_revenue_total)."฿</h4>";?></b></td>
					<td><b><?php echo "<h4>".number_format($sum_expenditrue_total)."฿<h4>"; ?></b></td>
						<td>
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


