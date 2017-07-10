<?php
// need/addNeed.php
$name = $_COOKIE['name'];
$ID = $_COOKIE['ID'];
$message = $_REQUEST['message'];
include "../db.php";
$subcat = $_REQUEST['subcat'];

//get subcats
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT * FROM `subcat`
        LEFT JOIN `cats`
        ON `subcat`.`cat_ID` = `cats`.`cat_ID`";
        
$result = mysqli_query($db, $sql); 			// create the query object
mysqli_close($db); 	
							//close the connection
if($result){
	$catsCount = mysqli_num_rows($result); //How many records meet select
	for($i=0; $i<$catsCount; $i++) {
		$subCats[$i] = mysqli_fetch_assoc($result);
		if($subCats[$i]['subcat_ID'] == $subcat) {
			$subCatName = $subCats[$i]['subcat_name'];
		}
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

<!DOCTYPE html>
<html><head>
<meta charset="utf-8" />
<title>Post a new need for: <?= $name ?></title>

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
<a href="../index.php"><img height="150" src="../images/logo.png" alt="My Resource Connect" /></a><br></br>

<div>
    <?php if($message){ ?>
    <div class="error"><span class="icon-warning red"><?= $message ?></span></div>
    <?php } ?>
</div>

<span class="orgname"><?= $name ?></span>

<div>Post a new need for: <?= $subCatName ?></div><br>
<div class="logn">
	<form name="addneed" action="processAddNeed.php" method="post">
	Give your need a title: <input type="text" name="need_title"><br><br>
	Describe your need:
	<textarea name="need_description"></textarea></br><br>
	The date this need will expire: <input class="datebox" default="ASAP" name="need_by" type="text" id="datepicker"><br><br>
	<a onClick="document.addneed.submit()" class="thinbtn" type="submit">Add Need</a>
   <a href="../account" class="thinbtn" type="submit">Cancel</a>               		
	<input type="hidden" name="subcat_ID" value="<?= $subcat ?>" />
	</form>
</div>
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
		<td><input type="button" value="Remove" onclick="parent.location='processDeleteNeed.php?need=<?= $need[$i]['need_ID'] ?>'" /></td>
	</tr>
	<?php }?>
</table>
</body>
</html>
