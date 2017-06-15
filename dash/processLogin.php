<?php
session_start(); // start up your PHP session!
    //Establish Variables
    $date = date('F jS Y');
    $userName = $_POST['username'];
    $password = $_POST['pw'];


// include db credentials  $db_user, $db_pw, $db_db
include "../db.php";

//Check to see if user exists
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT * FROM `admin` WHERE `admin_name` = '".$userName."'" ;
$result = mysqli_query($db, $sql); 			// create the query object
$num_results=mysqli_num_rows($result); //How many records meet select
mysqli_close($db); //close the connection

//if the account is not found
if($num_results==0){
   	header('location: index.php?message=bad login');
    die;
}

$resource=mysqli_fetch_assoc($result);

//if username and password don't match
$hash=crypt($password, '$2a$07$theclockswerestrikingthirteen$');


if(trim($hash) != trim($resource['admin_pw'])){
   header('location: index.php?message=bad login');
   die;
}

// SET SESSION VARIABLES
$_SESSION['usernum']=$resource['admin_ID']; // Save User Info For The Session
$_SESSION['username']=$resource['admin_name'];
$_SESSION['userlevel']=$resource['admin_level'];

header('location: dashMenu.php');
die;
?>