# Timely-Greeting PHP Plug-in v1.3
 
Timely-Greeting is a PHP plug-in that displays a greeting message based on a user's local time.

This plug-in implements jQuery that allows for the server's timezone to be set dynamically. The original design for this code required a hardcoded timezone which restricted it to only functioning correctly in one set timezone. With a dynamic timezone, users who visit your site from all over the world should recieve the correct greeting.

## To Use:
* First, download both files: 'timely-greeting.php' and 'js-ajax-php.html' and place them TOGETHER inside your project.
* To use this plug-in in your project, include the 'timely-greeting.php' file using the include() function at the top of the page you wan the greeting to go in.

Example:
\<?php include('includes/timely-greeting.php'); ?>

* Then, add this line in the exact spot you want your greeting to go:

Example:
\<span id="timelyGreeting"></span>

