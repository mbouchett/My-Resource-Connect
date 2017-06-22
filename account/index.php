<?php
$name = $_COOKIE['name'];
$ID = $_COOKIE['ID'];
include "../db.php";
//if not logged in redirect to login
if(!$name){
	header('location: ../login/');
}

// get account data
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT * FROM orgs WHERE `org_ID`=".$ID;
$result = mysqli_query($db, $sql);              // create the query object
$num_results=mysqli_num_rows($result);          //How many records meet select
mysqli_close($db); //close the connection
// Fetch the user data
$user=mysqli_fetch_assoc($result);

?>
<!DOCTYPE HTML>
<html>
<head>
   <title>My Resource Connect - <?= $name ?></title>
	<link rel="stylesheet" href="../css/accounts_style.css" type="text/css" />
	<link rel="SHORTCUT ICON" href="../images/logo.png">
</head>
<body>
<img height="150" src="../images/logo.jpg" alt="My Resource Connect" /><br>
<div class="loginsettings">
    <div class="mediumtext"><?= $name ?> Profile</div>
    <a class="thinbtn" href="change_password.php">Change my password</a>
    <a class="thinbtn" href="change_username.php">Edit my user name</a>
    <?= $user['org_name'] ?>
    <a class="thinbtn" href="change_email.php">Change my Email</a>
    <?= $user['org_email'] ?>
    <a class="thinbtn" href="log_out.php" >Log Out</a>
</div>
</body>
</html>