<?php 
session_start();
require('config.php'); 
require('controller/conn.php');
$page = "domain";

if((!$_SESSION['user'] ?? false)) {
	header('location:../index.php');
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php require('controller/head.php'); ?> 
</head>
<body>
	<?php require('view/header.php'); ?> 
	<section class="section-sm">
		<div class="container" style="max-width:1250px;">
			<div class="row mt-5 ">
				<div class="col-lg-12">
					<!-- nav tab -->
					<?php require('view/nav_menu.php');?>

					<!-- Button Modal -->
					<button type="button" class="btn float-right btn-secondary mb-3" data-toggle="modal" data-target="#modal-default"><i class="fas fa-plus"></i>&nbsp;เพิ่ม Domain</button>
					<div>
						<h2 class="text-primary"><i class="fas fa-table"></i>&nbsp;ตาราง</h2>
					</div><hr/>
					<!-- modal-domain -->
					<?php require('page/modal-domain.php'); ?>
					<!-- search -->
					<form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" name="form_search_domain">	
						<select name="search_domain" id="search_domain" class="custom-select mb-3 float-right w-25" onchange="form_search_domain.submit();">
							<option value="all" <?php if(@$_POST['search_domain'] == "all") { echo "selected"; } ?>>ข้อมูลทั้งหมด</option>
							<option value="3" <?php if(@$_POST['search_domain'] == "3" or @$_GET['id_nofi']) { echo "selected"; } ?>>เหลืออีก 3 วัน</option>
							<option value="30" <?php if(@$_POST['search_domain'] == "30" or @$_GET['id_nofi30']) { echo "selected"; } ?>>เหลืออีก 30 วัน</option>
						</select>
					</form>
					<!-- table-domain -->
	<!-- 				<input type="checkbox" name="checkbox" id="checkAll" class="form-control checked"  />
					<hr>
					<input type="checkbox" id="checkItem">Item 1
					<input type="checkbox" id="checkItem">Item 2
					<input type="checkbox" id="checkItem">Item3 -->
					<?php require('page/table-domain.php'); ?>							
				</div>
			</div>
		</div>
	</div>
</section>

<?php require('view/footer.php'); ?>

</body>
</html>
<?php require('controller/script.php'); ?> 
<script>
// $("#checkAll").click(function () {
// 	$('input:checkbox').not(this).prop('checked', this.checked);
// });
// $(".checked").click(function() {
// 	if ($(this).is(':checked')) 
// 		alert(1);
// 	else 
// 		alert(2)
// });
</script>
<script>
	$(document).ready(function() {
		/* Act on the event */
		$('html, body').animate({ scrollTop: $( '#table_domain' ).offset().top }, 'slow');
	});
</script>
<script>
	$('.delete').on('click', function(event) {
		event.preventDefault();
		/* Act on the event */
		var delete_form = $(this).attr('data-delete');
		$.confirm({
			title: 'ต้องการลบข้อมูลหรือไม่ ?',
			type: 'red',
			content: 'ข้อมูลในตารางจะหายไป <b class="text-danger">ลบข้อมูล</b> | <b class="text-warning"> ยกเลิกคำสั่ง </b>',
			autoClose: 'ยกเลิก|8000',
			buttons: {
				deleteUser: {
					text: 'ลบข้อมูล',
					btnClass: 'btn-red',
					action: function () {
						$.alert({
							title:'ลบข้อมูลเรียบร้อยแล้ว!',
							type: 'green',
							content: false,
						}),
						$.ajax({
							method: "POST",
							url: "page/delete_domain.php",
							data: { delete_form: delete_form },
							success: function(data){
								console.log(data);
								$(document).ajaxStop(function(){
									window.location.reload();
								});
							}
						});
					}
				},
				ยกเลิก: function () {
					$.alert({
						title:false,
						type: 'red',
						content:'ยกเลิกการลบข้อมูล',
						buttons: {
							OK: {
								text: 'ตกลง',
								btnClass: 'btn-red',
							}
						}
					});
				}
			}
		});
	});
</script>

<script>

	$(document).ready(function() {
		$('.edit-domain').click(function() {
			var id_domain = $(this).attr('data-id');
			var name_company = $(this).attr('data-company');
			var user_domain = $(this).attr('data-user-doamin');
			var tel_domain = $(this).attr('data-tel-domain');
			var domain = $(this).attr('data-domain');
			var start_date = $(this).attr('data-start-date');
			var due_date = $(this).attr('data-due-date');
			var cost = $(this).attr('data-cost');

			var format_start_date = new Date(start_date);
			var d = format_start_date.getDate();
			var m =  format_start_date.getMonth();
			var y = format_start_date.getFullYear();
			var monthNames = ["01", "02", "03","04", "05", "06", "07","08", "09", "10","11", "12"];
			var mountcut = monthNames[m];
			var start_date = (d + "-" + mountcut + "-" + y);

			var format_due_date = new Date(due_date);
			var d = format_due_date.getDate();
			var m =  format_due_date.getMonth();
			var y = format_due_date.getFullYear();
			var monthNames = ["01", "02", "03","04", "05", "06", "07","08", "09", "10","11", "12"];
			var mountcut = monthNames[m];
			var due_date = (d + "-" + mountcut + "-" + y);

			$('#id_domain_edit').val(id_domain);
			$('#name_company_edit').val(name_company);
			$('#user_domain_edit').val(user_domain);
			$('#tel_company_edit').val(tel_domain);
			$('#domain_edit').val(domain);
			$('#start_date_edit').val(start_date);
			$('#due_date_edit').val(due_date);
			$('#cost_edit').val(cost);

			$('#form-domain-edit').on('submit', function(e) {
				e.preventDefault();

				$.ajax({
					url: 'page/update-form-domain.php',
					type: 'POST',
					data: $('#form-domain-edit').serialize(),
					timeout:1000,
					success: function(data) {
						$('#modal-domain-edit').modal('hide');
						console.log(data);

						$(document).ajaxStop(function(){
							window.location.reload();
						});
					}
				});	
			});
		});
	});

</script>

<script>

	$('#form-domain').submit( function(e) {
		e.preventDefault();
		/* Act on the event */
		var name_company = $('#name_company').val();
		var domain = $('#domain').val();
		var cost = $('#cost').val();
		var user_domain = $('#user_domain').val();
		var tel_company = $('#tel_company').val();


		if(name_company === '' || domain === '' || cost === '' || user_domain === '' || tel_company === '') {
			if(name_company === '') {
				$('#name_company').addClass('is-invalid');	
			}
			else   {
				$('#name_company').removeClass('is-invalid');
				$('#name_company').addClass('is-valid');
			} 
			if(user_domain === '') {
				$('#user_domain').addClass('is-invalid');	
			}
			else   {
				$('#user_domain').removeClass('is-invalid');
				$('#user_domain').addClass('is-valid');
			}
			if(tel_company === '') {
				$('#tel_company').addClass('is-invalid');	
			}
			else   {
				$('#tel_company').removeClass('is-invalid');
				$('#tel_company').addClass('is-valid');
			}
			if(domain === '') {
				$('#domain').addClass('is-invalid');	
			}
			else   {
				$('#domain').removeClass('is-invalid');
				$('#domain').addClass('is-valid');
			}
			if(cost === '') {
				$('#cost').addClass('is-invalid');	
			}
			else   {
				$('#cost').removeClass('is-invalid');
				$('#cost').addClass('is-valid');
			}

		}
		else {
			$.ajax({
				url: 'page/insert-domain.php',
				type: 'POST',
				data: $('#form-domain').serialize(),
				success : function(data){
					console.log(data)
					$('#modal-default').modal('hide');
					// $.clearInput();
				// setTimeout(function(){location.reload();},3000); 3sec
				$(document).ajaxStop(function(){
					window.location.reload();
				});
			}
		})
		}
	});		

	$('#modal-default').on('hidden.bs.modal', function () {
		$('#form-domain').find('input[name="name_company"],input[name="user_domain"],input[name="tel_company"],input[name="domain"],input[name="cost"]').val('');
		$('#name_company').removeClass('is-invalid');
		$('#user_domain').removeClass('is-invalid');
		$('#tel_company').removeClass('is-invalid');
		$('#domain').removeClass('is-invalid');
		$('#cost').removeClass('is-invalid');
		$('#name_company').removeClass('is-valid');
		$('#user_domain').removeClass('is-valid');
		$('#tel_company').removeClass('is-valid');
		$('#domain').removeClass('is-valid');
		$('#cost').removeClass('is-valid');
	});
// function clearInput
	// $.clearInput = function () {
	// 	$('#form-domain')[0].reset();
	// 	$('#name_company').removeClass('is-invalid');
	// 	$('#user_domain').removeClass('is-invalid');
	// 	$('#tel_company').removeClass('is-invalid');
	// 	$('#domain').removeClass('is-invalid');
	// 	$('#cost').removeClass('is-invalid');
	// 	$('#name_company').removeClass('is-valid');
	// 	$('#user_domain').removeClass('is-valid');
	// 	$('#tel_company').removeClass('is-valid');
	// 	$('#domain').removeClass('is-valid');
	// 	$('#cost').removeClass('is-valid');
	// };
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
function validate(evt) {
	
	var theEvent = evt || window.event;

	  // Handle paste
	  if (theEvent.type === 'paste') {
	  	key = event.clipboardData.getData('text/plain');
	  } else {
	  // Handle key press
	  var key = theEvent.keyCode || theEvent.which;
	  key = String.fromCharCode(key);
	}
	var regex = /[0-9]|\./;
	if( !regex.test(key) ) {
		theEvent.returnValue = false;
		$('#alert-cost').html('**ใส่ตัวเลขครับ');
		if(theEvent.preventDefault) theEvent.preventDefault();
	} else {
		$('#alert-cost').html('');
	}
}
function validateTel(evt) {
	
	var theEvent = evt || window.event;

	  // Handle paste
	  if (theEvent.type === 'paste') {
	  	key = event.clipboardData.getData('text/plain');
	  } else {
	  // Handle key press
	  var key = theEvent.keyCode || theEvent.which;
	  key = String.fromCharCode(key);
	}
	var regex = /[0-9]|\./;
	if( !regex.test(key) ) {
		theEvent.returnValue = false;
		if(theEvent.preventDefault) theEvent.preventDefault();
	} 
}

</script>
<script>

	$('.datepicker').datepicker({
		format: "dd-mm-yyyy",
		todayHighlight: true,
		autoclose: true,
		todayBtn: "linked",
		language: 'th',
		isBuddhist: true,
	}).datepicker('setDate', new Date());
	
	$('.edit-domain').click(function() {
		var due_date = $(this).attr('data-due-date');
		$('.datepicker').datepicker({
			format: "dd-mm-yyyy",
			todayHighlight: true,
			autoclose: true,
			todayBtn: "linked",
			language: 'th',
			isBuddhist: true,
		}).datepicker('setDate', new Date());

		$('.datepicker_edit').datepicker({
			format: "dd-mm-yyyy",
			todayHighlight: true,
			autoclose: true,
			todayBtn: "linked",
			language: 'th',
			isBuddhist: true,
		}).datepicker('setDate', new Date(due_date));
	});
</script>  



