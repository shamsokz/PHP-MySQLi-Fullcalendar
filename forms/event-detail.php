<?php
require_once('../db.php'); // database connection
$event_id = $_GET['event'];
$sql = "SELECT `event_id`, `event_title`, `event_desc`, `start_date` FROM `tbl_events` WHERE `event_id` = '$event_id' LIMIT 1";
$res = $conn->query($sql);
$row = $res->fetch_array();
$event_id = $row['event_id'];
$event_title = $row['event_title'];
$event_desc = $row['event_desc'];
$start_date = strtotime($row['start_date']);
$start_date = date("d M, Y h:i a", $start_date);
?>
  <div>
    <h3>Event Details</h3>
    <p>Event Title : <?php echo $event_title; ?></p>
    <p>Description : <?php echo $event_desc; ?></p>
    <p>Event Date : <?php echo $start_date; ?></p>
    <a href="forms/event.php?form=edit_event&event_id=<?php echo $event_id; ?>" class="event_form">Edit Event</a>
  </div>
  <script type='text/javascript'>
  $(document).ready(function () {
  	$(".event_form").colorbox({width: "40%"});
  });
  </script>
