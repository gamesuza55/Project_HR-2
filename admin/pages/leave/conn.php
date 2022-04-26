<?php
$conn = @mysqli_connect("localhost", "root", "1234", "project");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
else {
	mysqli_set_charset($conn,"utf8");
}
?>