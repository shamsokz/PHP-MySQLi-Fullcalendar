<?php require_once('db.php'); // database connection ?>
<!DOCTYPE html>
<html lang="en">
<head>
<link href="css/main.css" rel="stylesheet" />
<link href="css/colorbox.css" rel="stylesheet" />
<link href='css/fullcalendar.min.css' rel='stylesheet' />
<link href='css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
</head>
<body>
<div id='calendar'></div>
<!-- fullcalendar scripts -->
        <script src='js/jquery-1.12.4.js'></script>
        <script src="js/jquery.colorbox.js"></script>
        <script src='js/jquery.min.js'></script>
        <script src='js/moment.min.js'></script>
        <script src='js/fullcalendar.min.js'></script>
        <script>
        jQuery.noConflict();
          jQuery(document).ready(function() {
            jQuery('#calendar').fullCalendar({
              header: {
        				left: 'prev,next today', // calendar top left buttons
        				center: 'title', // calendar title i.e June 2017
        				right: 'month,basicWeek,basicDay,listWeek' // calendar top right buttons
        			},
        			navLinks: true, // can click day/week names to navigate views
        			editable: true,
        			eventLimit: true, // allow "more" link when too many events
              selectable: true,
              select: function(start) { // open add event form
                $.colorbox({href:'forms/event.php?form=add_event&date='+start,width: "40%"});
        			},
              eventClick: function(calEvent, jsEvent, view) { // open event detail form with single click
                $.colorbox({href:'forms/event-detail.php?event='+calEvent.id,width: "40%"});
              },
              eventDrop: function(event, delta, revertFunc) { // drag and drop event to edit date
        	edit(event);
              },
        	events: [
                <?php
                $sql = "SELECT `event_id`, `event_title`, `start_date` FROM `tbl_events`";
                $res = $conn->query($sql);
                while ($row = $res->fetch_array()) {
                $event_id = $row['event_id'];
                $event_title = $row['event_title'];
                $start_date = $row['start_date'];
                ?>
                {
                  id: '<?php echo $event_id; ?>',
                  title: '<?php echo $event_title; ?>',
                  //icon : '', we can display different icons with event title
        	  start: '<?php echo $start_date; ?>',
                  //color: '', we can use different colors for different events
        	}, <?php } // end php script ?>
        	]
            });
            // edit event function
            function edit(event){
                start = event.start.format('YYYY-MM-DD HH:mm:ss');
                id =  event.id;
        	Event = [];
        	Event[0] = id;
        	Event[1] = start;
        	$.ajax({
        	url: 'edit-event.php', // edit page URL
        	type: "POST",
        	data: {Event:Event},
                success: function(result) {
        		if(result == 'OK'){
        		// show success message here if you want otherwise leave as it is
        		} else {
        		// show error message here if you want otherwise leave as it is
        		}
        	}
        });
     }
 });
</script>
</body>
</html>
