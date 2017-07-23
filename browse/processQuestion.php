<?php
// processQuestion.php
include "../txt/3731035";
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
$sql = "SELECT * FROM `donors` WHERE `donor_ID`=".$donor_ID;
     
$result = mysqli_query($db, $sql); 						// create the query object
mysqli_close($db); 											//close the connection
if($result){
	$donor = mysqli_fetch_assoc($result);   			//Fetch and save The Current Record
}
// *** Build The Email ***

// Set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From:  ' . $donor[donor_name] . ' <' . $donor[donor_email] .">\r\n";
$subject = "A potential donor has a question";

$question = wordwrap($question,70);

// $to = $need['org_email']; Removed for testing
$to = "mb8023731035@gmail.com";
$message = "This inquiry is reagrding your need titled: ";
$message .= $need[need_title]."<br><br>";
$message .= "<span style=\"font-weight: bold;\">Donor's question:</span> <br>";
$message .= $question . "<hr>";
 
// *** End Build Email ***
//Send Mail
mail($to, $subject, $message, $headers);

header('location: ../index.php?alert=1');
die;
?>
