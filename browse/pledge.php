<?php
include "../txt/3731035";
$name = $_COOKIE['name'];
$ID = $_COOKIE['ID'];
$type = $_COOKIE['type'];
$need_ID = $_REQUEST['need'];

if(!$ID) {
	header('location: ../login/sign_in.php');	
}

// load need
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT `needs`.`need_ID`, `needs`.`org_ID`, `needs`.`need_date`, 
		   `needs`.`need_title`, `needs`.`need_description`, `orgs`.`org_name`	
		  FROM `needs`
	     LEFT JOIN `orgs` ON `needs`.`org_ID` = `orgs`.`org_ID` 
	     WHERE `needs`.`need_ID`=".$need_ID;
     
$result = mysqli_query($db, $sql); 						// create the query object
mysqli_close($db); 											//close the connection
if($result){
	$need = mysqli_fetch_assoc($result);   	//Fetch and save The Current Record 
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
	<link rel="stylesheet" href="../css/pledge_style.css" type="text/css" />
	<link rel="SHORTCUT ICON" href="../images/icon.png">
<title>Pledge</title>
</head>
<body>

<!-- header portion -->
<a href="../index.php"><img height="150" src="../images/logo.png" alt="My Resource Connect" /></a><br></br>

<div>
    <?php if($message){ ?>
    <div class="error"><span class="icon-warning red"><?= $message ?></span></div>
    <?php } ?>
</div>
<?php if($name){ ?> 
<div class="user">  
	<?php if($type == "org") { ?>
	<br> <a href="need/" >Post A Need</a> <br>
	Currently Logged In As: <?= stripslashes($name) ?><a href="account/log_out.php"> (not you?)</a>
	<a href="accountType.php" title="<?= $name ?>" >My Account</a>
	<?php } ?>
	<?php if($type == "donor") { ?> 
	<br>
	Currently Logged In As: <?= stripslashes($name) ?><a href="account/log_out.php"> (not you?)</a>
	<?php } ?>
	<?php }else{ ?>
	<a href="login/sign_in.php" >Sign In</a>
	<?php } ?>
</div>
<hr width="900px">
<!-- end header portion -->

	<!-- I'm Making A Pledge -->
<div class="container">
	<span class="orgttl"><?= $need['org_name'] ?></span><br>
	<?= $need['need_title'] ?><br>
	<hr width="900px">
	<?= $need['need_description'] ?>
	<hr width="900px">
	<?= $name ?> is ready to help you out!<br>
	<form action="processPledge.php" method="POST">
		Message to the organization:<br>
		<textarea name="message" rows="7" cols="70" placeholder="Please incluse any message, comments or questions associated with your pledge. ***not required***"></textarea><br>
		<button value="I can do this!" type="submit">I can do this!</button>
		<input type="hidden" name="donor_ID" value="<?= $ID ?>" />
		<input type="hidden" name="need_ID" value="<?= $need['need_ID'] ?>" />
	</form>
	<hr width="900px">
	
	<!-- I have A Question -->
	<form action="processQuestion.php" method="POST">
		I have a question about this need.<br>
		<textarea name="question" rows="7" cols="70" placeholder="Enter your question about this need here."></textarea><br>
		<button type="submit">Send this question to the organization</button>
		<input type="hidden" name="donor_ID" value="<?= $ID ?>" />
		<input type="hidden" name="need_ID" value="<?= $need['need_ID'] ?>" />
	</form>
	<hr width="900px">
	<button type="submit" onClick="history.go(-1)">Cancel And Return</button>
</div>	
</body>
</html>