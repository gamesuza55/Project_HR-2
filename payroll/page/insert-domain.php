<?php
require_once('../controller/conn.php');

$name_company = $_POST['name_company'];
$user_domain  = $_POST['user_domain'];
$tel_domain   = $_POST['tel_company'];
$domain       = $_POST['domain'];
$due_date     = date('Y-m-d', strtotime($_POST['due_date']));
$cost         = $_POST['cost'];

echo $sql = "INSERT INTO domain (id_domain, name_company, user_domain, tel_domain, domain, start_date, due_date, cost) 
VALUES('','$name_company','$user_domain','$tel_domain','$domain',NOW(),'$due_date','$cost')";
if(mysqli_query($conn, $sql)){
	echo "success";
} else {
	echo "error";
}
?>