<!DOCTYPE html>
<?php

include('session.php');
		if($_SESSION['isBlogger']==True){
		
		$nav = '<li class="nav-item"><a href="manage.php" class="nav-link">Manage your blog</a>
            </li>';
			}
		else{
		$nav = '<li class="nav-item"><a href="create.php" class="nav-link">Create your blog</a>
            </li>';
			}
			
	if(isset($_POST['submit'])){
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
	$id = $_SESSION['login_user'];
	$t =$_POST['title'];
	$a =$_POST['authbio'];
	$sql = "insert into bloguser(user_id,title,authorbio) values('$id','$t','$a' )";
	$result1 = $connection->query($sql) or die($connection->error);
	$_SESSION['isBlogger']=True;
	header('Location:manage.php');
		
	}
?>
<html lang="en">
  <head>
    <title>Create a blog</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    
	  
	 <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark " id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.php">Blogger</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item"><a href="index.php" class="nav-link">Home</a>
            </li>
	          <li class="nav-item"><a href="author.php" class="nav-link">Authors</a>
            </li>
			<?php echo $nav;?>
		

	          <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>
			   <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->
	<section class="ftco-section ftco-degree-bg">
      <div class="container">
	  <div class="row justify-content-center">
    			<div class="col-md-8">
				
				              <div class="comment-form-wrap pt-5">
                <h3 class="mb-5">Create a Blog</h3>
                <form action="create.php" method = "post" class="p-5 bg-light">
                  <div class="form-group">
                    <label for="title">Title of Blog</label>
                    <input type="text" class="form-control" name = "title" id="title">
                  </div>
                  

                  <div class="form-group">
                    <label for="bio">Short bio</label>
                    <textarea  id="bio" cols="30" name ="authbio"  rows="10" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                    <input type="submit" name = "submit" value="Create" class="btn py-3 px-4 btn-primary">
                  </div>

                </form>
              </div>
					
					
					
    			</div>
    		</div>
	  </div>
    </section> 
	   <footer class="ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
	  

		
        <div class="row">
          <div class="col-md-12 text-center">

            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
          </div>
        </div>
      </div>
    </footer>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>