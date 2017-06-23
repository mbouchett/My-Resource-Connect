<?php
// remove all session variables
session_unset();

// destroy the session
session_destroy(); 

unset($_SESSION['username']);

// redirect to ...
header('location: index.php');

?>