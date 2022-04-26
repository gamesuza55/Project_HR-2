<style>
	.bg-blink {
		animation: blinker 3s linear ;

	}
	@keyframes blinker {
		50% {
			color:white;
			background-color: #fbee78;
			border: 3px solid gray;
		}
	}
</style>

<table class="table table-bordered list-wrapper" id="table_domain">
	<thead class="thead-inverse">
		<tr align="center">
			<th class="h6 py-4"	>ชื่อบริษัท/ชื่อผู้ติดต่อ/เบอร์โทรศัพท์</th>
			<th class="h6 py-4 ">Doamin</th>
			<th class="h6 py-4">วันที่เริ่มจดโดเมน</th>
			<th class="h6 py-4">วันที่สุิ้นสุดโดเมน</th>
			<th class="h6 py-4">ยอดชำระ</th>
			<th class="h6 py-4">
				<form id="sort_filter" name="sort_filter" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
					<?php if(isset($_GET['sort_status']) == 'on'){  $sort_status = 'ORDER BY due_date DESC'; ?>
					<div class="form-check">
						<label class="form-check-label" style="color:black;">
							สถานะ
							<input class="form-check-input" type="checkbox" name="sort_status" onclick="sort_filter.submit()" checked >
							<span class="form-check-sign"></span>
						</label>
					</div>
				<?php  } else  {  $sort_status = 'ORDER BY due_date ASC';?>
				<div class="form-check">
					<label class="form-check-label" style="color:black;">
						สถานะ
						<input class="form-check-input" type="checkbox" name="sort_status" onclick="sort_filter.submit()" >
						<span class="form-check-sign"></span>
					</label>
				</div>
			<?php  }?>
		</form>
	</th>
	<th class="h6 py-4"></th>
</tr>
</thead>
<tbody>
	<?php 
	$sql = mysqli_query($conn, "SELECT * FROM domain $sort_status ");
