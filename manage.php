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

	$authid= $_SESSION['login_user'];
	$sql = "SELECT * from bloguser where user_id = '$authid'";
	$result = $connection->query($sql);
	while($row =$result->fetch_assoc())
	{
		$title1 = '<div class="col-md-9 text-center ftco-animate" data-scrollax=" properties: { translateY: \'70%\' }">
            <p class="breadcrumbs" data-scrollax="properties: { translateY: \'30%\', opacity: 1.6 }"><span class="mr-2"><a href="index.php">Home</a></span> <span>Author Post</span></p>
            <h1 class="mb-3 bread" data-scrollax="properties: { translateY: \'30%\', opacity: 1.6 }">'.$row['title'].'</h1>
          </div>';
		 
		  $namequery = "SELECT username from user where user_id = '$authid'";
		  $res = $connection->query($namequery);
		  while($row1 =$res->fetch_assoc())
		{
			 
			global $nameauth;
			$nameauth= $row1['username'];
		 $desc = '<div class="col-md-12 heading-section text-center ftco-animate">
		            <h2 class="mb-1">'.$row1['username'].'</h2>
		            <span class="d-block mb-4">'.$row['blogcount'].' Articles</span>
		            <p>'.$row['authorbio'].'</p>
		          </div>';
		}
		$articles = '';
		$sql2 = "SELECT * FROM blog where userid= '$authid' order by createdon desc";
		$result2 = $connection->query($sql2);
		while($row2 =$result2->fetch_assoc())
		{	$s = $authid;
			
			$temp = $row2['blogid'];
			$temp = str_replace(" ","",$temp);
			$files = glob("/wamp64/www/Blog_ger/images/uploads/$temp.*");
			$eventimg=0;
			for ($i=0; $i<count($files); $i++)
			{
				$eventimg=1;
				$num = $files[$i];
				$num = str_replace("/wamp64/www","",$num);
			}
			if($eventimg==0)
			{
				$num="images/uploads/blog.jpg";
			}
			$temp = $row2['userid'];
			$files = glob("/wamp64/www/Blog_ger/signup/profilepic/$temp.*");
			$flag1=1;
			for ($i=0; $i<count($files); $i++)
			{
				$flag1=0;
				$dp = $files[$i];
				$dp = str_replace("/wamp64/www","",$dp);
			}
			if($flag1==1)
			{
				$dp="signup/profilepic/img-avatar.png";
			}
			
			
			$text = $row2['text'];
			$text = substr($text,0,120);
			$articles .= ' 
   			<div class="col-md-4">
    				<div class="blog-entry ftco-animate">
							<a href="single.php?id='.$row2['blogid'].'" class="img img-2" style="background-image: url('.$num.');"></a>
							<div class="text text-2 pt-2 mt-3">
		          	<span class="big">'.$row2['tag'].'</span>
	              <h3 class="mb-4"><a href="single.php?id='.$row2['blogid'].'">'.$row2['title'].'</a></h3>
	              <p class="mb-4">'.$text.'</p>
	              <div class="author mb-4 d-flex align-items-center">
	            		<a href="author-post.php?id='.$row2['userid'].'" class="img" style="background-image: url('.$dp.');"></a>
	            		<div class="ml-3 info">
	            			<span>Written by</span>
	            			<h3><a href="author-post.php?id='.$row2['userid'].'">'.$nameauth.'</a>, <span>'.$row2['createdon'].'</span></h3>
	            		</div>
	            	</div>
	              <div class="meta-wrap align-items-center">
	              	<div class="half order-md-last">
		              	<p class="meta">
		              		<span><i class="icon-heart"></i>'.$row2['likes'].'</span>
		              		
		              		<span><i class="icon-comment"></i>'.$row2['comments'].'</span>
		              	</p>
	              	</div>
	              	<div class="half">
		              	<p><a href="single.php?id='.$row2['blogid'].'" class="btn btn-primary px-3 py-2">Continue Reading</a></p>
	              	</div>
	              </div>
	            </div>
						</div>
    			</div>
				';

		
		}
		
	}

						
?>
<html lang="en">
<head>
    <title>Author's page</title>
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
    
	  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
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
    
    <div class="hero-wrap js-fullheight" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center" data-scrollax-parent="true">
          <?php echo $title1;?>
        </div>
      </div>
    </div>

     <section class="ftco-section">
    	<div class="container">
    		<div class="row justify-content-center mb-5 pb-2">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <?php echo $desc;?><a href= ""><img src ="images/new_post.png" height= "100px" alt = "new post" width ="auto"/><br/>NewPost</a>
        </div>
    		<div class="row"> 					
		    	<?php echo $articles;?>
    			</div><!-- END-->
    			
    		</div>
    	</div>
    </section>

    <footer class="ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
       
        </div>
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