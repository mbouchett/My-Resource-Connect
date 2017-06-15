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
	</head>
	<body>
	<a href="manageCats.php">Manage Categories</a>
	</body>
</html>