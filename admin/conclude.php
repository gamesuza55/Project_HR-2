<?php
$total_sick = mysqli_query($conn, "SELECT COUNT(ID_leave) AS TotalCount FROM sick_leave ");
$row_total_sick = mysqli_fetch_assoc($total_sick);

$sick = mysqli_query($conn, "SELECT COUNT(ID_leave) AS sickCount FROM sick_leave WHERE sick = 'ลาป่วย' AND YEAR(dates) = YEAR(now())");
$row_sick  = mysqli_fetch_assoc($sick);

@$sickAvg = $row_sick['sickCount'] / $row_total_sick['TotalCount']; // เปอร์เซ็น = "จำนวนที่ต้องการ / จำวนวทั้งหมด * 100"
?>
<div class="col-md-4 col-sm-6 col-xs-12">
	<div class="info-box">
		<span class="info-box-icon bg-aqua"><?php echo $row_sick['sickCount']; ?></span>
		
		<div class="info-box-content">
			<span class="info-box-text">ลาป่วย</span>
			<span class="info-box-number">เฉลี่ย <?php if($sickAvg > 0) {echo round($sickAvg,2);} else{ echo 0; } ?><small>วัน</small></span>
		</div>
		<?php if($sickAvg > 5) {  ?>
			<div class="text-danger w-100" style="font-size:80px;position:absolute;right:50px;bottom:0px;">
				<i class="fa fa-frown-o"></i>
			</div>
		<?php } else {?>
			<div class="text-success w-100" style="font-size:80px;position:absolute;right:50px;bottom:0px;">
				<i class="fa fa-smile-o"></i>
			</div>
		<?php }?>

	</div>
</div>
<?php
$personal = mysqli_query($conn, "SELECT COUNT(ID_leave) AS personalCount FROM sick_leave WHERE sick = 'ลากิจ'");
$row_personal  = mysqli_fetch_assoc($personal);
@$personalAvg = $row_personal['personalCount'] / $row_total_sick['TotalCount']; // เปอร์เซ็น = "จำนวนที่ต้องการ / จำวนวทั้งหมด * 100"
?>
<div class="col-md-4 col-sm-6 col-xs-12">
	<div class="info-box">
		<span class="info-box-icon bg-aqua"><?php echo $row_personal['personalCount']; ?></span>

		<div class="info-box-content">
			<span class="info-box-text">ลากิจ</span>
			<span class="info-box-number">เฉลี่ย <?php if($personalAvg > 0) {echo round($personalAvg,2);} else { echo 0;} ?><small>วัน</small></span>
		</div>
		<?php if($personalAvg > 5) {  ?>
			<div class="text-danger w-100" style="font-size:80px;position:absolute;right:50px;bottom:0px;">
				<i class="fa fa-frown-o"></i>
			</div>
		<?php } else {?>
			<div class="text-success w-100" style="font-size:80px;position:absolute;right:50px;bottom:0px;">
				<i class="fa fa-smile-o"></i>
			</div>
		<?php }?>

	</div>
</div>
<?php
$summer = mysqli_query($conn, "SELECT COUNT(ID_leave) AS summerCount FROM sick_leave WHERE sick = 'ลาพักร้อน'");
$row_summer  = mysqli_fetch_assoc($summer);
@$summerAvg = $row_summer['summerCount'] / $row_total_sick['TotalCount'];// เปอร์เซ็น = "จำนวนที่ต้องการ / จำวนวทั้งหมด * 100"
?>
<div class="col-md-4 col-sm-6 col-xs-12">
	<div class="info-box">
		<span class="info-box-icon bg-aqua"><?php echo $row_summer['summerCount']; ?></span>

		<div class="info-box-content">
			<span class="info-box-text">ลาพักร้อน</span>
			<span class="info-box-number">เฉลี่ย <?php if($summerAvg > 0) {echo round($summerAvg,2);} else {echo 0;} ?><small>วัน</small></span>

		</div>
		<?php if($summerAvg > 5) {  ?>
			<div class="text-danger w-100" style="font-size:80px;position:absolute;right:50px;bottom:0px;">
				<i class="fa fa-frown-o"></i>
			</div>
		<?php } else {?>
			<div class="text-success w-100" style="font-size:80px;position:absolute;right:50px;bottom:0px;">
				<i class="fa fa-smile-o"></i>
			</div>
		<?php }?>
	</div>
</div>
