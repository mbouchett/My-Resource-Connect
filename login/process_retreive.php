<?php
// establish default time for the server
date_default_timezone_set('America/New_York');
include_once "../db.php";
// This function generates a random password of size $x
function passGen($x){
    $pw = "";
    for($i = 0; $i < $x; $i++){
        $pw .= chr(rand(33,126));
    }
    return $pw;
}

//Get variables posted from the forgot_password.php form
$email = $_POST['email'];
$date = date('Y-m-d');

// check to see if the user exists
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "SELECT `email`, `name`, `password` FROM web_customers WHERE `email` = '".$email."'";
$result = mysqli_query($db, $sql);              // create the query object
$num_results=mysqli_num_rows($result);          //How many records meet select
mysqli_close($db); //close the connection

// check to see if email does not exist
if($num_results < 1){
    header('Location: sign_in.php?message=No account exists for this email.');
    die;
}

// Fetch the user data
$user=mysqli_fetch_assoc($result);

// reset the password
$pw = passGen(8); // this is a temp password sent for reset

//hash the password
$password=crypt($pw, '$2a$bugger$');

//Update the database
$db= new mysqli('localhost', $db_user, $db_pw, $db_db);
$sql = "UPDATE `hp_data`.`web_customers` SET `password` = '".$password."' WHERE `web_customers`.`email` = '".$email."'";
$result = mysqli_query($db, $sql);              // create the query object
mysqli_close($db); //close the connection

// compose email
$sender = "Homeport - Burlington, VT";

$finalStory = '<br />Your temporary password is: '.$pw.
'<br /><br />Follow the link below to login'.
'<br /><br /><a href="http://www.rockingbones.com/hp/login/reset.php">http://www.rockingbones.com/hp/login/reset.php</a>'.
'<br />-Thank You';

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
$headers .= 'From: '.$sender."\r\n";
$headers .= 'Reply-To: home@homeportonline.com'."\r\n";

// Send the email
mail($email,'Homeport Password Reset '.$po,$finalStory,$headers);

// redirect to ...
header('Location: reset.php');
?>