<!-- Modal Content -->
<form name="form-domain-edit" id="form-domain-edit" >
	<div class="modal fade" id="modal-domain-edit" tabindex="-1" role="dialog" aria-labelledby="modal-domain-edit" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h6 class="modal-title" id="modal-title-default">ฟอร์ม Domain</h6>
					<button type="button" class="close h1" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="id_domain_edit" name="id_domain_edit">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="nameCompany">ชื่อบริษัท</label>
								<input type="text" placeholder="ชื่อบริษัท" class="form-control" id="name_company_edit" name="name_company_edit" />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="userDomain">ชื่อผู้ติดต่อ</label>
								<input type="text" placeholder="ชื่อผู้ติดต่อ" class="form-control" id="user_domain_edit" name="user_domain_edit" />
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="telDomain">เบอร์โทรศัพท์</label>
						<input type="text" placeholder="เบอร์โทรศัพท์" onkeypress='validateTel(event)' class="form-control" id="tel_company_edit" name="tel_company_edit" maxlength="10"  />
					</div>
					
					<div class="form-group">
						<label for="Domain">Domain</label>
						<input type="text" placeholder="Domain" class="form-control" id="domain_edit" name="domain_edit" />
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="startDate">วันที่เริ่มจด Domain</label>
								<input type="text" class="form-control  datepicker_edit" id="start_date_edit" name="start_date_edit" readonly  placeholder="วัน/เดือน/ปี">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="startDate">วันที่สิ้นสุด Domain</label>
								<input type="text" class="form-control  datepicker_edit" name="due_date_edit" id="due_date_edit" name="due_date_edit" readonly placeholder="วัน/เดือน/ปี">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="Cost">ราคา</label>
						<input type="text" placeholder="ราคา" class="form-control" id="cost_edit" name="cost_edit" onkeypress='validate(event)' />
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