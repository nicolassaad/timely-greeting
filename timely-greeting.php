<?php
//------ PHP TIMELY GREETING -------//
//---------- Version 2.0 ----------//
//-------- BY NICOLAS SAAD ---------//
//-------- nicolassaad.com ---------//

//--DESCRIPTION:------------------------------------------------------------------------------//
/* A PHP plugin that displays different greeting messages based on the user's local time.
   This plugin detect a user's time zone using jQuery. First, the current user's timezone offset
   (in minutes) is retrieved and stored in a variable. Next, PHP collects this variable using
   $POST. Finally, the timezone is converted into a readable timezone in text-form that the code
   can then read. */
//--HOW TO USE:-------------------------------------------------------------------------------//
/* 1. Download the plugin file (timely-greeting.php) and store it in your project.
   2. Make sure to include the file 'timely-greeting.php' at the top of the page you want to use it in.
   Example: <?php include('includes/timely-greeting.php'); ?>
   3. In the exact spot on your web page where you want the greeting to display, add this line of HTML:
   <span class="timelyGreeting"></span> <!-- greeting outputs inside span tags -->
   */
//--------------------------------------------------------------------------------------------//

// Handle AJAX request (start)
if( isset($_POST['name']) ){

    // Storing the timezone offset from the jQuery code
    $timezone_offset_minutes = $_POST['name'];

    // Convert minutes to seconds
    $timezone_name = timezone_name_from_abbr("", ($timezone_offset_minutes*60), false);
    //JS code is needed to retrieve the user's timezone dynamically so we have it set statically for now
    date_default_timezone_set($timezone_name);

    // Morning start and end times 12:00AM - 11:59AM (12:00AM - 11:59AM)
    $morningStart = '0000';
    $morningEnd   = '1159';
    // Afternoon start and end times 12:00PM - 4:59PM (12:00PM - 4:59PM)
    $afterNoonStart = '1200';
    $afterNoonEnd   = '1659';
    // Evening start and end times 5:00PM - 11:59PM (5:00PM - 11:59PM)
    $eveningStart = '1700';
    $eveningEnd   = '2359';

    // The text greetings. **You can edit the values below but do not edit the keys**
    $greetings = array(
        "morning"   => "Good morning",
        "afternoon" => "Good afternoon",
        "evening"   => "Good evening"
        );

    // Retrieving the current time
    $now = date('H:i');

    //error_log(print_r($now, false));

    // Removing the colon from the $now variable
    $now = str_replace(":" , "" , "$now");

    //Checking the current time of day in order to display the correct greeting
    if ( ($now >= $morningStart) && ( $now <= $morningEnd ) ) {
        echo $greetings["morning"];

    } elseif ( ($now >= $afterNoonStart) && ( $now <= $afterNoonEnd) ) {
        echo $greetings["afternoon"];

    } elseif ( ($now >= $eveningStart) && ( $now <= $eveningEnd) ) {
         echo $greetings["evening"];
    }
exit; // escapes the rest of the timezone-ajax.html page from printing
}
?>

<!DOCTYPE html>
<html>
<head><meta charset="utf-8"></head>
  <body>
    <!-- Begin jQuery -->
    <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
    <!-- Timezone offset Retrieval jQuery -->
    <script>
      var d = new Date();
      var month = d.getMonth();
      var day = d.getDate();
      var dow = d.getDay();

      var timezone_offset_minutes = new Date().getTimezoneOffset();
      timezone_offset_minutes = timezone_offset_minutes == 0 ? 0 : -timezone_offset_minutes; // if the offset is 0 leave it alone or else negate the offset value (example: 100 becomes -100).

      console.log( "User's local TZ offset in minutes: " + timezone_offset_minutes); // logging the user's timezone offset in min

      // Checks if DST is on and subtracts 60 minutes from the UTC offset to correctly adjust for Daylight Savings
      if (isDST(day, month, dow)) { // isDST returns "true"
          timezone_offset_minutes = timezone_offset_minutes - 60;
          console.log("DST in North America is Currently ON (Started on the 2nd Sun of Mar & will end on the 1st Sun of Nov)");
      } else { // isDST returns "false"
          console.log("DST in North America is Currently OFF");
      }

      // Function that checks if DST in North America is on or off. Returns true for on and false for off.
      function isDST(day, month, dow) {
        //January, february, and december are out.
        if (month < 2 || month > 10) { return false; }
        //April to October are in
        if (month > 2 && month < 10) { return true; }
        var previousSunday = day - dow; //Getting the previous sunday day by subtracting the dow from the day of month.
        //In march, we are DST if our previous sunday was on or after the 8th.
        if (month == 2) { return previousSunday >= 8; }
        //In november we must be before the first sunday to be in dst.
        //That means the previous sunday must be before the 1st.
        return previousSunday <= 0;
      }

      function fetchdata(){
      $.ajax({
      type: 'post',
      data: {name: timezone_offset_minutes},
      datatype: 'text',
      success: function(data){
        // Perform operation on the return value
        $('.timelyGreeting').text(data) /* Using 'exit;' at the end of if( isset($_POST['name']) in timely-greeting.php*/
       }
     });
    }

    $(document).ready(function(){
     fetchdata(); // executing fetchdata() first so the greeting displays when the page loads
     setInterval(fetchdata, 30000); // interval set to update greeting every 30 seconds. Greeting is updated live on the page without reloading
    });
    </script>
  </body>
</html>
