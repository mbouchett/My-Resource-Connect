<?php
// destroy cookies

setcookie("customerID", "", time() - 3600, "/");
setcookie("session", "", time() - 3600, "/");
setcookie("name", "", time() - 3600, "/");
setcookie("type", "", time() - 3600, "/");

// redirect to ...
header('location: ../index.php');

?>