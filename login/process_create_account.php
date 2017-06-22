<?php
// establish default time for the server
date_default_timezone_set('America/New_York');
include_once "../db.php";
//Get variables posted from the create_account.html form
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['pw'];
$ein = $_POST['ein'];
$date = date('Y-m-d');

//hash the password
$hash=crypt($password, '$2a$07$theclockswerestrikingthirteen$');

//echo $name."<br>";
//echo $email."<br>";
//echo $password."<br>";
//echo $ein."<br>";
//echo $date."<br>";
//exit;

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
$sql = "INSERT `".$db_db."`.`orgs` (`org_name`, `org_email`, `org_pw`, `org_EIN`)
        VALUES ('$name', '$email', '$hash', '$ein')";

//perform action and get the customerID generated
if ($db->query($sql) === TRUE) {
$customerID = $db->insert_id;
} else $customerID = 0;
mysqli_close($db); //close the connection

// perform login and set cookies
if($customerID > 0){
// account good - set cookies
    setcookie("ID", $customerID, time() + (86400 * 30), "/"); // 86400 = 1 day
    setcookie("name", $name, time() + (86400 * 30), "/"); // 86400 = 1 day
}

// redirect to ...
header('Location: ../index.php');
die;
?>