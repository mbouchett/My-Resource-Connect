<?php
$name = $_COOKIE['name'];
$ID = $_COOKIE['ID'];
$type = $_COOKIE['type'];

include "db.php";
// get categories
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = 'SELECT * FROM `cats` ORDER BY `cat_name`';
$result = mysqli_query($db, $sql); 						//Create the query object
mysqli_close($db);
if($result){
	$numResults=mysqli_num_rows($result); 				//How many records meet select 										//close the connection
	//Store the Results To A Local Array
	for($i=0; $i<$numResults; $i++){         		//Iniate The Loop
		$cats[$i] = mysqli_fetch_assoc($result);   	//Fetch and save The Current Record
	}                                           		//Close The Loop
	$catCount=count($cats);
}

//get subcats
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT * FROM `subcat`
        LEFT JOIN `cats`
        ON `subcat`.`cat_ID` = `cats`.`cat_ID`
        ORDER BY `subcat`.`subcat_name`";
        
$message = $_REQUEST['message'];

$result = mysqli_query($db, $sql); 			// create the query object
mysqli_close($db); //close the connection
if($result){
	$subCatCount=mysqli_num_rows($result); //How many records meet select
	for($i = 0; $i < $subCatCount; $i++){
	   $subCat[$i] = mysqli_fetch_assoc($result);
	}
}  

/* **************Load the 10 most recent needs************** */
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);

	$sql = "SELECT `needs`.`need_ID`, `needs`.`org_ID`, `needs`.`need_date`, 
		   `needs`.`need_title`, `needs`.`need_description`, `orgs`.`org_name`	
		  FROM `needs`
	     LEFT JOIN `orgs` ON `needs`.`org_ID` = `orgs`.`org_ID` 
	     ORDER BY `needs`.`need_date` DESC
	     LIMIT 10";
        
$result = mysqli_query($db, $sql); 						// create the query object
mysqli_close($db); 											//close the connection
if($result){
	$needsCount=mysqli_num_rows($result); 				//How many records meet select
	//Store the Results To A Local Array
	for($i=0; $i<$needsCount; $i++){         			//Iniate The Loop
		$need[$i] = mysqli_fetch_assoc($result);   	//Fetch and save The Current Record
	}                                           		//Close The Loop
}
/* **************end Load the 10 most recent needs************** */

?>
<!DOCTYPE HTML>
<html>
<head>
   <title>My Resource Connect</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" />
	<link rel="SHORTCUT ICON" href="images/icon.png">
</head>
<body>
<img height="150" src="images/logo.png" alt="My Resource Connect" title="<?= $type ?>" /><br>
Find out what's needed in your area and how YOU can help.
<?php if($name){ ?> 
 <a href="accountType.php" title="<?= $name ?>" >My Account</a>
<?php if($type == "org") { ?> 
<br> <a href="need/" >Post A Need</a> <br>
<span style="font-size: 10px;">Currently Logged In As: <?= stripslashes($name) ?><a href="account/log_out.php"> (not you?)</a></span>
<?php } ?>
<?php if($type == "donor") { ?> 
<br>
<span style="font-size: 10px;">Currently Logged In As: <?= stripslashes($name) ?><a href="account/log_out.php"> (not you?)</a></span>
<?php } ?>
<?php }else{ ?>
<a href="login/sign_in.php" >Sign In</a>
<?php } ?>
<hr width="900px"><br>
<div class="frontpage">
		<?php for($i = 0; $i < $catCount; $i++){ ?>
			<table class="tableCol">
				<tr>
					<td class="title">
					<?= $cats[$i]['cat_name'] ?><hr>					
					</td>
				</tr>
				<tr>
					<td class = "category">
					<?php 
						for($ii = 0; $ii < $subCatCount; $ii++){ 
							if($subCat[$ii]['cat_ID'] == $cats[$i]['cat_ID']) {			
					?>
					<a href="browse/browseNeed.php?subcat=<?= $subCat[$ii]['subcat_ID']?>"><?= $subCat[$ii]['subcat_name'] ?></a><br>
					<?php }  } ?>				
					</td>
				</tr>							
			</table>		
		<?php } ?>				
</div><br>
<hr width="900px">
<div class="needhdr">What is needed right now!</div>
<table>
	<tr class="tblhdr"><td>Needed</td><td>Organization</td><td>Title</td><td>Description</td><td>Pledge</td></tr>
	<?php for($i=0; $i<$needsCount; $i++){ ?>
	<tr>
		<td><?= substr($need[$i]['need_date'],0,10) ?></td>
		<td><?= $need[$i]['org_name'] ?></td>
		<td class="needttl"><?= $need[$i]['need_title'] ?></td>
		<td><textarea name="description" rows="3" cols="50" readonly><?= $need[$i]['need_description'] ?></textarea></td>
		<td>
			<?php if($type == "donor"){ ?> 
			<input type="button" value="Pledge" onclick="parent.location='browse/pledge.php?need=<?= $need[$i]['need_ID'] ?>'" />
			<?php }else { ?>
			<a href="login/sign_in.php" title="Must Be Signed In With A DOnor Account" >Sign In</a>
			<?php } ?>
		</td>
	</tr>
	<?php }?>
</table>
<hr width="900px">
<?php if($name){ ?>

<?php }?>
</span>
</body>
</html>