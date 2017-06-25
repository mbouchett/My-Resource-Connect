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
        ON `subcat`.`cat_ID` = `cats`.`cat_ID`
        WHERE `subcat`.`subcat_ID`=".$subCat;
        
$result = mysqli_query($db, $sql); 			// create the query object
mysqli_close($db); 								//close the connection
if($result){
	$subCatDat = mysqli_fetch_assoc($result);
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

</head>
<body>
<a href="../index.php"><img height="150" src="../images/logo.png" alt="My Resource Connect" /></a><br></br>

<div>
    <?php if($message){ ?>
    <div class="error"><span class="icon-warning red"><?= $message ?></span></div>
    <?php } ?>
</div>

<span class="orgname"><?= $name ?></span>

<div>Post a new need for: <?= $subCatDat['subcat_name']; ?></div>
<div class="logn">
	<form name="addneed" action="processAddNeed.php" method="post">
	Give your need a title: <input type="text" name="need_title"><br>
	Describe your need:
	<textarea name="need_description"></textarea></br>
	The date this need will expire: <input default="ASAP" name="need_by" type="text" id="datepicker"><br>
	<a onClick="document.addneed.submit()" class="thinbtn" type="submit">Add Need</a>
                    		
	<input type="hidden" name="subcat_ID" value="<?= $subcat ?>" />
	</form>
</div>
</body>
</html>