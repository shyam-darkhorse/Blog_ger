<!DOCTYPE html>

<?php
	include('..\session.php');
?>
<html lang="en">
<head>
	<title>New Post</title>
	<meta charset="UTF-8">
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->


</head>
<body>

	<div class="bg-contact2" style="background-image: url('images/bg-01.jpg');">
		<div class="container-contact2">
			<div class="wrap-contact2">
				<form class="contact2-form validate-form" method="post" action="temp.php"   enctype='multipart/form-data'>
					<span class="contact2-form-title">
						New Post
					</span>

					<div class="wrap-input2 validate-input" data-validate="Title is required">
						<input class="input2" type="text" name="title">
						<span class="focus-input2" data-placeholder="Title"></span>
					</div>
					
					<div class="wrap-input2 validate-input" data-validate = "Message is required">
						<textarea class="input2" name="text"></textarea>
						<span class="focus-input2" data-placeholder="Text"></span>
					</div>

					<div class="wrap-input2 validate-input" data-validate = "Specify a suitable tag">
						<input class="input2" type="text" name="tag">
						<span class="focus-input2" data-placeholder="Tag"></span>
					</div>

					<div class="container-contact2-form-btn">
						<div class="wrap-contact2-form-btn">
							
								<input type="file" name="fileToUpload" id="fileToUpload"  class="contact2-form-btn" /> 
								<!--<button class="contact2-form-btn" id="OpenImgUpload">Image Upload</button>-->
						</div>
					</div>

					<div class="container-contact2-form-btn">
						<div class="wrap-contact2-form-btn">
							<div class="contact2-form-bgbtn"></div>
							<button type="submit" class="contact2-form-btn">
								Post on Blog
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>



<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-23581568-13');

 
	</script>

</body>
</html>
