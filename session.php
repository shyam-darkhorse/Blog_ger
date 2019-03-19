<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "blogger";
	
		// Create connection
		$connection = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($connection->connect_error) {
			die("Connection failed: " . $connection->connect_error);
		} 
session_start();// Starting Session
// Storing 

if(!isset($_SESSION['login_user'])){
header('Location: login.php');
}
$user_check=$_SESSION['login_user'];
//$boolorg=$_SESSION['orgcheck'];
// SQL Query To Fetch Complete Information Of User
/*if($boolorg){
	$sql= "SELECT * from organizer where rollnumber='$user_check'";
	$result = $connection->query($sql) or die ($connection->error);
	$row = $result->fetch_assoc();
	$logorg =$row['orgid'];
if(!isset($logorg)){
mysql_close($connection); // Closing Connection
header('Location: /tech_community/login/login.php'); // Redirecting To Home Page
}

}else*/

$sql = "SELECT user_id from user where user_id='$user_check'";
if($result = $connection->query($sql)){
$row = $result->fetch_assoc();
$login_session =$row['user_id'];

if(!isset($login_session)){
mysql_close($connection); // Closing Connection
header('Location: login.php'); // Redirecting To Home Page
}}
else header('Location: login.php'); 
?>