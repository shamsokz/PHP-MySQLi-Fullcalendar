<?php
require_once('db.php'); // database connection
if (isset($_POST['Event'][0]) && isset($_POST['Event'][1])){
	$event_id = $_POST['Event'][0];
	$start_date = $_POST['Event'][1];
	$sql = "UPDATE `tbl_events` SET `start_date` = '$start_date' WHERE `event_id` = $event_id ";
	$res = $conn->query($sql);
	if ($res) {
			die ('OK');
	} else {
			die ('Error');
	}
}
?>
