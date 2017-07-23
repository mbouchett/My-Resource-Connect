<?php 
// processPledgeResponse.php
include "txt/3731035";

$d = $_REQUEST['donor'];
$n = $_REQUEST['need'];
$pr = $_REQUEST['pr'];
$today = date("Y-m-d H:i:s");

//range check the REQUEST data
if($pr < 0 || $pr > 4 || !$pr){
	header('location: index.php');
	die;
}
if(!is_numeric($d) || !is_numeric($n)) {
	header('location: index.php');
   die;
}

// load need
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT `needs`.`need_ID`, `needs`.`org_ID`, `needs`.`need_date`, 
		   `needs`.`need_title`, `needs`.`need_description`, `orgs`.`org_name`,
		   `orgs`.`org_email`	
		  FROM `needs`
	     LEFT JOIN `orgs` ON `needs`.`org_ID` = `orgs`.`org_ID`
	     WHERE `needs`.`need_ID`=".$n;
     
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

//build email header
// Set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From:  ' . $need[org_name] . ' <' . $need[org_email] .">\r\n";
$subject = $need[org_name]. " has reasponded to your pledge.";
$to = $donor[donor_email];

//pr=1">Accept and close the need
if($pr == 1) {
	// update the database
	$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = "UPDATE `".$db_db."`.`needs` 
				SET `pledge_by` = ".$d.", 
				`pledge_date` = \"".$today."\" 
				WHERE `needs`.`need_ID` = ".$n; 
	$result = mysqli_query($db, $sql);
	mysqli_close($db); 
	
	// email the donor
	$msg = "Thank You for your generous pledge!<br><br>";
	$msg .= $need['org_name']. " greatfully accepts your pledge.<br>";
	$msg .= "Please follow up with them directly by emailing them at: ".$need['org_email'];
	
	//Send Mail
	mail($to, $subject, $msg, $headers);
	
	//return to the confirmation screen
	header('location: pledgeResponse.php?msg="Pledge Accepted - Need Closed&donor='.$d.'&need='.$n);
	die;
}

//pr=2">Accept and keep the need open
if($pr == 2) {
	// email the donor
	$msg = "Thank You for your generous pledge!<br><br>";
	$msg .= $need['org_name']. " greatfully accepts your pledge.<br>";
	$msg .= "Please follow up with them directly by emailing them at: ".$need['org_email'];
	
	//Send Mail
	mail($to, $subject, $msg, $headers);
	
	//return to the confirmation screen
	header('location: pledgeResponse.php?msg="Pledge Accepted - Need Retained&donor='.$d.'&need='.$n);
	die;
}

//pr=3">Reject and close the need
if($pr == 3) {
	// update the database
	$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = "UPDATE `".$db_db."`.`needs` 
				SET `pledge_by` = ".$d.", 
				`pledge_date` = \"".$today."\" 
				WHERE `needs`.`need_ID` = ".$n; 
	$result = mysqli_query($db, $sql);
	mysqli_close($db); 
	
	// email the donor
	$msg = "Thank You for your generous pledge!<br><br>";
	$msg .= "However, " .$need['org_name']. " no longer has this need.<br>";
	$msg .= "Please know that we are grateful and sincerly appreciate your offer to help.<br>";
	$msg .= "We hope that we can find a way to work together in the future."; 
	
	//Send Mail
	mail($to, $subject, $msg, $headers);
		
	//return to the confirmation screen
	header('location: pledgeResponse.php?msg="Pledge Declined - Need Closed&donor='.$d.'&need='.$n);
	die;
}

//pr=4">Reject and keep the need open
if($pr == 4) {
	// email the donor
	$msg = "Thank You for your generous pledge!<br><br>";
	$msg .= "However, " .$need['org_name']. " we cannot accept your pledge at this time.<br>";
	$msg .= "Please know that we are grateful and sincerly appreciate your offer to help.<br>";
	$msg .= "We hope that we can find a way to work together in the future."; 
	
	//Send Mail
	mail($to, $subject, $msg, $headers);
	
	//return to the confirmation screen
	header('location: pledgeResponse.php?msg="Pledge Declined - Need Retained&donor='.$d.'&need='.$n);
	die;
}

header('location: index.php');
?>