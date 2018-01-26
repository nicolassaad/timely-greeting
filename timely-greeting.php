<?php
//------ PHP TIMELY GREETING -------//
//---------- Version 1.3 -----------//
//-------- BY NICOLAS SAAD ---------//
//-------- nicolassaad.com ---------//

//--DESCRIPTION:------------------------------------------------------------------------------//
/* A PHP plugin that displays a greeting message based on the user's local time.

This plugin detect a user's time zone using jQuery. First, the current user's timezone offset
(in minutes) is retrieved and stored in a variable. Next, PHP collects this variable using the
$POST. Finally, the timezone is converted into a readable timezone in text-form that the code
can then read. */
//--------------------------------------------------------------------------------------------//

/***IMPORTANT!**READ BELOW:*******************************************************************
 1. Place this file in your project's 'includes' folder (which should be in your project's
root. If you place this file somewhere else you will need to update the $.ajax request
and replace the 'url:' with your own custom relative path for this file.

2. To use this plug-in, use include this file where you want the greeting to display:
include('includes/timely-greeting.php') (make sure your file path is correct)
*********************************************************************************************/

// Handle AJAX request (start)
if( isset($_POST['name']) ){

    // Storing the timezone offset from the jQuery code
    $timezone_offset_minutes = $_POST['name'];

    // Convert minutes to seconds
    $timezone_name = timezone_name_from_abbr("", $timezone_offset_minutes*60, false);
    //JS code is needed to retrieve the user's timezone dynamically so we have it set statically for now
    date_default_timezone_set($timezone_name);

    // Morning start and end times (12:00 AM - 11:59 AM)
    $morningStart = '0000';
    $morningEnd   = '1159';
    // Afternoon start and end times (12:00 PM - 4:59 PM)
    $afterNoonStart = '1200';
    $afterNoonEnd   = '1659';
    // Evening start and end times (5:00 PM - 11:59 PM)
    $eveningStart = '1700';
    $eveningEnd   = '2359';

    // Greetings. You can edit the values below **Do not edit the keys**
    $greetings = array(
        "morning"   => "Good morning",
        "afternoon" => "Good afternoon",
        "evening"   => "Good evening"
        );

    // Retrieving the current time
    $now = date('H:i');
    $now = str_replace(":" , "" , "$now");

    //Checking the current time of day in order to display the correct greeting
    if ( ($now >= $morningStart) && ( $now <= $morningEnd ) ) {
        echo $greetings["morning"];

    } elseif ( ($now >= $afterNoonStart) && ( $now <= $afterNoonEnd) ) {
        echo $greetings["afternoon"];

    } elseif ( ($now >= $eveningStart) && ( $now <= $eveningEnd) ) {
         echo $greetings["evening"];
    }
exit;
}
?>
<span id="greeting" style="float:left"></span>

<script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
<!-- Timezone offset Retrieval jQuery -->
<script>
  var timezone_offset_minutes = new Date().getTimezoneOffset();
  timezone_offset_minutes = timezone_offset_minutes == 0 ? 0 : -timezone_offset_minutes;

  console.log( "TZ offset in minutes: " + timezone_offset_minutes); // logging the timezone offset in min

  $.ajax({
        url: '../includes/timely-greeting.php', // EDIT THIS FILEPATH IF IT DIFFERS FROM YOUR PROJECT'S
        type: 'post',
        data: {name: timezone_offset_minutes},
        success: function(data){
        $('#greeting').text(data);
        }
    });
</script>