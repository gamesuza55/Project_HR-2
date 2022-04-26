<!-- Modal Content -->
<form name="form-domain" id="form-domain" >
	<div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h6 class="modal-title" id="modal-title-default">ฟอร์ม Domain</h6>
					<button type="button" class="close h1" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="nameCompany">ชื่อบริษัท</label>
								<input type="text" placeholder="ชื่อบริษัท" class="form-control" id="name_company" name="name_company" />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="userDomain">ชื่อผู้ติดต่อ</label>
								<input type="text" placeholder="ชื่อผู้ติดต่อ" class="form-control" id="user_domain" name="user_domain" />
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="telDomain">เบอร์โทรศัพท์</label>
						<input type="text" placeholder="เบอร์โทรศัพท์" onkeypress='validateTel(event)' class="form-control" id="tel_company" name="tel_company" maxlength="10"  />
					</div>
					<div class="form-group">
						<label for="Domain">Domain</label>
						<input type="text" placeholder="Domain" class="form-control" id="domain" name="domain" />
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="startDate">วันที่เริ่มจด Domain</label>
								<input type="text" class="form-control  datepicker" readonly  placeholder="วัน/เดือน/ปี">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="startDate">วันที่สิ้นสุด Domain</label>
								<input type="text" class="form-control  datepicker" name="due_date" readonly placeholder="วัน/เดือน/ปี">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="Cost">ราคา</label>
						<input type="text" placeholder="ราคา" class="form-control" id="cost" name="cost" onkeypress='validate(event)' />
						<div id="alert-cost" class="text-danger"></div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" name="submit-domain" class="btn btn-sm btn-secondary ml-auto">ตกลง</button>
					<button type="button" class="btn btn-sm  btn-danger" data-dismiss="modal">ยกเลิก</button>
				</div>
			</div>
		</div>
	</div>
</form>

<!-- End of Modal Content -->