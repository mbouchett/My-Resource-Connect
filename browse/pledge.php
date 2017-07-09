<?php
include "../db.php";
$name = $_COOKIE['name'];
$ID = $_COOKIE['ID'];
$type = $_COOKIE['type'];
$need_ID = $_REQUEST['need'];

if(!$ID) {
	header('location: ../login/sign_in.php');	
}

// load need
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT `needs`.`need_ID`, `needs`.`org_ID`, `needs`.`need_date`, 
		   `needs`.`need_title`, `needs`.`need_description`, `orgs`.`org_name`	
		  FROM `needs`
	     LEFT JOIN `orgs` ON `needs`.`org_ID` = `orgs`.`org_ID` 
	     WHERE `needs`.`need_ID`=".$need_ID;
     
$result = mysqli_query($db, $sql); 						// create the query object
mysqli_close($db); 											//close the connection
if($result){
	$need = mysqli_fetch_assoc($result);   	//Fetch and save The Current Record                                         		//Close The Loop
}

// load donor
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Pledge</title>
</head>
<body>
<?= $need['org_name'] ?><br>
<?= $need['need_title'] ?><br>
<hr width="900px">
<?= $need['need_description'] ?>
<hr width="900px">
<?= $name ?> is ready to help you out!<br>
<form action="processPledge.php" method="POST">
Message to the organization:<br>
<textarea name="message" rows="7" cols="70" placeholder="Please incluse any message, comments or questions associated with your pledge"></textarea>
</form>

</body>
</html>