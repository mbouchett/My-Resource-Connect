<?php
// establish default time for the server
date_default_timezone_set('America/New_York');
include "../db.php";

//Get the userID
$ID = $_COOKIE['ID'];
//Get variables posted from the create_account.html form
$email = $_POST['email'];

// update the data
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
//sanitize the data
$email = mysqli_real_escape_string($db, $email);


$sql = "UPDATE `".$db_db."`.donors
       SET `donor_email` = '".$email."'
       WHERE `donor_ID`=".$ID.";";
//perform action
$result = mysqli_query($db, $sql); // create the query object                         // create the query object
mysqli_close($db); //close the connection

if(!$result){
    header('Location: change_username.php?message=(2)Unable to update the email address for this account<br>Please try again or call (802) 863-4644.');
    die;
}

// redirect to ...
header('Location: index.php');
die;
?>