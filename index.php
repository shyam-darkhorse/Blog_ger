<!DOCTYPE html>
<?php

include('session.php');

?>
<html lang="en">
  <head>
    <title>BLogger</title>
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
	      <a class="navbar-brand" href="index.html">Blogger</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item"><a href="index.php" class="nav-link">Home</a>
            </li>
	          <li class="nav-item"><a href="author.php" class="nav-link">Authors</a>
            </li>
	      <!--    <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Archives</a>
              <div class="dropdown-menu" aria-labelledby="dropdown04">
              	<a class="dropdown-item" href="destination.html">Destination</a>
                <a class="dropdown-item" href="tag.html">Tag</a>
                <a class="dropdown-item" href="author-post.html">Authors Post</a>
              </div>
            </li>
	          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pages</a>
              <div class="dropdown-menu" aria-labelledby="dropdown04">
              	<a class="dropdown-item" href="right-sidebar.html">Right Sidebar</a>
                <a class="dropdown-item" href="left-sidebar.html">Left Sidebar</a>
                <a class="dropdown-item" href="author.html">Authors Page</a>
              </div>
            </li>-->
	          <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>
			   <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->
    
    <section class="home-slider js-fullheight owl-carousel">
      <div class="slider-item js-fullheight" style="background-image:url(images/bg_4.jpg);">
      	<div class="overlay"></div>
        <div class="container-fluid">
          <div class="row no-gutters slider-text slider-text-2 js-fullheight align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-6 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
            <h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Don’t focus on having a great blog.</h1>
            <p data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"> Focus on producing a blog that’s great for your readers</p>
          </div>
        </div>
        </div>
      </div>

      <div class="slider-item js-fullheight" style="background-image:url(images/bg_5.jpg);">
      	<div class="overlay"></div>
        <div class="container-fluid">
          <div class="row no-gutters slider-text slider-text-2 js-fullheight align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-6 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
            <h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Blogging is just writing </h1>
            <p data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Writing using a particularly efficient type of publishing technology.</p>
          </div>
        </div>
        </div>
      </div>
    </section>





    <section class="ftco-section">
    	<div class="container">
    		<div class="row justify-content-center mb-5 pb-2">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <h2 class="mb-4">Articles</h2>
           <!-- <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country.</p>-->
          </div>
        </div>
    		<div class="row">
			
			
			
			
			
<?php
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
		$articles = '';
		$sql = "SELECT * FROM blog order by createdon desc";
		$result = $connection->query($sql);
		while($row =$result->fetch_assoc())
		{	$s = $row['userid'];
			$nameqry = "SELECT username from user where user_id = '$s';";
			$nameres = $connection->query($nameqry);
			$n =$nameres->fetch_assoc();
			$temp = $row['blogid'];
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
			$temp = $row['userid'];
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
			
			
			$text = $row['text'];
			$text = substr($text,0,120);
			$articles .= ' 
   			<div class="col-md-4">
    				<div class="blog-entry ftco-animate">
							<a href="single.php?id='.$row['blogid'].'" class="img img-2" style="background-image: url('.$num.');"></a>
							<div class="text text-2 pt-2 mt-3">
		          	<span class="big">'.$row['tag'].'</span>
	              <h3 class="mb-4"><a href="single.php?id='.$row['blogid'].'">'.$row['title'].'</a></h3>
	              <p class="mb-4">'.$text.'</p>
	              <div class="author mb-4 d-flex align-items-center">
	            		<a href="author-post.php?id='.$row['userid'].'" class="img" style="background-image: url('.$dp.');"></a>
	            		<div class="ml-3 info">
	            			<span>Written by</span>
	            			<h3><a href="author-post.php?id='.$row['userid'].'">'.$n['username'].'</a>, <span>'.$row['createdon'].'</span></h3>
	            		</div>
	            	</div>
	              <div class="meta-wrap align-items-center">
	              	<div class="half order-md-last">
		              	<p class="meta">
		              		<span><i class="icon-heart"></i>'.$row['likes'].'</span>
		              		
		              		<span><i class="icon-comment"></i>'.$row['comments'].'</span>
		              	</p>
	              	</div>
	              	<div class="half">
		              	<p><a href="single.php?id='.$row['blogid'].'" class="btn btn-primary px-3 py-2">Continue Reading</a></p>
	              	</div>
	              </div>
	            </div>
						</div>
    			</div>
				';

		
		}
		echo $articles;




?>			
			
			
				
				
				
				

				
				
				
				
    		</div>
    	</div>
    </section>

	
	
	
	
  <footer class="ftco-footer ftco-bg-dark ftco-section">
       <!-- <div class="container">
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Explorer</h2>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-3">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-4">
              <h2 class="ftco-heading-2">Destination</h2>
              <ul class="list-unstyled categories">
                <li><a href="#">Africa <span>(6)</span></a></li>
                <li><a href="#">Asia <span>(8)</span></a></li>
                <li><a href="#">Australia <span>(2)</span></a></li>
                <li><a href="#">Europe <span>(2)</span></a></li>
                <li><a href="#">North America <span>(7)</span></a></li>
                <li><a href="#">South America <span>(5)</span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Archives</h2>
              <ul class="list-unstyled categories">
                <li><a href="#">September 2018 <span>(6)</span></a></li>
                <li><a href="#">August 2018 <span>(8)</span></a></li>
                <li><a href="#">July 2018 <span>(2)</span></a></li>
                <li><a href="#">June 2018 <span>(7)</span></a></li>
                <li><a href="#">May 2018 <span>(5)</span></a></li>
                <li><a href="#">April 2018 <span>(3)</span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Have a Questions?</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>-->
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