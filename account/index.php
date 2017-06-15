<?php
$name = $_COOKIE['name'];
$ID = $_COOKIE['ID'];

//if not logged in redirect to login
if(!$name){
	header('location: ../login/');
}
?>
<!DOCTYPE HTML>
<html>
<head>
   <title>My Resource Connect - <?= $name ?></title>
	<link rel="stylesheet" href="css/style.css" type="text/css" />
	<link rel="SHORTCUT ICON" href="images/logo.png">
</head>
<body>

<a href="log_out.php" >Log Out</a>
</body>
</html>