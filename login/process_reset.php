<?php
// establish default time for the server
date_default_timezone_set('America/New_York');
include_once "../txt/3731035";

//Get variables posted from the create_account.html form
$email = $_POST['email'];
$password = $_POST['pw0'];
$newPassword = $_POST['pw1'];
$date = date('Y-m-d');

//hash the passwords
$hash=crypt($password, '$2a$07$theclockswerestrikingthirteen$');
$newPassword=crypt($newPassword, '$2a$07$theclockswerestrikingthirteen$');

// check to see if the user already exists
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT `email`, `password`, `name`, `customerID` FROM web_customers WHERE `email` = '".$email."'";
$result = mysqli_query($db, $sql);              // create the query object
$num_results=mysqli_num_rows($result);          //How many records meet select
mysqli_close($db); //close the connection

// see if the account exists
if($num_results == 0){
    header('Location: reset.php?message=(0)Unable to reset the password for this account<br>Please try again or call (802) 863-4644.');
    die;
} else {
    // Fetch the user data
    $user=mysqli_fetch_assoc($result);
}

// check the temporary password
if($password != $user['password']){
    header('Location: reset.php?message=(1)Unable to reset the password for this account<br>Please try again or call (802) 863-4644.');
    die;
}

// Reset password
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "UPDATE `hp_data`.web_customers
       SET `password` = '".$newPassword."'
       WHERE `email` = '".$email."';";
//perform action
$result = mysqli_query($db, $sql); // create the query object                         // create the query object
mysqli_close($db); //close the connection

if($result){
    // if password reset good - set cookies
    setcookie("customerID", $user['customerID'], time() + (86400 * 30), "/"); // 86400 = 1 day
    setcookie("session", $user['password'], time() + (86400 * 30), "/"); // 86400 = 1 day
    setcookie("name", $user['name'], time() + (86400 * 30), "/"); // 86400 = 1 day
} else {
    header('Location: reset.php?message=(2)Unable to reset the password for this account<br>Please try again or call (802) 863-4644.');
    die;
}

// redirect to ...
header('Location: confirmReset.php');
?>