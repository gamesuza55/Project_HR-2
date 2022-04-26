<?php
	include('../controller/conn.php');
// for ($i=0; $i <count($_POST['name_revenue']) ; $i++) { 
// 	echo $_POST['name_revenue'][$i];
// }
	$reset_increment_revenue = "ALTER TABLE revenue_payroll AUTO_INCREMENT = 1";
	mysqli_query($conn, $reset_increment_revenue);
	$reset_increment_expenditure = "ALTER TABLE expenditure_payroll AUTO_INCREMENT = 1";
	mysqli_query($conn, $reset_increment_expenditure);
	$reset_increment_order = "ALTER TABLE order_payroll AUTO_INCREMENT = 1";
	mysqli_query($conn, $reset_increment_order);

	$id_order = "";
	$sql = mysqli_query($conn, "INSERT INTO order_payroll (id_order,date_order) VALUES ('',now())");
	$id_order = mysqli_insert_id($conn);

	for ($i=0; $i <count($_POST['detail_revenue']) ; $i++) { 

		$staff_revenue  = $_POST['staff_revenue'][$i];
		$detail_revenue = $_POST['detail_revenue'][$i];
		$revenue        = $_POST['revenue'][$i];
		$date_revenue   = $_POST['date_revenue'][$i];

	// if($detail_revenue != "" && $revenue != "") {
		//รายจ่าย
		$sql = mysqli_query($conn, "INSERT INTO revenue_payroll (id_revenue,detail_revenue, revenue, fistname, date_revenue, id_order) VALUES('', '$detail_revenue ', '$revenue', '$staff_revenue', '$date_revenue', '$id_order')");
		if($sql) {

			echo "เพิ่มข้อมูลเรียบร้อยแล้ว รายรับ";
		}
		else {
			echo "ข้อมูลไม่ถูกต้อง";

		}

	}
	for ($i=0; $i <count($_POST['detail_expenditure']) ; $i++) { 

		$detail_expenditure = $_POST['detail_expenditure'][$i];
		$expenditure        = $_POST['expenditure'][$i];
		$date_expenditure   = $_POST['date_expenditure'][$i];

	// if($detail_revenue != "" && $revenue != "") {
		//รายจ่าย
		$sql = mysqli_query($conn, "INSERT INTO expenditure_payroll (id_expenditure, detail_expenditure, expenditure, date_expenditure, id_order ) VALUES('', '$detail_expenditure',  '$expenditure', '$date_expenditure','$id_order')");
		if($sql) {
			echo "เพิ่มข้อมูลเรียบร้อยแล้ว รายจ่าย";
			
		}
		else {
			echo "ข้อมูลไม่ถูกต้อง";
		}
	// }
	}




// 2 ตาราง
// $id_order = "";
// $sql = mysqli_query($conn, "INSERT INTO order_payroll (id_order,date_order) VALUES ('',now())");
// $id_order = mysqli_insert_id($conn);

// for ($i=0; $i <count($_POST['detail_revenue']) ; $i++) { 

// 	 $staff_revenue  = $_POST['staff_revenue'][$i];
// 	 $detail_revenue = $_POST['detail_revenue'][$i];
// 	 $revenue        = $_POST['revenue'][$i];
// 	 $date_revenue   = $_POST['date_revenue'][$i];

// 	// if($detail_revenue != "" && $revenue != "") {
// 		//รายจ่าย
// 	$sql = mysqli_query($conn, "INSERT INTO payroll (id_payroll,type,detail_payroll, payroll, fistname, date_payroll, id_order) VALUES('','1', '$detail_revenue ', '$revenue', '$staff_revenue', '$date_revenue', '$id_order')");
// 	if($sql) {
// 		echo "เพิ่มข้อมูลเรียบร้อยแล้ว รายรับ";

// 	}
// 	else {
// 		echo "ข้อมูลไม่ถูกต้อง";

// 	}
	
// }
// for ($i=0; $i <count($_POST['detail_expenditure']) ; $i++) { 

// 	$detail_expenditure = $_POST['detail_expenditure'][$i];
// 	$expenditure        = $_POST['expenditure'][$i];
// 	$date_expenditure   = $_POST['date_expenditure'][$i];

// 	// if($detail_revenue != "" && $revenue != "") {
// 		//รายจ่าย
// 	$sql = mysqli_query($conn, "INSERT INTO payroll (id_payroll,type,detail_payroll, payroll, fistname, date_payroll, id_order) VALUES('','2', '$detail_expenditure ', '$expenditure', '$staff_expenditure', '$date_expenditure', '$id_order')");
// 	if($sql) {
// 		echo "เพิ่มข้อมูลเรียบร้อยแล้ว รายจ่าย";
// 	}
// 	else {
// 		echo "ข้อมูลไม่ถูกต้อง";
// 	}
// 	// }
// }



	mysqli_close($conn);

	?>