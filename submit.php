<?php
require_once('db.php'); // database connection
// Add Event
if (isset($_REQUEST["action"]))
    if ($_REQUEST["action"] == "add_event") {
        if (isset($_POST['submit']) == 1) {
            $event_title = $conn->real_escape_string(trim($_POST["event_title"]));
            $event_desc = $conn->real_escape_string($_POST["event_desc"]);
            //$event_color = $conn->real_escape_string($_POST["event_color"]);
            $start_date = $conn->real_escape_string($_POST["start_date"]);
            //$end_date = $conn->real_escape_string($_POST["end_date"]);
            //$event_location = $conn->real_escape_string($_POST["event_location"]);
            $creation_date = date('Y-m-d H:i:s');
            $sql = "INSERT INTO `tbl_events` (`event_title`, `event_desc`, `start_date`, `creation_date`)
	VALUES ('$event_title', '$event_desc', '$start_date', '$creation_date')";
            $res = $conn->query($sql);
            if ($res) {
                echo 'success';
            } else {
                echo 'failed';
            }
        }
    }
    // Edit Event
    if (isset($_REQUEST["action"]))
        if ($_REQUEST["action"] == "edit_event") {
            if (isset($_POST['update']) == 1) {
                $event_id = $_POST['event_id'];
                $event_title = $conn->real_escape_string(trim($_POST["event_title"]));
                $event_desc = $conn->real_escape_string($_POST["event_desc"]);
                //$event_color = $conn->real_escape_string($_POST["event_color"]);
                $start_date = $conn->real_escape_string($_POST["start_date"]);
                //$end_date = $conn->real_escape_string($_POST["end_date"]);
                //$event_location = $conn->real_escape_string($_POST["event_location"]);
                    $sql = "UPDATE `tbl_events` SET
    	 `event_title` = '$event_title',
    	 `event_desc` = '$event_desc',
    	 `start_date` = '$start_date'
    	 WHERE `event_id` = '$event_id'";
                $res = $conn->query($sql);
                if ($res) {
                    echo 'success';
                } else {
                    echo 'failed';
                }
            }
        }
?>
