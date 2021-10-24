# Timely-Greeting PHP Plug-in v2.0
 
Timely-Greeting is a PHP plug-in for websites that displays a greeting message based on the page visitor's local time.

There are three greetings: Good Morning (00:00AM - 11:59AM), Good Afternoon (12:00PM - 16:59PM), and Good Evening (17:00PM - 23:59PM).

Feel free to customize the greetings and times to your preference in the code. 

## How it Works:
* This plugin detect a user's time zone using jQuery, where the current user's timezone offset
(in minutes) is retrieved and stored in a variable. 
* Next, PHP collects this variable using $POST. 
* Finally, the timezone is converted into a readable timezone that the code can use to print out the appropriate greeting for the user's time of day. 
* The result is cool a dynamic greeting, great for a landing page on a website (and also accounts for whether or not your region has Daylight Savings Time).

## To Use:
* First, download the plugin file 'timely-greeting.php' and place it inside your project.
* To use this plug-in in your project, include the 'timely-greeting.php' file using the include() function at the top of the page you want the greeting to go in.

Example:
\<?php include('includes/timely-greeting.php'); ?>

* Then, add this line of HTML in the exact spot you want the greeting to go on your web page:

\<span class="timelyGreeting"></span> //greeting message generates here
