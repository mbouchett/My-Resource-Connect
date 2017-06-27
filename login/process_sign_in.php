<?php
// establish default time for the server
date_default_timezone_set('America/New_York');

 include_once "../db.php";

//Get variables posted from the create_account.html form
$type = $_POST['type'];
$email = $_POST['email'];
$password = $_POST['pw'];
//hash the password
$hash=crypt($password, '$2a$07$theclockswerestrikingthirteen$');

if($type == "org") {		//organization login
	// check to see if the user exists
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = "SELECT `org_email`, `org_pw`, `org_name`, `org_ID` FROM orgs WHERE `org_email` = '".$email."'";
	$result = mysqli_query($db, $sql);              // create the query object
	$num_results=mysqli_num_rows($result);          //How many records meet select
	mysqli_close($db); //close the connection
	
	// check to see if email exists
	if($num_results < 1){
	    header('Location: sign_in.php?message=No account exists for this email password combination.');
	    die;
	}
	
	// Fetch the user data
	$user=mysqli_fetch_assoc($result);
	
	// check to see if passwords match
	if($hash != $user['org_pw']){
	    header('Location: sign_in.php?message=No account exists for this email password combination.');
	    die;
	}
	
	// login good - set cookies
	    setcookie("ID", $user['org_ID'], time() + (86400 * 30), "/"); // 86400 = 1 day
	    setcookie("name", $user['org_name'], time() + (86400 * 30), "/"); // 86400 = 1 day
	    setcookie("type", "org", time() + (86400 * 30), "/"); // 86400 = 1 day
	    

}else {echo $hash; /*					//donor login
	// check to see if the user exists
	$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
	$sql = "SELECT `donor_email`, `donor_pw`, `donor_name`, `donor_ID` FROM donors WHERE `donor_email` = '".$email."'";
		echo $sql;
	exit
	$result = mysqli_query($db, $sql);              // create the query object
	$num_results=mysqli_num_rows($result);          //How many records meet select
	mysqli_close($db); //close the connection
	
	// check to see if email exists
	if($num_results < 1){
	    header('Location: sign_in.php?message=No account exists for this email password combination.');
	    die;
	}
	
	// Fetch the user data
	$user=mysqli_fetch_assoc($result);
	echo $user['donor_name'];
	exit
	
	// check to see if passwords match
	if($hash != $user['donor_pw']){
	    header('Location: sign_in.php?message=No account exists for this email password combination.');
	    die;
	}
	
	// login good - set cookies
	    setcookie("ID", $user['donor_ID'], time() + (86400 * 30), "/"); // 86400 = 1 day
	    setcookie("name", $user['donor_name'], time() + (86400 * 30), "/"); // 86400 = 1 day
	    setcookie("type", "donor", time() + (86400 * 30), "/"); // 86400 = 1 day	
*/}

// redirect to ...
header('Location: ../index.php');*/

?>