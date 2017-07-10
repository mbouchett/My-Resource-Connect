<?php
include "../db.php";
$type = $_COOKIE['type'];
$need_ID = $_REQUEST['need'];

if($type != "org") {
	header('location: ../login');	
}

echo $type."<br>";
echo $need_ID."<br>";


?>