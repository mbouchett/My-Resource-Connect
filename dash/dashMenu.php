<?php
/*resume the user session or return user to login*/
session_start();
if(!isset($_SESSION['username'])){
	header('location: index.php');
	die;
}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>MyResourceConnect - Dashboard Menu</title>
		<link rel="SHORTCUT ICON" href="../images/logo.png">
		<link rel="stylesheet" href="../css/accounts_style.css" type="text/css" />

	</head>
	<body>
	<img id="logo" height="150" src="../images/logo.jpg" alt="My Resource Connect" /><br><br>
<div class="logn">
	<a class="thinbtn" href="manageCats.php">Manage Categories</a><br>
	<a class="thinbtn" href="logout.php" >Logout</a>
</div>	
	</body>
</html>