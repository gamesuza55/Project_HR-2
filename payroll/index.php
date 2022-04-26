<?php 
session_start();
require('config.php'); 
require('controller/conn.php'); 
$page = "home";

if((!$_SESSION['user'] ?? false)) {
	header('location:../index.php');
	exit;
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php require('controller/head.php'); ?>
	<style>
	.loading {
		position: fixed;
		left: 0px;
		top: 0px;
		width: 100%;
		height: 100%;
		z-index: 9999;
		background: url(img/loader-128x/Preloader_7.gif) center no-repeat #fff;
	}
	</style> 

</head>
<body>
	<div class="loading"></div>
	<?php require('view/header.php'); ?> 
	<section class="section-sm">
		<div class="container" style="max-width:1250px;">
			<div class="row mt-5 ">
				<div class="col-lg-12">
					<!-- nav tab -->
					<?php require('view/nav_menu.php');?>
					<!-- order_payroll -->
					<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" name="search_date">
						<button class="float-right mt-2 ml-2 btn btn-link"><i class="fas fa-search"></i></button>
						<select name="search_year" id="search_year" class="custom-select mb-3 ml-3 float-right" style="width:15%">

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

						<select name="search_mounth" id="search_mounth" class="custom-select mb-3  float-right" style="width:15%">
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
					<?php require('page/order_payroll.php'); ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php require('view/footer.php'); ?>

</body>
</html>
<?php require('controller/script.php'); ?> 
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<script>
$.noConflict();
jQuery(window).load(function() {

	setInterval(function(){ jQuery(".loading").fadeOut('normal'); }, 500);
});
</script>
<script>	
// jQuery Plugin: http://flaviusmatis.github.io/simplePagination.js/

var items = $(".list-wrapper .list-item");
var numItems = items.length;
var perPage = 10;

items.slice(perPage).hide();

$('#pagination-container').pagination({
	items: numItems,
	itemsOnPage: perPage,
	prevText: "&laquo;",
	nextText: "&raquo;",
	onPageClick: function (pageNumber) {
		var showFrom = perPage * (pageNumber - 1);
		var showTo = showFrom + perPage;
		items.hide().slice(showFrom, showTo).show();
	}
});

</script>


