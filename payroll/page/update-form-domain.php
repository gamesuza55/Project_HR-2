<?php 
require_once('../controller/conn.php');

$id_domain    = $_POST['id_domain_edit'];
$name_company = $_POST['name_company_edit'];
$user_domain  = $_POST['user_domain_edit'];
$tel_domain   = $_POST['tel_company_edit'];
$domain       = $_POST['domain_edit'];
$start_date   = date('Y-m-d', strtotime($_POST['start_date_edit']));
$due_date     = date('Y-m-d', strtotime($_POST['due_date_edit']));
$cost         = $_POST['cost_edit'];

$sql = mysqli_query($conn,"UPDATE domain SET name_company = '$name_company', user_domain = '$user_domain', tel_domain = '$tel_domain', domain='$domain', start_date='$start_date', due_date='$due_date', cost='$cost' WHERE id_domain = '$id_domain'");
if($sql){
	echo 'success';

} else {
	echo 'error';
}

?>
