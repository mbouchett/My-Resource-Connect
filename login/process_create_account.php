<?php
// establish default time for the server
date_default_timezone_set('America/New_York');
include_once "../db.php";
<<<<<<< HEAD
require __DIR__ . '/twilio-php-master/Twilio/autoload.php'; 
=======
>>>>>>> 17c741c234e9626e02c44624f50b219d447864f2

//Get variables posted from the create_account.html form
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['pw'];
$ein = $_POST['ein'];
$date = date('Y-m-d');
$type = $_POST['type'];
$phone = $_POST['phone'];

//hash the password
$hash=crypt($password, '$2a$07$theclockswerestrikingthirteen$');

//echo $name."<br>";
//echo $email."<br>";
//echo $password."<br>";
//echo $ein."<br>";
//echo $date."<br>";
//echo $phone."<br>";
//echo $type."<br>";
//exit;

if($type == "org") {
	// check to see if the user already exists
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	
	$sql = "SELECT `org_email`, `org_pw`, `org_ID` FROM orgs WHERE `org_email` = '".$email."'";
	$result = mysqli_query($db, $sql);              // create the query object
	$num_results=mysqli_num_rows($result);          //How many records meet select
	mysqli_close($db); //close the connection
	
	if($num_results > 0){
	    header('Location: create_account.php?message=Account already exists for this email.');
	    die;
	}
	
	// enter new account into the database
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	
	// sanitize input
	$ein = mysqli_real_escape_string($db, $ein);
	$name = mysqli_real_escape_string($db, $name);
	//the rest have already been verified pre-post
	
	$sql = "INSERT `".$db_db."`.`orgs` (`org_name`, `org_email`, `org_pw`, `org_EIN`)
	        VALUES ('$name', '$email', '$hash', '$ein')";
	
	//perform action and get the customerID generated
	if ($db->query($sql) === TRUE) {
	$ID = $db->insert_id;
	} else $ID = 0;
	mysqli_close($db); //close the connection
	
	// perform login and set cookies
	if($ID > 0){
	// account good - set cookies
	    setcookie("ID", $ID, time() + (86400 * 30), "/"); // 86400 = 1 day
	    setcookie("name", $name, time() + (86400 * 30), "/"); // 86400 = 1 day
		 setcookie("type", "org", time() + (86400 * 30), "/"); // 86400 = 1 day
	}
	// redirect to ...
	header('Location: ../index.php');
	die;
}
if($type == "donor"){
	// check to see if the user already exists
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);

	$sql = "SELECT `donor_email`, `donor_pw`, `donor_ID` FROM donors WHERE `donor_email` = '".$email."'";
	$result = mysqli_query($db, $sql);              // create the query object
	$num_results=mysqli_num_rows($result);          //How many records meet select
	mysqli_close($db); //close the connection
	
	if($num_results > 0){
	    header('Location: create_account.php?message=Account already exists for this email.');
	    die;
	}	
	
	// enter new account into the database
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	
	// sanitize input
	$phone = mysqli_real_escape_string($db, $phone);
	$name = mysqli_real_escape_string($db, $name);
	//the rest have already been verified pre-post
	$code = rand(100000,999999);	
		
	$sql = "INSERT `".$db_db."`.`donors` (`donor_name`, `donor_email`, `donor_pw`, `donor_telephone`, `donor_code`)
     VALUES ('$name', '$email', '$hash', '$phone', '$code')";

   //perform action and get the ID generated
	if ($db->query($sql) === TRUE) {
	$ID = $db->insert_id;
	} else $ID = 0;
	mysqli_close($db); //close the connection 
	
	// perform login and set cookies
	if($ID > 0){
	// account good - set cookies
	    setcookie("ID", $customerID, time() + (86400 * 30), "/"); // 86400 = 1 day
	    setcookie("name", $name, time() + (86400 * 30), "/"); // 86400 = 1 day
	    setcookie("type", "donor", time() + (86400 * 30), "/"); // 86400 = 1 day
	}
	$chs = array("(", ")", ".", "-", " ");
	$to = str_replace($chs, "", $phone);
	$to = "+1".$to;
	$text = "Account Authorization Code: ".$code."\n";
<<<<<<< HEAD

//***********************************************************************************************

// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
$sid = 'AC728398f52ebbfc782a8d3ec00a81d9e7';
$token = '69cb081f2f9e7dffd2463657cb7fc71d';
$client = new Client($sid, $token);

// Use the client to do fun stuff like send text messages!
$client->messages->create(
    // the number you'd like to send the message to
    $to,
    array(
        // A Twilio phone number you purchased at twilio.com/console
        'from' => '+18029921899',
        // the body of the text message you'd like to send
        'body' => $text
    )
);

//***********************************************************************************************
=======
/* ACCOUNT VERIFICATION STILL NEEDS WORK
//***********************************************************************************************


//***********************************************************************************************

>>>>>>> 17c741c234e9626e02c44624f50b219d447864f2
	// redirect to ...
	header('Location: .donorAuth.php');
	die;
}*/
<<<<<<< HEAD
die;

=======
	// redirect to ...
	header('Location: ../index.php');
	die;
>>>>>>> 17c741c234e9626e02c44624f50b219d447864f2
?>