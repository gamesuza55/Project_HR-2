<?php
if($_POST['on']) {
	echo 'ORDER BY due_date ASC';
} elseif($_POST['off']) {
	echo 'ORDER BY due_date DESC';
}
?>