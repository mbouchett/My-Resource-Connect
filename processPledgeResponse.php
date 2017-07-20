<?php 
// processPledgeResponse.php
include "txt/3731035";

$d = $_REQUEST['donor'];
$n = $_REQUEST['need'];
$pr = $_REQUEST['pr'];

//range check the REQUEST data
if($pr < 0 || $pr > 4 || !$pr){
	header('location: index.php');
	die;
}
if(!is_numeric($d) || !is_numeric($n)) {
	header('location: index.php');
   die;
}

//pr=1">Accept and close the need
if($pr == 1) {
	// update the database
	
	// email the donor
	header('location: pledgeResponse.php?msg="Pledge Accepted - Need Closed&donor='.$d.'&need='.$n);
	die;
}

//pr=2">Accept and keep the need open
if($pr == 2) {
	// email the donor
	
	header('location: pledgeResponse.php?msg="Pledge Accepted - Need Retained&donor='.$d.'&need='.$n);
	die;
}

//pr=3">Reject and close the need
if($pr == 3) {
	// update the database
	
	// email the donor
	header('location: pledgeResponse.php?msg="Pledge Declined - Need Closed&donor='.$d.'&need='.$n);
	die;
}

//pr=4">Reject and keep the need open
if($pr == 4) {
	// email the donor
	
	header('location: pledgeResponse.php?msg="Pledge Declined - Need Retained&donor='.$d.'&need='.$n);
	die;
}

header('location: index.php');
?>