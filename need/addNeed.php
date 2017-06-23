<?php
// need/addNeed.php
$name = $_COOKIE['name'];
$ID = $_COOKIE['ID'];
$message = $_REQUEST['message'];

include "../db.php";

$subCat = $_REQUEST['subcat'];


//get subcats
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT * FROM `subcat`
        LEFT JOIN `cats`
        ON `subcat`.`cat_ID` = `cats`.`cat_ID`
        WHERE `subcat`.`subcat_ID`=".$subCat;
        
$result = mysqli_query($db, $sql); 			// create the query object
mysqli_close($db); 								//close the connection
if($result){
	$subCat = mysqli_fetch_assoc($result);
} 
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Post a new need for: <?= $name ?></title>

  <!-- 
  		This is needed for the calendar
  		Date: <input name="theDate" type="text" id="datepicker"> <--Put this in your HTML
  -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker(); 
  } );
  </script>
<!-- End Calendars -->

</head>
<body>
<?= $name ?><br></br>
Post a new need for <?= $subCat['subcat_name']; ?><br>
<form action="processAddNeed.php" method="post">
Give your need a title: <input type="text" name="need_title"><br>
Describe your need:
<textarea name="need_description"></textarea></br>
The date this need will expire: <input name="theDate" type="text" id="datepicker"><br>
<input type="submit" value="Post Your Need">

</form>
</body>
</html>