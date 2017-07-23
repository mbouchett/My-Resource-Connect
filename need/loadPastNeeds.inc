<?php
$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
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
	}  
	
	$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
	for($i=0; $i<$needsCount; $i++){         			//Iniate The Loop
		if($need[$i]['pledge_by']) {
			$db = new mysqli('localhost', $db_user, $db_pw, $db_db);
			$sql = "SELECT `donor_name`, `donor_email` FROM `donors` WHERE `donor_ID` = ".$need[$i]['pledge_by'];
			$result = mysqli_query($db, $sql);
			if($result){
				$dname = mysqli_fetch_assoc($result);
				$need[$i]['donor_name'] = $dname['donor_name'];
				$need[$i]['donor_email'] = $dname['donor_email'];
			}
		}
		mysqli_close($db);
	}	
}
?>