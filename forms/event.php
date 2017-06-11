<?php
require_once('../db.php'); // database connection
// event date
if(isset($_GET['date'])) {
  $start_date = substr($_GET['date'], 0, 10);
  $start_date = date("Y-m-d", $start_date);
}
// add event form starts here
if (isset($_REQUEST["form"]))
    if ($_REQUEST["form"] == "add_event") {
?>
  <div>
    <h3>Add Event</h3>
    <form action="" method="post" enctype="multipart/form-data" id="add_event">
      <div id='submit_success' class='success'>Event has been added successfully.</div>
      <div id='submit_fail' class='error'>Error occured, please try again later.</div>
    <div id='event_title_error' class='error'>Please enter event title.</div>
    <input type="text" name="event_title" id="event_title" placeholder="Event Title">
    <textarea name="event_desc" id="event_desc" placeholder="Event Description" rows="7"></textarea>
    <!--
    I used simple textfield for event date (start_date) but you should use any calendar on this field so
    users can select date/time. Also you can add other fields i.e event_color, end_date & location etc.
   -->
    <input type="text" name="start_date" id="start_date" placeholder="Event Date" value="<?php echo $start_date; ?>" readonly>
    <input type="hidden" name="submit" value="1">
    <input type="button" name="button" value="Submit" id="submit_data">
    </form>
  </div>
<script type='text/javascript'>
jQuery.noConflict();
jQuery(document).ready(function(){
jQuery('#submit_data').click(function(e){
	e.preventDefault();
	var error = false;
	var event_title = jQuery('#event_title').val();
		  event_title = jQuery.trim(event_title);
	if(event_title.length == 0){
		var error = true;
		jQuery('#event_title_error').fadeIn(500);
	}else{
		jQuery('#event_title_error').fadeOut(500);
	}
	if(error == false){
		$.post("submit.php?action=add_event", $("#add_event").serialize(),function(result){
			if(result == 'success') {
        $("#submit_success").show().delay(5000).queue(function (n) {
          $(this).hide();
          n();
        });
        $('#add_event').each(function () {
          this.reset();
        });
        $(document).bind('cbox_closed', function(){
          location.reload();
        });
			} else {
				$('#submit_fail').fadeIn(500);
				$('#submit_data').removeAttr('disabled').attr('value', 'Submit');
			}
		});
	}
});
});
</script>
<?php
} // add event form end here
// edit event form starts here
if (isset($_REQUEST["form"]))
    if ($_REQUEST["form"] == "edit_event") {
      $event_id = $_GET['event_id'];
      $sql = "SELECT `event_id`, `event_title`, `event_desc`, `start_date` FROM `tbl_events` WHERE `event_id` = '$event_id' LIMIT 1";
      $res = $conn->query($sql);
      $row = $res->fetch_array();
      $event_id = $row['event_id'];
      $event_title = $row['event_title'];
      $event_desc = $row['event_desc'];
      $start_date = $row['start_date'];
?>
<div>
  <h3>Edit Event</h3>
  <form action="" method="post" enctype="multipart/form-data" id="add_event">
    <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
    <div id='submit_success' class='success'>Event has been updated successfully.</div>
    <div id='submit_fail' class='error'>Error occured, please try again later.</div>
  <div id='event_title_error' class='error'>Please enter event title.</div>
  <input type="text" name="event_title" id="event_title" placeholder="Event Title" value="<?php echo $event_title; ?>">
  <textarea name="event_desc" id="event_desc" placeholder="Event Description" rows="7"><?php echo $event_desc; ?></textarea>
  <!--
  I used simple textfield for event date (start_date) but you should use any calendar on this field so
  users can select date/time. Also you can add other fields i.e event_color, end_date & location etc.
 -->
  <input type="text" name="start_date" id="start_date" placeholder="Event Date" value="<?php echo $start_date; ?>" readonly>
  <input type="hidden" name="update" value="1">
  <input type="button" name="button" value="Update" id="submit_data">
  </form>
</div>
<script type='text/javascript'>
jQuery.noConflict();
jQuery(document).ready(function(){
jQuery('#submit_data').click(function(e){
e.preventDefault();
var error = false;
var event_title = jQuery('#event_title').val();
    event_title = jQuery.trim(event_title);
if(event_title.length == 0){
  var error = true;
  jQuery('#event_title_error').fadeIn(500);
}else{
  jQuery('#event_title_error').fadeOut(500);
}
if(error == false){
  $.post("submit.php?action=edit_event", $("#add_event").serialize(),function(result){
    if(result == 'success') {
      $("#submit_success").show().delay(5000).queue(function (n) {
        $(this).hide();
        n();
      });
      $('#add_event').each(function () {
        this.reset();
      });
      $(document).bind('cbox_closed', function(){
        location.reload();
      });
    } else {
      $('#submit_fail').fadeIn(500);
      $('#submit_data').removeAttr('disabled').attr('value', 'Update');
    }
  });
}
});
});
</script> <?php } // edit event form end here ?>
