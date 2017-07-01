<?php
// establish default time for the server
date_default_timezone_set('America/New_York');
include_once "../db.php";

//Get the customerID
$ID = $_COOKIE['ID'];
//Get variables posted from the create_account.html form
$password = $_POST['pw0'];
$newPassword = $_POST['pw1'];
$date = date('Y-m-d');

//hash the passwords
$password=crypt($password, '$2a$07$theclockswerestrikingthirteen$');
$newPassword=crypt($newPassword, '$2a$07$theclockswerestrikingthirteen$');


// check to see if the user already exists
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);;
$sql = "SELECT `org_email`, `org_pw`, `org_name`, `org_ID` FROM orgs WHERE `org_ID` = '".$ID."'";
$result = mysqli_query($db, $sql);              // create the query object
$num_results=mysqli_num_rows($result);          //How many records meet select
mysqli_close($db); //close the connection

// see if the account exists
if($num_results == 0){
    header('Location: change_password.php?message=(0)Unable to reset the password for this account<br>Please try again or call (802) 373-1035.');
    die;
} else {
    // Fetch the user data
    $user=mysqli_fetch_assoc($result);
}

// check the temporary password
if($password != $user['org_pw']){
    header('Location: change_password.php?message=(1)Unable to reset the password for this account<br>Please try again or call (802) 373-1035.');
    die;
}

// Reset password
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "UPDATE `".$db_db."`.orgs
       SET `org_pw` = '".$newPassword."'
       WHERE `org_ID` = '".$ID."';";
//perform action
$result = mysqli_query($db, $sql); // create the query object
mysqli_close($db); //close the connection

if(!$result){
    header('Location: change_password.php?message=(2)Unable to reset the password for this account<br>Please try again or call (802) 373-1035.');
    die;
}

// redirect to ...
header('Location: confirmReset.php');
?>