<?php 
session_start();
require('config.php'); 
require('controller/conn.php');
$page = "revenue_expenditure";

if(!$_SESSION['user']) {
	header('location:../index.php');
	exit;
}


function staff_name($conn) {
	$output = 'กรุณาเลือกข้อมูล';
	$sql = "SELECT fistname FROM member where status = 'user'";
	$result = mysqli_query($conn, $sql);
	foreach ($result as $row) 
	{
		$output .= '<option value="'.$row['fistname'].'">'.$row['fistname'].'</option>';
	}
	return $output;
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
					<!-- form_revenue_expenditure -->
					<?php include('page/form_revenue_expenditure.php'); ?>
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
	// $('#panal-revenue').click(function(){
	// 	$('#revenue_payroll').toggle(1000);
	// });
	// $('#panal-expenditure').click(function(){
	// 	$('#expenditure_payroll').toggle(1000);
	// });
	$(document).ready(function(){  
		var i=1;
		var date_revenue = "<?php echo date('Y-m-d'); ?>";
		var date_expenditure = "<?php echo date('Y-m-d'); ?>";

		$('#add_revenue').click(function(){  

			i++;  
			$('#revenue_payroll').append($('<tbody><tr class="row'+i+'" align="center">\
				<td><input type="text" name="detail_revenue[]" placeholder="กรอกรายละเอียด..." class="form-control name_list" /></td>\
				<td><input type="text" name="revenue[]"  placeholder="รายได้บริษัท..." class="form-control name_list comma"  onkeypress="validate(event)"/>\
				<small class="text-muted">(ใส่ตัวเลขครับ)</small>\
				</td>\
				<td><input type="date" name="date_revenue[]" class="form-control name_list"  value="'+date_revenue +'" /></td>\
				<td>\
				<select name="staff_revenue[]" class="custom-select">\
				<option disabled selected><?php echo staff_name($conn); ?></option>\
				</select>\
				</td>\
				<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td>\
				</tr></tbody>').hide().fadeIn('normal'));  
		}); 
		$('#add-expenditure').click(function(){  
			i++;  
			$('#expenditure_payroll').append($('<tr class="row'+i+'" align="center">\
				<td><input type="text" name="detail_expenditure[]" placeholder="กรอกรายละเอียด..." class="form-control name_list" /></td>\
				<td><input type="text" name="expenditure[]"  placeholder="รายจ่ายบริษัท..." class="form-control name_list comma" onkeypress="validate(event)" /></td>\
				<td><input type="date" name="date_expenditure[]" class="form-control name_list"  value="'+date_revenue +'" /></td>\
				<td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td>\
				</tr>').hide().fadeIn('normal'));  
		}); 
		$(document).on('click', '.btn_remove', function(){  
			var button_id = $(this).attr("id"); 
			$('.row'+button_id+'').fadeOut(250, function() {  
				$('.row'+button_id+'').remove();
			});
		});



		$('#submit_payroll').click(function(e){ 
			e.preventDefault();

			var detail_revenue = [];
			var tbody_re = $("#revenue_payroll tbody");
			var tbody_ex = $("#expenditure_payroll tbody");
			if(tbody_re.children().length == 0 && tbody_ex.children().length == 0) {
				alert('กรุณาเพิ่มข้อมูล');
				return true;
			} 
			else {
				$("input[name='detail_revenue[]']").each(function() {
					var value = $(this).val();
					if (value === '') {
						$(this).addClass('is-invalid');
						detail_revenue.push(value);
					} else {
						$(this).removeClass('is-invalid');
					}	

				});

				var revenue = [];
				$("input[name='revenue[]']").each(function() {
					var value = $(this).val();
					if (value === '') {
						$(this).addClass('is-invalid');

						revenue.push(value);
					} else {
						$(this).removeClass('is-invalid');
					}
				});

				var staff_revenue = []; 
				$('select[name="staff_revenue[]"]').each(function() {
					var value = $(this).val();
					if(!value) { 
						$(this).addClass('is-invalid');
						staff_revenue.push(value);
					} else {
						$(this).removeClass('is-invalid');
					}
				});

				var detail_expenditure = [];
				$("input[name='detail_expenditure[]']").each(function() {
					var value = $(this).val();
					if (value === '') {
						$(this).addClass('is-invalid');
						detail_expenditure.push(value);
					} else {
						$(this).removeClass('is-invalid');
					}	

				});

				var expenditure = [];
				$("input[name='expenditure[]']").each(function() {
					var value = $(this).val();
					if (value === '') {
						$(this).addClass('is-invalid');
						expenditure.push(value);
					} else {
						$(this).removeClass('is-invalid');
					}	

				});

				if (detail_revenue.length !== 0) {
					return false;
				} 
				if(revenue.length !== 0){
					return false;
				}
				if(staff_revenue.length !== 0){
					return false;
				}
				if(detail_expenditure.length !== 0){
					return false;
				}
				if(expenditure.length !== 0){
					return false;
				}
				else {

					$.ajax({  
						url:"page/insert_payroll.php",  
						method:"POST",  
						data:$('#add_payroll').serialize(),  
						success:function(data)  {  
							console.log(data);
							$.alert({
								title: false,
								content: '<h4>เพิ่มข้อมูลสำเร็จ</h4>',
								type: 'green',
								buttons: {
									OK: {
										text: 'ตกลง',
										btnClass: 'btn-green',
									}
								}
							});setTimeout(function(){location.href="index.php"} , 1000);   
							$('#add_payroll')[0].reset();  
						}  
					}); 
				}
			}
		});

	});  
</script>

<script>
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
		$('.alert-cost').html('**ใส่ตัวเลขครับ');
		if(theEvent.preventDefault) theEvent.preventDefault();
	} else {
		$('.alert-cost').html('');
	}
}

</script>
<script>
	$(document).on('click', '#revenue_payroll', function() {

		$('input.comma').keyup(function() {
			$('input.comma').val(function(index, value) {
				return value
				.replace(/\D/g, '')
				.replace(/\B(?=(\d{3})+(?!\d))/g, ",")
				;
			});
		});
	});
	$(document).on('click', '#expenditure_payroll', function() {

		$('input.comma').keyup(function() {
			$('input.comma').val(function(index, value) {
				return value
				.replace(/\D/g, '')
				.replace(/\B(?=(\d{3})+(?!\d))/g, ",")
				;
			});
		});
	});

</script>

