
<form name="add_payroll" class="add_payroll" id="add_payroll">
	<div class="form-group">  
		<span class="h3 text-success">รายรับ</span> <i class="fas fa-hand-holding-usd text-success h3"></i>
		<button type="button" name="add_revenue" id="add_revenue" class="btn btn-success float-right mb-2">เพิ่มรายรับ</button>
		<div class="table-responsive">
			<table class="table table-striped w-100" id="revenue_payroll"> 	
				<thead>	
					<tr align="center">
						<th>รายละเอียดรายรับ</th>
						<th>รายรับ</th>
						<th>วันที่</th>
						<th>ชื่อพนักงาน</th>
						<th></th>
					</tr> 
				</thead>
				<tbody></tbody>
			</table>
		</div>
		<hr/>
	</div>
	<div class="form-group">  
		<span class="h3 text-danger">รายจ่าย</span><i class="fas fa-hand-holding-usd text-danger h3"></i>
		<a href="javascript:void(0)" id="add-expenditure" class="btn btn-success float-right mb-2">เพิ่มรายจ่าย</a>
		<div class="table-responsive">
			<table class="table table-striped" id="expenditure_payroll"> 
				<thead>
					<tr align="center">
						<th>รายละเอียดรายรับ</th>
						<th>รายจ่าย</th>
						<th>วันที่</th>
						<th></th>
					</tr>
				</thead>
				<tbody></tbody>
				<!-- <tr align="center">  
					<td><input type="text" name="detail_expenditure[]" placeholder="กรอกรายละเอียด..." class="form-control name_list" /></td> 
					<td>
						<input type="text" name="expenditure[]"  placeholder="รายจ่ายบริษัท..." class="form-control name_list comma" onkeypress="validate(event)" />
						<small class="text-muted">(ใส่ตัวเลขครับ)</small>
					</td> 
					<td><input type="date" name="date_expenditure[]"  class="form-control name_list"  value="<?php echo date('Y-m-d'); ?>" /></td>

					<td><button type="button" name="add_expenditure" id="add_expenditure" class="btn btn-success">เพิ่มข้อมูล</button></td>  
				</tr>   -->
			</table> 
		</div>
	</div>
	<hr/>
	<input type="button" name="submit" id="submit_payroll" class="btn btn-info" value="ตกลง"  />
</form>
