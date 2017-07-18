<?php
include "../txt/3731035";
$type = $_COOKIE['type'];
$need_ID = $_REQUEST['need'];

if($type != "org") {
	header('location: ../login');	
}

$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "DELETE FROM `".$db_db."`.`needs` WHERE `need_ID`=".$need_ID;
$result = mysqli_query($db, $sql);
mysqli_close($db); 
header('location: index.php');
?>