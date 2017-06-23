<?php
$name = $_COOKIE['name'];
$ID = $_COOKIE['ID'];
$message = $_REQUEST['message'];

include "../db.php";
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
        
$result = mysqli_query($db, $sql); 			// create the query object
mysqli_close($db); //close the connection
if($result){
	$subCatCount=mysqli_num_rows($result); //How many records meet select
	for($i = 0; $i < $subCatCount; $i++){
	   $subCat[$i] = mysqli_fetch_assoc($result);
	}
}  
?>
<!DOCTYPE HTML>
<html>
<head>
   <title>My Resource Connect</title>
	<link rel="stylesheet" href="../css/style.css" type="text/css" />
	<link rel="SHORTCUT ICON" href="../images/logo.png">
</head>
<body>
<a href="../index.php"><img height="50" src="../images/logo.jpg" alt="My Resource Connect" /></a><br>
Post A Need
<hr width="900px"><br>
Please select a category or click
<a href="../account/" title="<?= $name ?>" >here</a> to cancel.
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
</body>
</html>