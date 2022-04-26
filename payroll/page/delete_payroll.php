<?php
include('../controller/conn.php');

$id_del = $_GET['del'];
if(isset($_GET['del'])){

	$sql = "DELETE r,e,o FROM revenue_payroll r INNER JOIN order_payroll o ON r.id_order = o.id_order INNER JOIN expenditure_payroll e ON o.id_order = e.id_order  WHERE o.id_order = '$id_del'";

	if (mysqli_query($conn, $sql)) {

		$reset_increment_revenue = "ALTER TABLE revenue_payroll AUTO_INCREMENT = 1";
		mysqli_query($conn, $reset_increment_revenue);
		$reset_increment_expenditure = "ALTER TABLE expenditure_payroll AUTO_INCREMENT = 1";
		mysqli_query($conn, $reset_increment_expenditure);
		$reset_increment_order = "ALTER TABLE order_payroll AUTO_INCREMENT = 1";
		mysqli_query($conn, $reset_increment_order);

		echo '<script>window.close();window.opener.location.reload();</script>';
	}
	$sql = "DELETE r,o FROM revenue_payroll r INNER JOIN order_payroll o ON r.id_order = o.id_order  WHERE o.id_order = '$id_del'";

	if (mysqli_query($conn, $sql)) {

		$reset_increment_revenue = "ALTER TABLE revenue_payroll AUTO_INCREMENT = 1";
		mysqli_query($conn, $reset_increment_revenue);
		$reset_increment_expenditure = "ALTER TABLE expenditure_payroll AUTO_INCREMENT = 1";
		mysqli_query($conn, $reset_increment_expenditure);
		$reset_increment_order = "ALTER TABLE order_payroll AUTO_INCREMENT = 1";
		mysqli_query($conn, $reset_increment_order);

		echo '<script>window.close();window.opener.location.reload();</script>';
	} 
	$sql = "DELETE e,o FROM expenditure_payroll e INNER JOIN order_payroll o ON o.id_order = e.id_order  WHERE o.id_order = '$id_del'";

	if (mysqli_query($conn, $sql)) {

		$reset_increment_revenue = "ALTER TABLE revenue_payroll AUTO_INCREMENT = 1";
		mysqli_query($conn, $reset_increment_revenue);
		$reset_increment_expenditure = "ALTER TABLE expenditure_payroll AUTO_INCREMENT = 1";
		mysqli_query($conn, $reset_increment_expenditure);
		$reset_increment_order = "ALTER TABLE order_payroll AUTO_INCREMENT = 1";
		mysqli_query($conn, $reset_increment_order);

		echo '<script>window.close();window.opener.location.reload();</script>';
	}
} 
elseif(isset($_GET['list-revenue']) && isset($_GET['turn'])) {

	$sql = "DELETE FROM revenue_payroll WHERE id_revenue = '".$_GET['list-revenue']."'";
	if (mysqli_query($conn, $sql)) {

		$reset_increment_revenue = "ALTER TABLE revenue_payroll AUTO_INCREMENT = 1";
		mysqli_query($conn, $reset_increment_revenue);

		header('location:payroll_table.php?id='.$_GET['turn'].'');
		
	}
} 
elseif(isset($_GET['list-expenditure']) && isset($_GET['turn'])) {
	
	$sql = "DELETE FROM expenditure_payroll WHERE id_expenditure = '".$_GET['list-expenditure']."'";
	if (mysqli_query($conn, $sql)) {

		$reset_increment_expenditure = "ALTER TABLE expenditure_payroll AUTO_INCREMENT = 1";
		mysqli_query($conn, $reset_increment_expenditure);

		header('location:payroll_table.php?id='.$_GET['turn'].'');
		
	}
}
elseif(isset($_GET['list-revenue'])) {

	$sql = "DELETE FROM revenue_payroll WHERE id_revenue = '".$_GET['list-revenue']."'";
	if (mysqli_query($conn, $sql)) {

		$reset_increment_revenue = "ALTER TABLE revenue_payroll AUTO_INCREMENT = 1";
		mysqli_query($conn, $reset_increment_revenue);

		header('location:report_payroll.php');
		
	}
} 
elseif(isset($_GET['list-expenditure'])) {
	
	$sql = "DELETE FROM expenditure_payroll WHERE id_expenditure = '".$_GET['list-expenditure']."'";
	if (mysqli_query($conn, $sql)) {

		$reset_increment_expenditure = "ALTER TABLE expenditure_payroll AUTO_INCREMENT = 1";
		mysqli_query($conn, $reset_increment_expenditure);

		header('location:report_payroll.php');
		
	}
}
?>
