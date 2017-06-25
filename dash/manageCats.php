<?php

/*resume the user session or return user to login*/
session_start();
if(!isset($_SESSION['username'])){
	header('Location: index.php');
	die;
}

// include db credentials  $db_user, $db_pw, $db_db
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
        
$message = $_REQUEST['message'];

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
		<title>MyResourceConnect - Manage Categories</title>
		<link rel="SHORTCUT ICON" href="../images/logo.png">
		<link rel="stylesheet" href="../css/style.css" type="text/css" />
	</head>
	<body>
	<img id="logo" height="150" src="../images/logo.jpg" alt="My Resource Connect" />
<br>
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
					<?= $subCat[$ii]['subcat_name'] ?><br>
					<?php }  } ?>				
					</td>
				</tr>							
			</table>		
		<?php } ?>	
		
		 <!-- Shows only on error -->
		 <?php if($message){ ?>
		 <div class="error"><span class="icon-warning red"></span><?= $message ?></div>
		 <?php } ?>		
 <hr>
		<form method="post" action="processAddSubcat.php">
			<table class="tdForm">
				<tr>
					<td class="tdForm">Sub-Category Name:<input type="text" name="subCatName"></td>
					<td class="tdForm">Belongs To:
						<select name="catID">
						<?php for($i = 0; $i < $catCount; $i++){ ?>
						<option value="<?= $cats[$i]['cat_ID'] ?>" ><?= $cats[$i]['cat_name'] ?></option>
						<?php } ?>
						</select>
					</td>
					<td class="tdForm"><input type="submit" value="Add Category"></td>				
				</tr>			
			</table>
		</form>	
<hr>
	</body>
</html>