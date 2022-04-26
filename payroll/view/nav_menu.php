<div class="nav-wrapper position-relative mb-2">
	<ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-text" role="tablist">
		<li class="nav-item ">
			<a class="nav-link mb-sm-3 mb-md-0 <?php if($page == 'home') { echo "active"; } ; ?>" id="tabs-text-1-tab" href="<?php echo PATH;?>" ><i class="fas fa-home"></i>&nbsp;หน้าหลัก</a>
		</li>
		<li class="nav-item">
			<a class="nav-link mb-sm-3 mb-md-0 <?php if($page == 'revenue_expenditure') { echo "active"; } ; ?> " id="tabs-text-2-tab" href="<?php echo PATH;?>/revenue_expenditure.php" ><i class="fas fa-file-invoice-dollar"></i>&nbsp;รายรับ และ รายจ่าย</a>
		</li>
		<li class="nav-item">
			<a class="nav-link mb-sm-3 mb-md-0 <?php if($page == 'domain') { echo  "active"; }?> " id="tabs-text-3-tab" href="<?php echo PATH;?>/domain.php"><i class="fas fa-network-wired"></i>&nbsp;Domain</a>
		</li>
	</ul>
</div>