<?php
// establish default time for the server
date_default_timezone_set('America/New_York');
include_once "../db.php";

//Get the customerID
$customerID = $_COOKIE['customerID'];
//Get variables posted from the create_account.html form
$name = $_POST['name'];

// update the data
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
//sanitize the data
$name = mysqli_real_escape_string($db, $name);

$sql = "UPDATE `".$db_db."`.web_customers
       SET `name` = '".$name."'
       WHERE `customerID` = '".$customerID."';";
//perform action
$result = mysqli_query($db, $sql); // create the query object                         // create the query object
mysqli_close($db); //close the connection

if($result){
    setcookie("name", $name, time() + (86400 * 30), "/"); // 86400 = 1 day
    // redirect to ...
    header('Location: index.php');
    die;
} else {
    header('Location: change_username.php?message=Unable to change username for this account<br>Please try again or call (802) 373-1035.');
    die;
}

// redirect to ...
header('Location: index.php');
die;
?>