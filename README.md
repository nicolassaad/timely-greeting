# Timely-Greeting PHP Plug-in v1.1
 
Timely-Greeting is a PHP plug-in that displays a greeting message based on a user's local time.

This plug-in implements jQuery that allows for the server's timezone to be set dynamically. The original design for this code required a hardcoded timezone which restricted it to only functioning correctly in one set timezone. With a dynamic timezone, user'swho visit your site from all over the world should recieve the correct greeting.

## To Use:
* First, download the file, 'timely-greeting.php' and place it inside your project in a folder called 'includes' (which must be in your project's root).
* To use this plug-in in your project, call the include() function exactly where you want the greeting to display.
Example:
\<?php include('includes/timely-greeting.php'); ?>

## IMPORTANT!
* Place this file in your project's 'includes' folder (which should be in your project's  
root folder). If you place this file somewhere else you will need to update the $.ajax request     
'url:' with your own custom relative path for this file. Example:

url: '../includes/timely-greeting.php', // EDIT THIS FILEPATH IF IT DIFFERS FROM YOUR PROJECT'S 
    
