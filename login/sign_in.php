<?php
// establish default time for the server
date_default_timezone_set('America/New_York');
include_once "../db.php";
$message = $_REQUEST['message'];

?>
<!DOCTYPE HTML>

<html>

<head>
  <title>MyResourceConnect Sign In</title>
    <link rel="shortcut icon" href="../images/hp_compass.ico">

    <link rel="stylesheet" type="text/css" href="../css/sign_in.css">
  <script language="javascript" src="../js/sign_in.js"></script>
</head>

<body>
<div>
    <?php if($message){ ?>
    <div class="error"><span class="icon-warning red"></span><?= $message ?></div>
    <?php } ?>
</div>
<div>
    <div id="error"></div>
</div>

<div class="loginformcontainer">
    <span class="largetext">Sign In To MyResourceConnect!</span>
    <form id="loginForm" action="process_sign_in.php" method="post">
    <div class="inputwrapper">
        Email: <span><input onkeyPress="checkForReturn(event)" id="email" name="email" ></span> <br>
        Password: <input onkeyPress="checkForReturn(event)" id="pw" type="password" name="pw" ><br>
    </div>
    <div>
        <a class="loginbtn" onclick="validateForm()">Login</a>
    </div>
    </form><br>
     <div class="smalltext godown">New to MyResourceConnect?</div>
    <div>
        <a class="createbtn" href="create_account.php">Create A New Account</a>
		  <a class="createbtn" href="../index.php">Cancel</a>
    </div>
        <br>
    <span class="smalltext"><a class="simplelink" href="forgot_password.php">Forgot your password?</a></span>

</div>

</body>
</html>