<?php
// processQuestion.php
include "../txt/3731035";
$donor_ID = $_POST['donor_ID'];
$message = $_POST['message'];
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
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type:text/html;charset=UTF-8\r\n";
$headers .= 'From:  ' . $donor[donor_name] . ' <' . $donor[donor_email] .">\r\n";
$headers .= 'Reply-To: '.$donor[donor_email]. "\r\n";
$subject = "MyResourceConnect: ".$donor[donor_name]." has made a pledge";

$message = wordwrap($message,70);

// $to = $need['org_email']; Removed for testing
$to = "mb8023731035@gmail.com";
$msg = "This pledge is for your need titled: ";
$msg .= $need[need_title]."<br>";
$msg .= "This pledge is from: ".$donor[donor_name]."<br>";
$msg .= "You may contact the donor at: ".$donor[donor_email]."<br><br>";
if($message) {
	$msg .= "<span style=\"font-weight: bold;\">Donor's Comment:</span> <br>";
	$msg .= $message . "<hr>";
}
$msg .= "<a href =\"www.myresourceconnect.org/pledgeResponse.php?need=".$need_ID."&donor=".$donor_ID."\" >Click Here to RESPOND to this pledge!</a></br>";
// *** End Build Email ***
//Send Mail
mail($to, $subject, $msg, $headers);

header('location: ../index.php?alert=2');
die;
?>