// -------------------------------------------- search all day!!--------------------------------------------------------------
	if(isset($_POST['search_domain']) == 'all'){
		if(mysqli_num_rows($sql) > 0 ) {
			while($row = mysqli_fetch_assoc($sql)) { 
				$sql_check = mysqli_query($conn, "SELECT *, IF(DATEDIFF(due_date,now()) = 3,'3','than3') AS status, IF(DATEDIFF(due_date,now()) = 30,'30','30than') AS status30,DATEDIFF(due_date,now()) AS status_day,DATEDIFF(now(),due_date) AS status_than FROM domain  WHERE id_domain = '".$row['id_domain']."' ");
				while($row_check = mysqli_fetch_assoc($sql_check)) {
					if($row_check['status_day'] <= 0) {
						?> 
						<tr align="center" class="list-item">
							<td class="font-weight-light" align="left">
								<?php echo $row_check['name_company']; ?>
								<p class="text-muted">
									คุณ&nbsp;<?php echo $row_check['user_domain']; ?><br/>
									ติดต่อ&nbsp;<?php echo $row_check['tel_domain'] ?>
								</p>
							</td>
							<td class="font-weight-light"><?php echo $row_check['domain']; ?></td>
							<td class="font-weight-light"><?php echo DateThai($row_check['start_date']); ?></td>
							<td class="font-weight-light"><?php echo DateThai($row_check['due_date']); ?></td>
							<td class="font-weight-light"><?php echo number_format($row_check['cost']).'.-'; ?></td>
							<td class="font-weight-light">
								<span class="badge badge-danger text-uppercase">
									เกิน <?php  echo $row_check['status_than']; ?> วัน
								</span><br/>
								<a href="?perdoamin=<?php echo $row['id_domain'];?>" class="text-success" onclick="return confirm('ต้องการต่อโดเมนหรือมั้ย ?');"><small>ต่ออายุโดเมน</small></a>
								
							</td>
							<td >
								<button class="btn animate-up-2 mr-2 mb-2 btn-pill btn-outline-warning btn-sm edit-domain" type="button"data-toggle="modal" data-target="#modal-domain-edit" 
								data-id         = "<?php echo $row['id_domain']; ?>"
								data-company    = "<?php echo $row['name_company']; ?>"
								data-user-doamin= "<?php echo $row['user_domain']; ?>"
								data-tel-domain = "<?php echo $row['tel_domain']; ?>"
								data-domain     = "<?php echo $row['domain']; ?>"
								data-start-date = "<?php echo $row['start_date']; ?>"
								data-due-date   = "<?php echo $row['due_date']; ?>"
								data-cost       = "<?php echo $row['cost']; ?>"><i class="far fa-edit"></i></button>

								<button class="btn animate-up-2 mr-2 mb-2 btn-pill btn-outline-danger btn-sm delete" type="button"  data-delete = "<?php echo $row['id_domain']; ?>"><i class="far fa-trash-alt"></i></button>
							</td>
						</tr>
						<?php 
					}  elseif($row_check['status_day'] <= 3) {
						?>
						<tr align="center" class="list-item">
							<td class="font-weight-light" align="left">
								<?php echo $row_check['name_company']; ?>
								<p class="text-muted">
									คุณ&nbsp;<?php echo $row_check['user_domain']; ?><br/>
									ติดต่อ&nbsp;<?php echo $row_check['tel_domain'] ?>
								</p>
							</td>
							<td class="font-weight-light"><?php echo $row_check['domain']; ?></td>
							<td class="font-weight-light"><?php echo DateThai($row_check['start_date']); ?></td>
							<td class="font-weight-light"><?php echo DateThai($row_check['due_date']); ?></td>
							<td class="font-weight-light"><?php echo number_format($row_check['cost']).'.-'; ?></td>
							<td class="font-weight-light">
								<span class="badge badge-warning text-uppercase">
									เหลือ <?php  echo $row_check['status_day']; ?> วัน
								</span><br/>
								<a href="?perdoamin=<?php echo $row['id_domain'];?>" class="text-success" onclick="return confirm('ต้องการต่อโดเมนหรือมั้ย ?');"><small>ต่ออายุโดเมน</small></a>

							</td>
							<td >
								<button class="btn animate-up-2 mr-2 mb-2 btn-pill btn-outline-warning btn-sm edit-domain" type="button"data-toggle="modal" data-target="#modal-domain-edit" 
								data-id         = "<?php echo $row['id_domain']; ?>"
								data-company    = "<?php echo $row['name_company']; ?>"
								data-user-doamin= "<?php echo $row['user_domain']; ?>"
								data-tel-domain = "<?php echo $row['tel_domain']; ?>"
								data-domain     = "<?php echo $row['domain']; ?>"
								data-start-date = "<?php echo $row['start_date']; ?>"
								data-due-date   = "<?php echo $row['due_date']; ?>"
								data-cost       = "<?php echo $row['cost']; ?>"><i class="far fa-edit"></i></button>

								<button class="btn animate-up-2 mr-2 mb-2 btn-pill btn-outline-danger btn-sm delete" type="button"  data-delete = "<?php echo $row['id_domain']; ?>"><i class="far fa-trash-alt"></i></button>
							</td>
						</tr>
						<?php
					}  elseif($row_check['status30'] == '30') {
						?>
						<tr align="center" class="list-item ">
							<td class="font-weight-light" align="left">
								<?php echo $row_check['name_company']; ?>
								<p class="text-muted">
									คุณ&nbsp;<?php echo $row_check['user_domain']; ?><br/>
									ติดต่อ&nbsp;<?php echo $row_check['tel_domain'] ?>
								</p>
							</td>
							<td class="font-weight-light"><?php echo $row_check['domain']; ?></td>
							<td class="font-weight-light"><?php echo DateThai($row_check['start_date']); ?></td>
							<td class="font-weight-light"><?php echo DateThai($row_check['due_date']); ?></td>
							<td class="font-weight-light"><?php echo number_format($row_check['cost']).'.-'; ?></td>
							<td class="font-weight-light"><span class="badge badge-primary text-uppercase">เหลืออีก <?php  echo $row_check['status_day']; ?> วัน</span><br/>
								<a href="?perdoamin=<?php echo $row['id_domain'];?>" class="text-success" onclick="return confirm('ต้องการต่อโดเมนหรือมั้ย ?');"><small>ต่ออายุโดเมน</small></a>
							</td>

							<td >


								<button class="btn animate-up-2 mr-2 mb-2 btn-pill btn-outline-warning btn-sm edit-domain" type="button"data-toggle="modal" data-target="#modal-domain-edit" 
								data-id         = "<?php echo $row['id_domain']; ?>"
								data-company    = "<?php echo $row['name_company']; ?>"
								data-user-doamin= "<?php echo $row['user_domain']; ?>"
								data-tel-domain = "<?php echo $row['tel_domain']; ?>"
								data-domain     = "<?php echo $row['domain']; ?>"
								data-start-date = "<?php echo $row['start_date']; ?>"
								data-due-date   = "<?php echo $row['due_date']; ?>"
								data-cost       = "<?php echo $row['cost']; ?>"><i class="far fa-edit"></i></button>

								<button class="btn animate-up-2 mr-2 mb-2 btn-pill btn-outline-danger btn-sm delete" type="button"  data-delete = "<?php echo $row['id_domain']; ?>"><i class="far fa-trash-alt"></i></button>
							</td>
						</tr>
						<?php

					} elseif ($row_check['status_day'] > 3) {
						?>
						<tr align="center" class="list-item" >
							<td class="font-weight-light" align="left">
								<?php echo $row_check['name_company']; ?>
								<p class="text-muted">
									คุณ&nbsp;<?php echo $row_check['user_domain']; ?><br/>
									ติดต่อ&nbsp;<?php echo $row_check['tel_domain'] ?>
								</p>
							</td>
							<td class="font-weight-light"><?php echo $row_check['domain']; ?></td>
							<td class="font-weight-light"><?php echo DateThai($row_check['start_date']); ?></td>
							<td class="font-weight-light"><?php echo DateThai($row_check['due_date']); ?></td>
							<td class="font-weight-light"><?php echo number_format($row_check['cost']).'.-'; ?></td>
							<td class="font-weight-light"><span class="badge badge-primary text-uppercase">เหลืออีก <?php  echo $row_check['status_day']; ?> วัน</span><br/>
								<a href="?perdoamin=<?php echo $row['id_domain'];?>" class="text-success" onclick="return confirm('ต้องการต่อโดเมนหรือมั้ย ?');"><small>ต่ออายุโดเมน</small></a>
							</td>
							<td>

								<button class="btn animate-up-2 mr-2 mb-2 btn-pill btn-outline-warning btn-sm edit-domain" type="button"data-toggle="modal" data-target="#modal-domain-edit" 
								data-id         = "<?php echo $row['id_domain']; ?>"
								data-company    = "<?php echo $row['name_company']; ?>"
								data-user-doamin= "<?php echo $row['user_domain']; ?>"
								data-tel-domain = "<?php echo $row['tel_domain']; ?>"
								data-domain     = "<?php echo $row['domain']; ?>"
								data-start-date = "<?php echo $row['start_date']; ?>"
								data-due-date   = "<?php echo $row['due_date']; ?>"
								data-cost       = "<?php echo $row['cost']; ?>"><i class="far fa-edit"></i></button>

								<button class="btn animate-up-2 mr-2 mb-2 btn-pill btn-outline-danger btn-sm delete" type="button"  data-delete = "<?php echo $row['id_domain']; ?>"><i class="far fa-trash-alt"></i></button>
							</td>
						</tr>
						<?php 
					}
				}
			}
		}  else {
			echo '<td class="font-weight-light" colspan="6" align="center">ไม่มีข้อมูล</td>';
		}

// -------------------------------------------- search 3 day!!---------------------------------------------------------------
	} elseif(isset($_POST['search_domain']) == '3' or isset($_GET['id_nofi'])){
		if(mysqli_num_rows($sql) > 0 ) {
			while($row = mysqli_fetch_assoc($sql)) { 
				$sql_check = mysqli_query($conn, "SELECT *, IF(DATEDIFF(due_date,now()) = 3,'3','3than') AS status,DATEDIFF(due_date,now()) AS status_day FROM domain  WHERE id_domain = '".$row['id_domain']."' ");
				while($row_check = mysqli_fetch_assoc($sql_check)) {
					if($row_check['status'] == '3') {
						?> 
						<tr align="center" class="list-item <?php if($_GET['id_nofi'] == $row['id_domain']) { echo "bg-blink";} ?>" id="tr_day3">
							<td class="font-weight-light" align="left">
								<?php echo $row_check['name_company']; ?>
								<p class="text-muted">
									คุณ&nbsp;<?php echo $row_check['user_domain']; ?><br/>
									ติดต่อ&nbsp;<?php echo $row_check['tel_domain'] ?>
								</p>
							</td>
							<td class="font-weight-light"><?php echo $row_check['domain']; ?></td>
							<td class="font-weight-light"><?php echo DateThai($row_check['start_date']); ?></td>
							<td class="font-weight-light"><?php echo DateThai($row_check['due_date']); ?></td>
							<td class="font-weight-light"><?php echo number_format($row_check['cost']).'.-'; ?></td>
							<td class="font-weight-light"><span class="badge badge-warning text-uppercase">เหลืออีก <?php  echo $row_check['status_day']; ?> วัน</span><br/>
								<a href="?perdoamin=<?php echo $row['id_domain'];?>" class="text-success" onclick="return confirm('ต้องการต่อโดเมนหรือมั้ย ?');"><small>ต่ออายุโดเมน</small></a>
							</td>
							<td>

								<button class="btn animate-up-2 mr-2 mb-2 btn-pill btn-outline-warning btn-sm edit-domain" type="button"data-toggle="modal" data-target="#modal-domain-edit" 
								data-id         = "<?php echo $row['id_domain']; ?>"
								data-company    = "<?php echo $row['name_company']; ?>"
								data-user-doamin= "<?php echo $row['user_domain']; ?>"
								data-tel-domain = "<?php echo $row['tel_domain']; ?>"
								data-domain     = "<?php echo $row['domain']; ?>"
								data-start-date = "<?php echo $row['start_date']; ?>"
								data-due-date   = "<?php echo $row['due_date']; ?>"
								data-cost       = "<?php echo $row['cost']; ?>"><i class="far fa-edit"></i></button>

								<button class="btn animate-up-2 mr-2 mb-2 btn-pill btn-outline-danger btn-sm delete" type="button"  data-delete = "<?php echo $row['id_domain']; ?>"><i class="far fa-trash-alt"></i></button>
							</td>
						</tr>
						<?php 
					} 
				}
			}
		}  else {
			echo '<td class="font-weight-light" colspan="6" align="center">ไม่มีข้อมูล</td>';
		}
// -------------------------------------------- search 30 day!!---------------------------------------------------------------
	} elseif (isset($_POST['search_domain']) == '30' or isset($_GET['id_nofi30'])) {
		if(mysqli_num_rows($sql) > 0 ) {
			while($row = mysqli_fetch_assoc($sql)) { 
				$sql_check = mysqli_query($conn, "SELECT *, IF(DATEDIFF(due_date,now()) = 30,'30','30than') AS status,DATEDIFF(due_date,now()) AS status_day FROM domain  WHERE id_domain = '".$row['id_domain']."' ");
				while($row_check = mysqli_fetch_assoc($sql_check)) {
					if($row_check['status'] == '30') {
						?> 
						<tr align="center" id="tr_day3" class="list-item <?php if($_GET['id_nofi30'] == $row_check['id_domain']) { echo "bg-blink";} ?>" >
							<td class="font-weight-light" align="left">
								<?php echo $row_check['name_company']; ?>
								<p class="text-muted">
									คุณ&nbsp;<?php echo $row_check['user_domain']; ?><br/>
									ติดต่อ&nbsp;<?php echo $row_check['tel_domain'] ?>
								</p>
							</td>
							<td class="font-weight-light"><?php echo $row_check['domain']; ?></td>
							<td class="font-weight-light"><?php echo DateThai($row_check['start_date']); ?></td>
							<td class="font-weight-light"><?php echo DateThai($row_check['due_date']); ?></td>
							<td class="font-weight-light"><?php echo number_format($row_check['cost']).'.-'; ?></td>
							<td class="font-weight-light"><span class="badge badge-primary text-uppercase">เหลืออีก <?php  echo $row_check['status_day']; ?> วัน</span><br/>
								<a href="?perdoamin=<?php echo $row['id_domain'];?>" class="text-success" onclick="return confirm('ต้องการต่อโดเมนหรือมั้ย ?');"><small>ต่ออายุโดเมน</small></a>
							</td>
							<td >

								<button class="btn animate-up-2 mr-2 mb-2 btn-pill btn-outline-warning btn-sm edit-domain" type="button"data-toggle="modal" data-target="#modal-domain-edit" 
								data-id         = "<?php echo $row['id_domain']; ?>"
								data-company    = "<?php echo $row['name_company']; ?>"
								data-user-doamin= "<?php echo $row['user_domain']; ?>"
								data-tel-domain = "<?php echo $row['tel_domain']; ?>"
								data-domain     = "<?php echo $row['domain']; ?>"
								data-start-date = "<?php echo $row['start_date']; ?>"
								data-due-date   = "<?php echo $row['due_date']; ?>"
								data-cost       = "<?php echo $row['cost']; ?>"><i class="far fa-edit"></i></button>

								<button class="btn animate-up-2 mr-2 mb-2 btn-pill btn-outline-danger btn-sm delete" type="button"  data-delete = "<?php echo $row['id_domain']; ?>"><i class="far fa-trash-alt"></i></button>
							</td>
						</tr>
						<?php 
					} 
				}
			}
		}  else {
			echo '<td class="font-weight-light" colspan="6" align="center">ไม่มีข้อมูล</td>';
		}

	} else {
		if(mysqli_num_rows($sql) > 0 ) {
			while($row = mysqli_fetch_assoc($sql)) { 
				$sql_check = mysqli_query($conn, "SELECT *, IF(DATEDIFF(due_date,now()) = 3,'3','than3') AS status, IF(DATEDIFF(due_date,now()) = 30,'30','30than') AS status30,DATEDIFF(due_date,now()) AS status_day,DATEDIFF(now(),due_date) AS status_than FROM domain  WHERE id_domain = '".$row['id_domain']."' ");
				while($row_check = mysqli_fetch_assoc($sql_check)) {
					if($row_check['status_day'] <= 0) {
						?> 
						<tr align="center" class="list-item">
							<td class="font-weight-light" align="left">
								<?php echo $row_check['name_company']; ?>
								<p class="text-muted">
									คุณ&nbsp;<?php echo $row_check['user_domain']; ?><br/>
									ติดต่อ&nbsp;<?php echo $row_check['tel_domain'] ?>
								</p>
							</td>
							<td class="font-weight-light"><?php echo $row_check['domain']; ?></td>
							<td class="font-weight-light"><?php echo DateThai($row_check['start_date']); ?></td>
							<td class="font-weight-light"><?php echo DateThai($row_check['due_date']); ?></td>
							<td class="font-weight-light"><?php echo number_format($row_check['cost']).'.-'; ?></td>
							<td class="font-weight-light">
								<span class="badge badge-danger text-uppercase">
									เกิน <?php  echo $row_check['status_than']; ?> วัน
								</span><br/>
								<a href="?perdoamin=<?php echo $row['id_domain'];?>" class="text-success" onclick="return confirm('ต้องการต่อโดเมนหรือมั้ย ?');"><small>ต่ออายุโดเมน</small></a>


								
							</td>
							<td >
								<button class="btn animate-up-2 mr-2 mb-2 btn-pill btn-outline-warning btn-sm edit-domain" type="button"data-toggle="modal" data-target="#modal-domain-edit" 
								data-id         = "<?php echo $row['id_domain']; ?>"
								data-company    = "<?php echo $row['name_company']; ?>"
								data-user-doamin= "<?php echo $row['user_domain']; ?>"
								data-tel-domain = "<?php echo $row['tel_domain']; ?>"
								data-domain     = "<?php echo $row['domain']; ?>"
								data-start-date = "<?php echo $row['start_date']; ?>"
								data-due-date   = "<?php echo $row['due_date']; ?>"
								data-cost       = "<?php echo $row['cost']; ?>"><i class="far fa-edit"></i></button>

								<button class="btn animate-up-2 mr-2 mb-2 btn-pill btn-outline-danger btn-sm delete" type="button"  data-delete = "<?php echo $row['id_domain']; ?>"><i class="far fa-trash-alt"></i></button>
							</td>
						</tr>
						<?php 
					}  elseif($row_check['status_day'] <= 3) {
						?>
						<tr align="center" class="list-item">
							<td class="font-weight-light" align="left">
								<?php echo $row_check['name_company']; ?>
								<p class="text-muted">
									คุณ&nbsp;<?php echo $row_check['user_domain']; ?><br/>
									ติดต่อ&nbsp;<?php echo $row_check['tel_domain'] ?>
								</p>
							</td>
							<td class="font-weight-light"><?php echo $row_check['domain']; ?></td>
							<td class="font-weight-light"><?php echo DateThai($row_check['start_date']); ?></td>
							<td class="font-weight-light"><?php echo DateThai($row_check['due_date']); ?></td>
							<td class="font-weight-light"><?php echo number_format($row_check['cost']).'.-'; ?></td>
							<td class="font-weight-light">
								<span class="badge badge-warning text-uppercase">
									เหลือ <?php  echo $row_check['status_day']; ?> วัน
								</span><br/>
								<a href="?perdoamin=<?php echo $row['id_domain'];?>" class="text-success" onclick="return confirm('ต้องการต่อโดเมนหรือมั้ย ?');"><small>ต่ออายุโดเมน</small></a>
								
							</td>
							<td >
								<button class="btn animate-up-2 mr-2 mb-2 btn-pill btn-outline-warning btn-sm edit-domain" type="button"data-toggle="modal" data-target="#modal-domain-edit" 
								data-id         = "<?php echo $row['id_domain']; ?>"
								data-company    = "<?php echo $row['name_company']; ?>"
								data-user-doamin= "<?php echo $row['user_domain']; ?>"
								data-tel-domain = "<?php echo $row['tel_domain']; ?>"
								data-domain     = "<?php echo $row['domain']; ?>"
								data-start-date = "<?php echo $row['start_date']; ?>"
								data-due-date   = "<?php echo $row['due_date']; ?>"
								data-cost       = "<?php echo $row['cost']; ?>"><i class="far fa-edit"></i></button>

								<button class="btn animate-up-2 mr-2 mb-2 btn-pill btn-outline-danger btn-sm delete" type="button"  data-delete = "<?php echo $row['id_domain']; ?>"><i class="far fa-trash-alt"></i></button>
							</td>
						</tr>
						<?php
					}  elseif($row_check['status30'] == '30') {
						?>
						<tr align="center" class="list-item ">
							<td class="font-weight-light" align="left">
								<?php echo $row_check['name_company']; ?>
								<p class="text-muted">
									คุณ&nbsp;<?php echo $row_check['user_domain']; ?><br/>
									ติดต่อ&nbsp;<?php echo $row_check['tel_domain'] ?>
								</p>
							</td>
							<td class="font-weight-light"><?php echo $row_check['domain']; ?></td>
							<td class="font-weight-light"><?php echo DateThai($row_check['start_date']); ?></td>
							<td class="font-weight-light"><?php echo DateThai($row_check['due_date']); ?></td>
							<td class="font-weight-light"><?php echo number_format($row_check['cost']).'.-'; ?></td>
							<td class="font-weight-light"><span class="badge badge-warning text-uppercase">เหลืออีก <?php  echo $row_check['status_day']; ?> วัน</span><br/>
								<a href="?perdoamin=<?php echo $row['id_domain'];?>" class="text-success" onclick="return confirm('ต้องการต่อโดเมนหรือมั้ย ?');"><small>ต่ออายุโดเมน</small></a>
							</td>
							<td >

								<button class="btn animate-up-2 mr-2 mb-2 btn-pill btn-outline-warning btn-sm edit-domain" type="button"data-toggle="modal" data-target="#modal-domain-edit" 
								data-id         = "<?php echo $row['id_domain']; ?>"
								data-company    = "<?php echo $row['name_company']; ?>"
								data-user-doamin= "<?php echo $row['user_domain']; ?>"
								data-tel-domain = "<?php echo $row['tel_domain']; ?>"
								data-domain     = "<?php echo $row['domain']; ?>"
								data-start-date = "<?php echo $row['start_date']; ?>"
								data-due-date   = "<?php echo $row['due_date']; ?>"
								data-cost       = "<?php echo $row['cost']; ?>"><i class="far fa-edit"></i></button>

								<button class="btn animate-up-2 mr-2 mb-2 btn-pill btn-outline-danger btn-sm delete" type="button"  data-delete = "<?php echo $row['id_domain']; ?>"><i class="far fa-trash-alt"></i></button>
							</td>
						</tr>
						<?php

					} elseif ($row_check['status_day'] > 3) {
						?>
						<tr align="center" class="list-item" >
							<td class="font-weight-light" align="left">
								<?php echo $row_check['name_company']; ?>
								<p class="text-muted">
									คุณ&nbsp;<?php echo $row_check['user_domain']; ?><br/>
									ติดต่อ&nbsp;<?php echo $row_check['tel_domain'] ?>
								</p>
							</td>
							<td class="font-weight-light"><?php echo $row_check['domain']; ?></td>
							<td class="font-weight-light"><?php echo DateThai($row_check['start_date']); ?></td>
							<td class="font-weight-light"><?php echo DateThai($row_check['due_date']); ?></td>
							<td class="font-weight-light"><?php echo number_format($row_check['cost']).'.-'; ?></td>
							<td class="font-weight-light"><span class="badge badge-primary text-uppercase">เหลืออีก <?php  echo $row_check['status_day']; ?> วัน</span><br/> 
								<a href="?perdoamin=<?php echo $row['id_domain'];?>" class="text-success" onclick="return confirm('ต้องการต่อโดเมนหรือมั้ย ?');"><small>ต่ออายุโดเมน</small></a>
							</td>
							<td>

								<button class="btn animate-up-2 mr-2 mb-2 btn-pill btn-outline-warning btn-sm edit-domain" type="button"data-toggle="modal" data-target="#modal-domain-edit" 
								data-id         = "<?php echo $row['id_domain']; ?>"
								data-company    = "<?php echo $row['name_company']; ?>"
								data-user-doamin= "<?php echo $row['user_domain']; ?>"
								data-tel-domain = "<?php echo $row['tel_domain']; ?>"
								data-domain     = "<?php echo $row['domain']; ?>"
								data-start-date = "<?php echo $row['start_date']; ?>"
								data-due-date   = "<?php echo $row['due_date']; ?>"
								data-cost       = "<?php echo $row['cost']; ?>"><i class="far fa-edit"></i></button>

								<button class="btn animate-up-2 mr-2 mb-2 btn-pill btn-outline-danger btn-sm delete" type="button"  data-delete = "<?php echo $row['id_domain']; ?>"><i class="far fa-trash-alt"></i></button>
							</td>
						</tr>
						<?php 
					}
				}
			}
		}  else {
			echo '<td class="font-weight-light" colspan="7" align="center">ไม่มีข้อมูล</td>';
		}

	}
	?>
