<?php
$name = $_COOKIE['name'];
$ID = $_COOKIE['ID'];
$message = $_REQUEST['message'];

include "../txt/3731035";
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
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT * FROM `subcat`
        LEFT JOIN `cats`
        ON `subcat`.`cat_ID` = `cats`.`cat_ID`
        ORDER BY `subcat`.`subcat_name`";
        
$result = mysqli_query($db, $sql); 			// create the query object
mysqli_close($db); //close the connection
if($result){
	$subCatCount=mysqli_num_rows($result); //How many records meet select
	for($i = 0; $i < $subCatCount; $i++){
	   $subCat[$i] = mysqli_fetch_assoc($result);
	}
}  

// load past needs
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT * FROM `needs`
        LEFT JOIN `orgs`
        ON `needs`.`org_ID` = `orgs`.`org_ID`
        WHERE `needs`.`org_ID`=".$ID." 
        ORDER BY `needs`.`need_date` DESC
        LIMIT 25";
        
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
<!DOCTYPE HTML>
<html>
<head>
   <title>My Resource Connect</title>
	<link rel="stylesheet" href="../css/style.css" type="text/css" />
	<link rel="SHORTCUT ICON" href="../images/icon.png">
	
<script type="text/javascript">
function deleteItem(itemNum) {
	if (confirm("This action cannot be undone\n Cancel or OK to delete item")) {
		window.location.href = 'processDeleteNeed.php?need=' + itemNum;
	}
}
</script>	
	
</head>
<body>
<a href="../index.php"><img height="150" src="../images/logo.png" alt="My Resource Connect" /></a><br>
Post A Need
<hr width="900px"><br>
Please select a category or click
<a href="../account/" title="<?= $name ?>" >here to cancel.</a>
<br>
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
					<a href="addNeed.php?subcat=<?= $subCat[$ii]['subcat_ID']?>"><?= $subCat[$ii]['subcat_name'] ?></a><br>
					<?php }  } ?>				
					</td>
				</tr>							
			</table>		
		<?php } ?>				
</div><br>
<hr width="900px">
<?php if($name){ ?>
<span style="font-size: 10px;">Currently Logged In As: <?= $name ?><a href="../account/log_out.php"> (not you?)</a>
<?php }?>
</span>
<hr>
Past Needs<br>
<table>
	<tr><td>Re-Post</td><td>Needed</td><td>Title</td><td>Description</td><td>Needed By</td><td>Pleged By</td><td>Pleged On</td><td>Remove</td></tr>
	<?php for($i=0; $i<$needsCount; $i++){ ?>
	<tr>
		<td><input type="button" value="Re-Post" /></td>
		<td><?= substr($need[$i]['need_date'],0,10) ?></td>
		<td><?= $need[$i]['need_title'] ?></td>
		<td title="<?= $need[$i]['need_description'] ?>"><?= substr($need[$i]['need_description'], 0, 30)?>...</td>
		<td><?= $need[$i]['need_by'] ?></td>
		<td><?= $need[$i]['pledge_by'] ?></td>
		<td><?= $need[$i]['pledge_date'] ?></td>
		<td><input type="button" value="Remove" onclick="deleteItem(<?= $need[$i]['need_ID'] ?>)" /></td>
	</tr>
	<?php }?>
</table>
</body>
</html>
