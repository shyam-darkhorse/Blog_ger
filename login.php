<!DOCTYPE html>
<?php

if(isset($_SESSION['login_user'])){
header("location: index.php");		
}
session_start();	

if(isset($_SESSION['successmsg'])&&$_SESSION['successmsg']!=''){
	echo '<script type="text/javascript">alert("'.$_SESSION['successmsg'].'")</script>';
unset($_SESSION['successmsg']);
}


if(isset($_POST["submit"])){
$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "blogger";
		//$_SESSION['orgcheck']=false;
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		$user = $_POST["user"];
		$password = $_POST["password"];

		$sql = "SELECT user_id, username,pwd FROM user WHERE email = '$user' ";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row
			$row = $result->fetch_assoc();
			if ( $row["pwd"] === $password ) {
				$message = "login successful";
				$_SESSION['login_user']=$row['user_id'];
				$id = $row['user_id'];
				echo "DOne";
				$sql1 = "select count(*)as c from bloguser where user_id = '$id'";
				$result1 = $conn->query($sql1) or die($conn->error);
				$c = $result1->fetch_assoc();
				if($c['c']==1){
				$_SESSION['isBlogger'] = True;
				}
				else
					$_SESSION['isBlogger'] = False;	
				Header("Location:index.php");
			}
			else {
				$_SESSION['successmsg']= "password incorrect";
				echo "failed";
				Header("Location:login.php");
			}
		}
		else {
			$_SESSION['successmsg'] = "Enter all details correctly";
			
		}
		$conn->close();


}



?>
<html lang="en">
<head>
	<title>Login | Blogger</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>	

	




<body>
	<p id="para"></p>
	<div class="limiter" >
		<div class="container-login100" >
			<div class="wrap-login100 p-t-20 p-b-20" >
				<form class="login100-form" method="post" name="myForm" action="login.php" onsubmit="return validateForm();">
					<span class="login100-form-title p-b-50">
						Login to The Blogger
					</span>
					<!--<span class="login100-form-avatar">
						<img src="sathya.jpg" alt="AVATAR">
					</span>-->

					<div class="wrap-input100 validate-input m-t-30 m-b-20" data-validate = "Enter email">
						<input type="text" class="input100" size=25 name="user">
						<span class="focus-input100" data-placeholder="mail@something.com"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-50" data-validate="Enter password">
						<input type="password" class="input100" size=25 name="password" >
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

					<div class="container-login100-form-btn">
						<input type="submit"  value="Login" class="login100-form-btn" onclick="return validateForm();" name = "submit">
					
					</div>
					<br>


					<ul class="login-more p-t-50">
				<!--	<li class="m-b-8">
							<span class="txt1">
								Are you an blogger??
							</span>

							<a href="orgin.php" class="txt2">
								Login as blogger
							</a>
						</li>
					-->

						<li>
							<span class="txt1">
								Don’t have an account?
							</span>

							<a href="signup/signup.php" class="txt2">
								Sign up
							</a>
						</li>
					</ul>
				</form>
			</div>
		</div>
	</div>
	

<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/login.js"></script>

</body>
</html>