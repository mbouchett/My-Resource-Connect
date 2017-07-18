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
$sql = "SELECT `donor_email`, `donor_pw`, `donor_name`, `donor_ID` FROM donors WHERE `donor_ID` =".$ID;
$result = mysqli_query($db, $sql);              // create the query object
$num_results=mysqli_num_rows($result);          //How many records meet select
mysqli_close($db); //close the connection
// Fetch the user data
$user=mysqli_fetch_assoc($result);

?>
<!DOCTYPE HTML>

<html>

<head>
  <title>Change User Name: <?= $name ?></title>
  <link rel="stylesheet" type="text/css" href="../css/sign_in.css">
  <script language="javascript" src="../js/change_username.js"></script>
</head>

<body>
<div>
    <?php if($message){ ?>
    <div class="error"><span class="icon-warning red"></span><?= $message ?></div>
    <?php } ?>
</div>
<div id="error"></div><br>

<div class="loginformcontainer">
    <span class="largetext">Choose a new User Name</span><br>
<form id="changeUsername" action="process_change_username.php" method="post">
    <div class="inputwrapper">
        New Username: <input onkeyPress="checkForReturn(event)" id="name" name="name" ><br>
    </div>
    <div><a class="createbtn" onclick="validateForm()">Update User Name</a></div><br>
</form>
<a class="loginbtn" href="index.php">Cancel Update User Name</a><br><br>
</div>

</body>

</html>

