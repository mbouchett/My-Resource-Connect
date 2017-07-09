<?php
include "../db.php";
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
	$need = mysqli_fetch_assoc($result);   	//Fetch and save The Current Record                                         		//Close The Loop
}

// load donor
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
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
 
<?php if($type == "org") { ?> 
<br> <a href="need/" >Post A Need</a> <br>
<span style="font-size: 10px;">Currently Logged In As: <?= stripslashes($name) ?><a href="account/log_out.php"> (not you?)</a>
<a href="accountType.php" title="<?= $name ?>" >My Account</a>
<?php } ?>
<?php if($type == "donor") { ?> 
<br>
<span style="font-size: 10px;">Currently Logged In As: <?= stripslashes($name) ?><a href="account/log_out.php"> (not you?)</a>
<?php } ?>
<?php }else{ ?>
<a href="login/sign_in.php" >Sign In</a>
<?php } ?>
<hr width="900px">
<!-- end header portion -->

<?= $need['org_name'] ?><br>
<?= $need['need_title'] ?><br>
<hr width="900px">
<?= $need['need_description'] ?>
<hr width="900px">
<?= $name ?> is ready to help you out!<br>
<form action="processPledge.php" method="POST">
	Message to the organization:<br>
	<textarea name="message" rows="7" cols="70" placeholder="Please incluse any message, comments or questions associated with your pledge">
	</textarea><br>
	<button value="I can do this!" type="submit">I can do this!</button>
</form>
<hr width="900px">
<form action="processQuestion.php" method="POST">
	I have a question about this need.<br>
	<textarea name="message" rows="7" cols="70" placeholder="Enter your question about this need here.">
	</textarea><br>
	<button value="I can do this!" type="submit">Send this question to the organization</button>
</form>
</body>
</html>