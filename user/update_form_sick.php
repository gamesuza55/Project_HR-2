<?php
require_once('conn_main.php');

$counts 	  = $_POST['counts'];
$type_sick 	  = $_POST['type_sick'];
$start_sick   = date('Y-m-d',strtotime($_POST['start_sick']));
$end_sick     = date('Y-m-d',strtotime($_POST['end_sick']));
$detail_sick  = $_POST['detail_sick'];
$image_upload = $_POST['image_upload'];
$ID_leave	  = $_POST['ID_leave'];

$target_dir 	= 	"../images/";
$target_file 	= 	$target_dir . basename($_FILES["fileToUpload"]["name"]);
$imageFileType  = 	round(microtime(true)) . '.' .strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


// Check file size 512KB
if ($_FILES["fileToUpload"]["size"] > 512000) {
	$KB = round(($_FILES["fileToUpload"]["size"] / 1024), 2);
    echo "Sorry, ตรวจดูขนาดของไฟล์อีกครั้ง <br/>";
    echo "ขนาดไฟล์ของคุณ ".$KB." KB";
    return false;
}
//ไฟล์ตรวจสอบนามสกุลไฟล์แต่ยังมีปัญหา
// else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
// && $imageFileType != "gif") {
//     echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
// 	return false;
// }
else{
	if($_FILES["fileToUpload"]["name"] != "")
	{
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir.$imageFileType)) {

			$image_name = $imageFileType;
			@unlink("../images/".$image_upload);

		} 
		        for ($i=0; $i <count($type_sick) ; $i++) { 

					if ($type_sick[$i] == 'ลาเต็มวัน') {
						$type_sick[$i] = 'ลาเต็มวัน';
					}
					if ($type_sick[$i] == 'ลาครึ่งวัน-เช้า') {
						$type_sick[$i] = 'ลาครึ่งวัน-เช้า';
					}
					if ($type_sick[$i] == 'ลาครึ่งวัน-บ่าย') {
						$type_sick[$i] = 'ลาครึ่งวัน-บ่าย';
					}

					$sql = "UPDATE sick_leave SET day_num = '$counts', type_sick = '".$type_sick[$i]."', dates = '$start_sick'
					, date_range = '$end_sick', detail_sick = '$detail_sick', image_name = '$image_name' 
					WHERE ID_leave = '$ID_leave'";

					if (mysqli_query($conn, $sql)) {
					  	header('location:index.php?status=succuss');
					  	return true;

					} else {
					    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
					    return false;
					}
				}	

	} else {

				for ($i=0; $i <count($type_sick) ; $i++) { 

					if ($type_sick[$i] == 'ลาเต็มวัน') {
						$type_sick[$i] = 'ลาเต็มวัน';
					}
					if ($type_sick[$i] == 'ลาครึ่งวัน-เช้า') {
						$type_sick[$i] = 'ลาครึ่งวัน-เช้า';
					}
					if ($type_sick[$i] == 'ลาครึ่งวัน-บ่าย') {
						$type_sick[$i] = 'ลาครึ่งวัน-บ่าย';
					}

					$sql = "UPDATE sick_leave SET day_num = '$counts', type_sick = '".$type_sick[$i]."', dates = '$start_sick'
					, date_range = '$end_sick', detail_sick = '$detail_sick', image_name = '$image_upload' 
					WHERE ID_leave = '$ID_leave'";

					if (mysqli_query($conn, $sql)) {
					  	header('location:index.php');
					    return true;
					} else {
					    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
					    return false;
					}
				}
	}
}


?>