</tbody>
</table>
</div>
<div id="pagination-container" class="ml-0 w-100 "></div>
<?php require_once('modal-domain-edit.php'); ?>
<?php 
$sql_perdomain = mysqli_query($conn, "SELECT id_domain,start_date,due_date,datediff(due_date,now()) as DayOld FROM domain");
while($row_perdomain = mysqli_fetch_assoc($sql_perdomain)) {

	if(isset($_GET['perdoamin']) == $row_perdomain['id_domain']) {
		$DayOld = $row_perdomain['DayOld'];
		$due_date = date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " + 1 year +".$DayOld."day"));
		$due_date0 = date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " + 1 year"));
		if($DayOld <= 0) {
			echo "UPDATE domain SET start_date = now(), due_date = '$due_date0' WHERE id_domain = '".$_GET['perdoamin']."'";
			$sql_out = mysqli_query($conn, "UPDATE domain SET start_date = now(), due_date = '$due_date0' WHERE id_domain = '".$_GET['perdoamin']."' ");
			if($sql_out) {
				echo "<script>location.href='domain.php';</script>";
			}
		} else {
			$sql_out = mysqli_query($conn, "UPDATE domain SET start_date = now(), due_date = '$due_date' WHERE id_domain = '".$_GET['perdoamin']."' ");
			if($sql_out) {
				echo "<script>location.href='domain.php';</script>";
			}
		}
	}
}

?>
<?php
function status_day($conn) {
	$sql =  "SELECT * FROM domain ";
	$result = mysqli_query($conn, $sql);
	foreach ($result as $row) {
		$sql_status = "SELECT DATEDIFF(due_date,now()) AS status_day FROM domain where id_domain = '".$row['id_domain']."'";
		$result_status = mysqli_query($conn, $sql_status);
		foreach ($result_status as $row_status) {
			$status_day = $row_status['status_day'];
		}
	}

	return $status_day;
} 
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