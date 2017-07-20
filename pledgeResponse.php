<?php
// processQuestion.php
include "txt/3731035";
$d = $_REQUEST['donor'];
$n = $_REQUEST['need'];

// load need
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT * FROM `needs` WHERE `needs`.`need_ID`=".$n;
$result = mysqli_query($db, $sql); 						// create the query object
mysqli_close($db); 											//close the connection
if($result){
	$need = mysqli_fetch_assoc($result);   			//Fetch and save The Current Record
}

// load donor
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT * FROM `donors` WHERE `donor_ID`=".$d;
$result = mysqli_query($db, $sql); 						// create the query object
mysqli_close($db); 											//close the connection
if($result){
	$donor = mysqli_fetch_assoc($result);   			//Fetch and save The Current Record
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Respond to a pledge</title>
</head>
<body>
<?= $donor['donor_name'] ?> has made a pledge<br>

Regarding your need: <?= $need['need_title'] ?><br>

<button>Accept and close the need</button></br>
<button>Accept and keep the need open</button></br>
<button>Reject and close the need</button></br>
<button>Reject and keep the need open</button></br>
</body>
</html>