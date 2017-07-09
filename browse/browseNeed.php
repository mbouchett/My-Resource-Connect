<?php
// need/addNeed.php
$name = $_COOKIE['name'];
$ID = $_COOKIE['ID'];
$type = $_COOKIE['type'];
$message = $_REQUEST['message'];
include "../db.php";
$subcat = $_REQUEST['subcat'];

// load needs
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
if($subcat) {
	$sql = "SELECT * FROM `needs`
	     LEFT JOIN `subcat`
	     ON `needs`.`subcat_ID` = `subcat`.`subcat_ID`
	     WHERE `needs`.`subcat_ID`=".$subcat." 
	     ORDER BY `needs`.`need_date` DESC
	     LIMIT 50";
}else{
	$sql = "SELECT * FROM `needs`
	     LEFT JOIN `subcat`
	     ON `needs`.`subcat_ID` = `subcat`.`subcat_ID` 
	     ORDER BY `needs`.`need_date` DESC
	     LIMIT 50";
}
        
$result = mysqli_query($db, $sql); 						// create the query object
mysqli_close($db); 											//close the connection
if($result){
	$needsCount=mysqli_num_rows($result); 				//How many records meet select
	//Store the Results To A Local Array
	for($i=0; $i<$needsCount; $i++){         			//Iniate The Loop
		$need[$i] = mysqli_fetch_assoc($result);   	//Fetch and save The Current Record
	}                                           		//Close The Loop
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Browse <?= $need[0]['subcat_name'] ?></title>

  <!-- 
  		This is needed for the calendar
  		Date: <input name="theDate" type="text" id="datepicker"> <--Put this in your HTML
  -->
  
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <link rel="stylesheet" href="../css/need_style.css" type="text/css" />
  <link rel="SHORTCUT ICON" href="../images/icon.png">
  
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker(); 
  } );
  </script>
<!-- End Calendars -->

<!-- Temporary Style Sheet -->
<style>
td{border: black thin solid;}
</style>

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
<span style="font-size: 10px;">Currently Logged In As: <?= stripslashes($name) ?><a href="account/log_out.php"> (not you?)</a></span>
<?php } ?>
<?php }else{ ?>
<a href="login/sign_in.php" >Sign In</a>
<?php } ?>
<hr width="900px">
<!-- end header portion -->

Needs<br>
<table>
	<tr><td>Needed</td><td>Title</td><td>Description</td><td>Needed By</td><td>Pledge</td></tr>
	<?php for($i=0; $i<$needsCount; $i++){ ?>
	<tr>
		<td><?= substr($need[$i]['need_date'],0,10) ?></td>
		<td><?= $need[$i]['need_title'] ?></td>
		<td><textarea name="description" rows="3" cols="50" readonly><?= $need[$i]['need_description'] ?></textarea></td>
		<td><?= $need[$i]['need_by'] ?></td>
		<td>
			<?php if($name){ ?> 
			<input type="button" value="Pledge" onclick="parent.location='pledge.php?need=<?= $need[$i]['need_ID'] ?>'" />
			<?php }else { ?>
			<a href="../login/sign_in.php" >Sign In</a>
			<?php } ?>		
		</td>
	</tr>
	<?php }?>
</table>
	<hr width="900px">
	<button type="submit" onClick="history.go(-1)">Cancel And Return</button>
</body>
</html>
