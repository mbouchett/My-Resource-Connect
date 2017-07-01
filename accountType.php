<?php
// accountType.php
$type = $_COOKIE['type'];

if($type == "org") header('location: account/');
if($type == "donor") header('location: donor/');
die;
?>