<?php
try{
session_start();
/**
* for a 30 minute timeout, specified in seconds 1800==30min
*/
$timeout_duration = 5;
// //local
// $servername = "localhost";
// $username = "root";
// $password = "";
// $db="AUTH_DB";
// //local
//live
$servername = "sql301.move.pk";
$username = "mov_23834279";
$password = "Pampalak";
$db="mov_23834279_notepad";
//live

$_SESSION["LOGIN_ERROR"]='';
$_SESSION["LOGGED_IN"]='FALSE';
$_USERNAME=$_POST["U_NAME"];
$_PASSWORD=$_POST["U_PASS"];

if(is_null($_USERNAME)||$_USERNAME==''){
    $_SESSION["LOGIN_ERROR"]='Username is empty.';

    header('Location: ./');
    return;
}
if(is_null($_PASSWORD)||$_PASSWORD==''){
    $_SESSION["LOGIN_ERROR"]='Password is empty.';
    header('Location: ./');
}

// Create connection
$conn = new mysqli($servername, $username, $password,$db);

// Check connection
if ($conn->connect_error) {
    header('Location: ./');
}

$sql = "SELECT * FROM `user` WHERE `USERNAME`='".$_USERNAME."' and `PASSWORD` COLLATE latin1_general_cs='".$_PASSWORD."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $_SESSION["LOGGED_IN"]='TRUE';    
    $_SESSION['LAST_ACTIVITY'] = $_SERVER['REQUEST_TIME'];
    header('Location: ./');

} else {
    $_SESSION["LOGIN_ERROR"]='Username or password is not correct';
    header('Location: ./');
    echo 'yes';
}
$conn->close();
}catch(Exception $e){
  header('Location: ./');
}
?>
