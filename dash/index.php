<?php 

session_start(); // Resume up your PHP session!
  if(isset($_SESSION['username'])){
    header('location: dashMenu.php');
    die;
  }
  
$message = $_REQUEST['message'];
?>
<!DOCTYPE HTML>
<html>
<head>
   <title>My Resource Connect - Dash</title>
	<link rel="SHORTCUT ICON" href="../images/logo.png">
	<link rel="stylesheet" href="../css/accounts_style.css" type="text/css" />
	
	<!-- Sets the focus tot the user name at load -->
	<script type="text/javascript">
   function setFocus() {
   	document.getElementById("start").focus();
   }
   </script>
</head>
<body onload="setFocus()">
 <!-- Shows only on error -->
 <?php if($message){ ?>
 <div class="error"><span class="icon-warning red"></span><?= $message ?></div>
 <?php } ?>
 
<img id="logo" height="150" src="../images/logo.jpg" alt="My Resource Connect" />
<br><br>
	<div class="logn">
	    <form name="Login" action="processLogin.php" method="post">
	        <table>
	            <tbody>
	                <tr>
	                    <td>User Name</td>
	                    <td><input id="start" name="username" type="text"></td>
	                </tr>
	                <tr>
	                    <td>Password</td>
	                    <td><input value="" id="pw" name="pw" type="password" /></td>
	                </tr>
	                <tr>
	                    <td colspan="2">
	                    <br>
							<a onClick="document.Login.submit()" class="thinbtn" type="submit">Login</a>
                    		<input alt="submit" style="display: none;" type="submit">
	                    </td>
	                </tr>
	            </tbody>
	        </table>
	    </form>
	</div>
</body>
</html>