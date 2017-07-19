<?php
// Get the cookies
    $ID = $_COOKIE['ID'];
    $name = $_COOKIE['name'];
include "../txt/3731035";

//if not logged in redirect to login
if(!$name){
	header('location: ../login/');
}

// get any error message
$message = $_REQUEST['message'];

// get account data
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);;
$sql = "SELECT `org_email`, `org_pw`, `org_name`, `org_ID` FROM orgs WHERE `org_ID` =".$ID;
$result = mysqli_query($db, $sql);              // create the query object
$num_results=mysqli_num_rows($result);          //How many records meet select
mysqli_close($db); //close the connection
// Fetch the user data
$user=mysqli_fetch_assoc($result);

?>
<!DOCTYPE HTML>

<html>

<head>
  <title>Change Email Address: <?= $name ?></title>
  <link rel="stylesheet" type="text/css" href="../css/sign_in.css">
  <script language="javascript" src="../js/change_email.js"></script>
</head>

<body>

<div>
    <?php if($message){ ?>
    <div class="error"><span class="icon-warning red"></span><?= $message ?></div>
    <?php } ?>
</div>
<div id="error"></div><br>

<div class="loginformcontainer">
    <span class="largetext">Choose a new email address.</span><br>
<form id="changeEmail" action="process_change_email.php" method="post">
    <div class="inputwrapper">
        New Email Address: <input onkeyPress="checkForReturn(event)" id="email" name="email" ><br>
    </div>
    <div><a class="createbtn" onclick="validateForm()">Update Email Address</a></div><br>
</form>
<a class="loginbtn" href="index.php">Cancel Update Email Address</a><br><br>
</div>

</body>

</html>

