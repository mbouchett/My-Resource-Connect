<?php
// processQuestion.php
$donor_ID = $_POST['donor_ID'];
$question = $_POST['question'];
$need_ID = $_POST['need_ID'];
echo $donor_ID."<br>";
echo $question."<br>";
echo $need_ID."<br>";

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
die;

?>
