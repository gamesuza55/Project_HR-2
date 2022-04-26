
<table id="example" class="table table-striped list-wrapper" style="width:100%">
	<thead class="thead-inverse">
		<tr align="center">	
			<th scope="col" class="h4 py-4 ">ครั้งที่</th>
			<th scope="col" class="h4 py-4">วันที่</th>
			<th scope="col" class="h4 py-4">ดูรายระเอียด</th>
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
				$sql = "SELECT *  FROM order_payroll ORDER BY id_order DESC";
			} 
		} else {
			$sql = "SELECT *  FROM order_payroll ";
		}
		$result = mysqli_query($conn, $sql);

		$id_order = 1;
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)) {
				?>
				<tr class="list-item">

					<td align="center"><?php echo $id_order; ?></td>
					<td align="center"><?php echo DateThai($row['date_order']); ?></td>
					<td align="center"><a href="page/payroll_table.php?id=<?php echo $row['id_order'];?>" onclick="window.open(this.href, 'mywin','right=50,top=50,width=800,height=800,toolbar=no,resizable=0'); return false;" class="btn btn-sm animate-up-2 mr-2 mb-2 btn-pill btn-outline-primary">รายละเอียด</a></td> 

				</tr>
				<?php 
			$id_order++; }
		} else {
			echo "<tr align='center'><td colspan='5'>ไม่มีข้อมูล</td></tr>";
		}

		?>
	</tbody>
	<tfoot class="thead-inverse">
		<tr align="center">
			<td colspan="2" class="h5">รวมรายรับ-รายจ่าย บริษัท</td>

			<td><a href="page/report_payroll.php" class="btn btn-danger" onclick="window.open(this.href, 'mywin','right=50,top=50,width=800,height=800,toolbar=no,resizable=0'); return false;">ยอดรายการรวม</a></td>
		</tr>
	</tfoot>

</table>

<div id="pagination-container"></div>
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
