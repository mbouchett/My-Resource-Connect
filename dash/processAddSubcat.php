<?php
/*resume the user session or return user to login*/
session_start();
if(!isset($_SESSION['username'])){
	header('Location: index.php');
	die;
}

// include db credentials  $db_user, $db_pw, $db_db
include "../txt/3731035";

$catID = $_POST['catID'];
$subCatName = $_POST['subCatName'];

// validate input
if(!$catID || !$subCatName){
	header('Location: manageCats.php?message=Both Fields Required');
	die;
}

//clean data
$subCatName = strip_tags($subCatName);
$subCatName = str_replace('"','',$subCatName);
$subCatName = addslashes($subCatName);


$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
//create insert string
$sql = "INSERT `".$db_db."`.`subcat` (`subcat_name`, `cat_ID`)
        VALUES ('$subCatName', '$catID')";
//perform action insert
$result = mysqli_query($db, $sql); // create the query object
mysqli_close($db); //close the connection

header('Location: manageCats.php?message=Sub-Category Added '.date('l jS \of F Y h:i:s A'));
die;
?>