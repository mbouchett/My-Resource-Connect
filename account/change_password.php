<?php
// Get the cookies
$customerID = $_COOKIE['customerID'];
$name = $_COOKIE['name'];
include "../db.php";

//if not logged in redirect to login
if(!$name){
	header('location: ../login/');
}

// get any error message
$message = $_REQUEST['message'];
?>
<!DOCTYPE HTML>

<html>

<head>
  <title>Change Password: <?= $name ?></title>
  <link rel="stylesheet" type="text/css" href="../css/sign_in.css">
  <script language="javascript" src="../js/change_password.js"></script>
</head>

<body>
<div>
    <?php if($message){ ?>
    <div class="error"><span class="icon-warning red"><?= $message ?></span></div>
    <?php } ?>
</div>
<div id="error"></div><br>

<div class="loginformcontainer">
    <span class="largetext">Fill in all fields to reset your password.</span><br>
    <span class="smalltext">*Passwords are case sensitive.*</span>
<form id="changePassword" action="process_change_password.php" method="post">
    <div class="inputwrapper">
        Old Password: <input id="pw0" type="password" name="pw0" ><br>
        New Password: <input onkeyPress="checkForReturn(event)" id="pw1" type="password" name="pw1" ><br>
        Verify Password: <input onkeyPress="checkForReturn(event)" id="pw2" type="password" name="pw2" ><br>
    </div>
    <div><a class="createbtn" onclick="validateForm()">Reset Password</a></div><br>
</form>
 <a class="loginbtn" href="index.php">Cancel Password Change</a><br><br>
</div>

</body>

</html>

