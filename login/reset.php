<?php
// establish default time for the server
date_default_timezone_set('America/New_York');
$message = $_REQUEST['message'];
if(!$message){
    $message = "Please check your email for your temporary password.<br>If you didn't receive an email, be sure to check your spam folder.";
}
?>
<!DOCTYPE HTML>

<html>

<head>
  <title>Homeport Password Reset</title>
  <link rel="stylesheet" type="text/css" href="../css/sign_in.css">
  <script language="javascript" src="../js/reset.js"></script>
</head>

<body>
    <?php include('../page_elements/top_bar.php'); ?>
    <div>
        <?php if($message){ ?>
        <div class="error"><span class="icon-warning red"></span><?= $message ?></div>
        <?php } ?>
    </div>
    <div id="error"></div>

<div class="loginformcontainer">
    <span class="largetext">Fill in all fields to reset your password.</span><br>
    <span class="smalltext">*Passwords are case sensitive.*</span>
    <form id="resetForm" action="process_reset.php" method="post">
        <div class="inputwrapper">
        Account email: <input onkeyPress="checkForReturn(event)" id="email" name="email" > <br>
        Temporary password: <input onkeyPress="checkForReturn(event)" id="pw0" type="password" name="pw0" ><br>
        New password: <input onkeyPress="checkForReturn(event)" id="pw1" type="password" name="pw1" ><br>
        Re-Type password: <input onkeyPress="checkForReturn(event)" id="pw2" type="password" name="pw2" ><br>
        </div>
        <div><a class="createbtn" onclick="validateForm()">Reset</a></div><br>
    </form>
</div>

</body>
</html>