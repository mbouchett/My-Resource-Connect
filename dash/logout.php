<?php
session_start(); // Resume up your PHP session!

// remove all session variables
session_unset();

// destroy the session
session_destroy(); 

// redirect to ...
header('location: index.php');

?>