 <?php

require_once('conn_main.php');

$type_sick 	  = $_POST['type_sick'];
$start_sick   = date('Y-m-d');
$end_sick 	  = date('Y-m-d', strtotime($_POST['end_sick']));
$detail_sick  = $_POST['detail_sick'];
$full_day 	  = $_POST['counts'];
$sick 		  = $_POST['sicks'];
$fistname	  = $_POST['fistname'];
$status		  = $_POST['status'];

$target_dir 	= 	"../images/";
$target_file 	= 	$target_dir . basename($_FILES["fileToUpload"]["name"]);
$imageFileType  = 	round(microtime(true)) . '.' .strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check file size 512KB
if ($_FILES["fileToUpload"]["size"] > 512000) {
	$KB = round(($_FILES["fileToUpload"]["size"] / 1024), 2);
    echo "Sorry, ตรวจดูขนาดของไฟล์อีกครั้ง <br/>";
    echo "ขนาดไฟล์ของคุณ ".$KB." KB";
    header("Refresh:2;url=index.php");
    return false;
}
//ไฟล์ตรวจสอบนามสกุลไฟล์แต่ยังมีปัญหา
// else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
// && $imageFileType != "gif") {
//     echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
// 	return false;
// }
else{

	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir.$imageFileType)) {

		$image_name = $imageFileType;

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

				$sql = "INSERT INTO sick_leave (ID_leave, fistname, sick, type_sick, dates, date_range, day_num, image_name, detail_sick, status)
				VALUES ('', '$fistname', '$sick', '".$type_sick[$i]."', '$start_sick', '$end_sick', '$full_day', '$image_name', '$detail_sick', '$status')";

				if (mysqli_query($conn, $sql)) {

				  	header('location:index.php');
				    return true;
				} else {
				    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				    return false;
				}
			}	
}
   



/* อันเก่า
if($type_sick == "0.5MN") {
	$type_sicks = "ลาครึ่งวัน-เช้า";

	$sql = "INSERT INTO sick_leave (ID_leave, type_sick, dates, date_range, day_num, image_file, detail_sick)
	VALUES ('', '$type_sicks', '$start_sick', '$end_sick', '$day_num', '', '$detail_sick')";

	if (mysqli_query($conn, $sql)) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	exit;
}
if($type_sick == "0.5AF") {
	$type_sicks = "ลาครึ่งวัน-บ่าย";

	$sql = "INSERT INTO sick_leave (ID_leave, type_sick, dates, date_range, day_num, image_file, detail_sick)
	VALUES ('', '$type_sicks', '$start_sick', '$end_sick', '$day_num', '', '$detail_sick')";

	if (mysqli_query($conn, $sql)) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	exit;
}
*/



?>