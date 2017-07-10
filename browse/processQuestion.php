<?php
// processQuestion.php
$donor_ID = $_POST['donor_ID'];
$question = $_POST['question'];
$need_ID = $_POST['need_ID'];

// load need
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT `needs`.`need_ID`, `needs`.`org_ID`, `needs`.`need_date`, 
		   `needs`.`need_title`, `needs`.`need_description`, `orgs`.`org_name`,
		   `orgs`.`org_email`	
		  FROM `needs`
	     LEFT JOIN `orgs` ON `needs`.`org_ID` = `orgs`.`org_ID` 
	     WHERE `needs`.`need_ID`=".$need_ID;
     
$result = mysqli_query($db, $sql); 						// create the query object
mysqli_close($db); 											//close the connection
if($result){
	$need = mysqli_fetch_assoc($result);   			//Fetch and save The Current Record
}

// load donor
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT *	
		  FROM `donors` 
	     WHERE `needs`.`donor_ID`=".$donor_ID;
     
$result = mysqli_query($db, $sql); 						// create the query object
mysqli_close($db); 											//close the connection
if($result){
	$donor = mysqli_fetch_assoc($result);   			//Fetch and save The Current Record
}


echo $donor_ID."<br>";
echo $question."<br>";
echo $need_ID."<br>";
echo $need_ID."<br>";
echo $need['org_email']."<br>";
echo $donor['donor_email']."<br>";

die;
?>
