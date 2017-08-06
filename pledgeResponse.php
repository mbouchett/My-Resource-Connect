<?php
// pledgeResponse.php
include "txt/3731035";
$d = $_REQUEST['donor'];
$n = $_REQUEST['need'];
$msg = $_REQUEST['msg'];

// load need
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT * FROM `needs` WHERE `needs`.`need_ID`=".$n;
$result = mysqli_query($db, $sql); 						// create the query object
mysqli_close($db); 											//close the connection
if($result){
	$need = mysqli_fetch_assoc($result);   			//Fetch and save The Current Record
}

// load donor
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
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
    <link rel="stylesheet" href="css/response_style.css" type="text/css" />
	<link rel="SHORTCUT ICON" href="images/icon.png">
</head>
<body>
<img height="150" src="images/logo.png" alt="My Resource Connect" title="<?= $type ?>" /><br><br>
<span class="donortext"><b><?= $donor['donor_name'] ?></b> has made a pledge</span><br><br>

Regarding your need: <b><?= $need['need_title'] ?></b><br>
<?php if($msg) { ?>
<span class="donortext"><?= $msg ?></span>
<?php }else { ?>
<a class="acceptbtn" href="processPledgeResponse.php?pr=1&donor=<?= $d ?>&need=<?= $n ?>">Accept and close the need</a></br>
<a class="acceptbtn" href="processPledgeResponse.php?pr=2&donor=<?= $d ?>&need=<?= $n ?>">Accept and keep the need open</a></br>
<a class="declinebtn" href="processPledgeResponse.php?pr=3&donor=<?= $d ?>&need=<?= $n ?>">Decline and close the need</a></br>
<a class="declinebtn" href="processPledgeResponse.php?pr=4&donor=<?= $d ?>&need=<?= $n ?>">Decline and keep the need open</a></br>
<?php } ?>
</body>
</html>