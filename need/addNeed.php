<?php
// need/addNeed.php
$name = $_COOKIE['name'];
$ID = $_COOKIE['ID'];
$message = $_REQUEST['message'];

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
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Post a new need for: <?= $name ?></title>
</head>
<body>
<?= $name ?><br>
Post a new need for <?= $subCat['subcat_name']; ?>

</body>
</html>