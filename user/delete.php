
<?php 

require_once('conn_main.php');

$ID_leave   = $_POST['ID_leave'];
$image_name = $_POST['image_name'];
$sql = "DELETE FROM sick_leave WHERE ID_leave = '$ID_leave'";

if(mysqli_query($conn, $sql)){
	@unlink("../images/".$image_name);
}

mysqli_close($conn);
?>