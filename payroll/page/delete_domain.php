<?php 
require_once('../controller/conn.php');

$sql = mysqli_query($conn, "DELETE FROM domain WHERE id_domain = '".$_POST['delete_form']."'");

mysqli_close($conn);
?>