<?php
// need/addNeed.php


include "../db.php";

$subCat = $_REQUEST['subcat'];


//get subcats
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT * FROM `subcat`
        LEFT JOIN `cats`
        ON `subcat`.`cat_ID` = `cats`.`cat_ID`
        WHERE `subcat`.`subcat_ID`=".$subCat;
        
$result = mysqli_query($db, $sql); 			// create the query object
mysqli_close($db); 								//close the connection
if($result){
	$subCat = mysqli_fetch_assoc($result);
} 

echo $subCat['subcat_name'];

?>