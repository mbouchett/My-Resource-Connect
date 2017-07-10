<?php
// processAddNeed.php
include "../db.php";

$org_ID = $_COOKIE['ID'];
$need_title = $_POST['need_title'];
$need_description = $_POST['need_description'];
$need_by = $_POST['need_by'];
$subcat_ID = $_POST['subcat_ID'];

// validations and verifications
if(!$org_ID){
	header('location: ../login/');
	die;
}

if(!$need_title || !$need_description){
	header('location: addNeed.php?message=Title and Description are required&subcat='.$subcat_ID);
	die;
}

if(!$need_by) $need_by = date('m/d/Y');

// update the data
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);

// sanitize input
$need_title = str_replace("'", "", $need_title);
$need_title = mysqli_real_escape_string($db, $need_title);
$need_title = addslashes($need_title);
$need_description = str_replace("'", "", $need_description);
$need_description = mysqli_real_escape_string($db, $need_description);
$need_description = addslashes($need_description);
$need_by = mysqli_real_escape_string($db, $need_by);


$sql = "INSERT `".$db_db."`.`needs` (`need_title`, `need_description`, `need_by`, `org_ID`, `subcat_ID`)
        VALUES ('$need_title', '$need_description', '$need_by', '$org_ID', '$subcat_ID')";
              
$result = mysqli_query($db, $sql); 	// create the query object
mysqli_close($db);						//close the connection

header('location: addNeed.php?message=Need Added - '.date('m/d/Y'));
?>