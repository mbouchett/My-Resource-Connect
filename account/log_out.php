<?php
// destroy cookies

setcookie("customerID", "", time() - 3600, "/");
setcookie("session", "", time() - 3600, "/");
setcookie("name", "", time() - 3600, "/");


// redirect to ...
header('Location: ../index.php');

?>