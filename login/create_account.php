<?php
// establish default time for the server
date_default_timezone_set('America/New_York');
include_once "../txt/3731035";
$message = $_REQUEST['message'];
?>
<!DOCTYPE HTML>

<html>

<head>
  <title>Create New MyResourceConnect Account</title>
  <link rel="stylesheet" type="text/css" href="../css/sign_in.css">
  <script language="javascript" src="../js/create_account.js"></script>
</head>

<body>
  <div>
    <?php if($message){ ?>
    <div class="error"><?= $message ?></div>
    <?php } ?>
  </div>
  <div>
    <div id="error"></div>
  </div>

  <div class="loginformcontainer">
  <span class="largetext">Create Your Login!</span>
    <form id="createAccountForm" action="process_create_account.php" method="post">
	 Account Type: 
	 <select id="actType" name="type" onchange="accountType();" >
	 	<option value="-" selected>Please Select</option>
		<option value="donor">Donor Account</option>
		<option value="org">Charitable Orginization</option>
	 </select><br><br>
        <div class="inputwrapper">
            Name:<input onkeyPress="checkForReturn(event)" id="name" name="name"><br>
            Email:<input onkeyPress="checkForReturn(event)" id="email" name="email"><br>
            <div id="telephone" >Telephone: <input onkeyPress="checkForReturn(event)" id="phone" name="phone" placeholder="(555) 555-1212"><br></div>
            <div id="einField" >EIN: <input onkeyPress="checkForReturn(event)" id="ein" name="ein"><br></div>
            Password: <span class="smalltext">*Must contain at least 1 uppercase letter at least 1 number and be at least 8 characters in length*</span><br>
            Enter Password: <input onkeyPress="checkForReturn(event)" id="pw" name="pw" type="password"><br>
            Verify Password: <input onkeyPress="checkForReturn(event)" id="pw2" type="password" name="pw2" ><br>
        </div>
        <br><br>
        <div>
        <a class="createbtn" onclick="validateForm()">Create Your MyResourceConnect Account</a>
        </div>
    </form>
    <br>
    <div>Already Have An Account?&nbsp;&nbsp;<a class="loginbtn" href="sign_in.php">Sign In</a></div><br>
  </div>
</body>

</html>