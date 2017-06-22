<?php
// establish default time for the server
date_default_timezone_set('America/New_York');
$message = $_REQUEST['message'];
?>
<!DOCTYPE HTML>

<html>

<head>
  <title>Retrieve Your Password</title>
  <link rel="stylesheet" type="text/css" href="../css/sign_in.css">
  <script language="javascript" src="../js/forgot_password.js"></script>
</head>

<body>
    <?php
include('../page_elements/top_bar.php');
?>

    <!-- This gets populated by javascript on validation -->
    <div>
      <?php if($message){ ?>
      <div class="error"><?= $message ?></div>
      <?php } ?>
    </div>
    <!-- This gets populated by javascript on validation -->
    <div>
    <div id="error"></div>
    </div>
<div class="loginformcontainer">
<span class="largetext">Forgot Your Password?<br>No Problem!</span><br>
<span class="smalltext">Just give us the Email you used to create the account, and we'll send you a temporary password to log you back in. Once your logged in you'll be prompted to choose a new password.</span>
    <form id="pwReset" action="process_retreive.php" method="post">
    <div class="inputwrapper">
    Email: <input onkeyPress="checkForReturn(event)" id="email" name="email" >
    </div> <br>
        <a class="createbtn" onclick="validateForm()">Retrieve Login</a>
    </form><br>
</div>
</body>
</html>