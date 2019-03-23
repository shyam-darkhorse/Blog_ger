<!DOCTYPE html>
<html lang="en">
<?php
include('session.php');

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
	
	$blogno= $_GET['id'];
	
	//add comment
		if(isset($_POST['commentsub']))
		{	$com =$_POST['com'];
			
			$c = $_POST['count'] +1;
			$curruser = $_SESSION['login_user'];
			$csql = "Insert into comments (userid,comment,time,blogid,date) values ('$curruser','$com',curtime(),'$blogno',curdate())";
			echo $csql;
			$res=$connection->query($csql) or die($connection->error);
			$usql = "update blog set comments = '$c' where blogid ='$blogno'";
			$res=$connection->query($usql) or die($connection->error);
			
		 
		
		}
	$sqlblog = "SELECT * from blog where blogid = '$blogno'";
	$result = $connection->query($sqlblog);
	$authorid = 0;
	while($row =$result->fetch_assoc())
	{	$commentcount = $row['comments'];
		$authorid = $row['userid'];
		$like = $row['likes'];
			$temp = $blogno;
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
		
	$blogText = '  <h2 class="mb-3 font-weight-bold">'.$row['title'].'</h2>
            
            <p>
              <img src="'.$num.'" alt="" class="img-fluid">
            </p>
            <p>'.$row['text'].'</p>
            <div class="tag-widget post-tag-container mb-5 mt-5">
              <div class="tagcloud">
                <a href="#" class="tag-cloud-link">Life</a>
                <a href="#" class="tag-cloud-link">Sport</a>
                <a href="#" class="tag-cloud-link">Tech</a>
                <a href="#" class="tag-cloud-link">Travel</a>
              </div>
            </div>
            ';
	
	
	}
	$sqlbio = "select * from bloguser where user_id = '$authorid'";
	$result1 = $connection->query($sqlbio);
	while($row1 =$result1->fetch_assoc())
	{		
		


			$titleBlock = ' <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center" data-scrollax-parent="true">
          <div class="col-md-9 text-center ftco-animate" data-scrollax=" properties: { translateY: \'70%\' }">
            <p class="breadcrumbs" data-scrollax="properties: { translateY:\'30%\', opacity: 1.6 }"><span class="mr-2"><a href="index.html">Home</a></span> <span>Articles</span></p>
            <h1 class="mb-3 bread" data-scrollax="properties: { translateY: \'30%\', opacity: 1.6 }">'.$row1['title'].'</h1>
          </div>
        </div><p id = "blogval" value = "'.$blogno.'"></p>';
		
		 $namequery = "SELECT username from user where user_id = '$authorid'";
		  $res = $connection->query($namequery);
		 if( $row2 =$res->fetch_assoc())
		{
		
		$nameauth= $row2['username'];
			$temp = $authorid;
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
		}
		$authorBio = '            <div class="about-author d-flex p-4 bg-light">
              <div class="bio mr-5">
                <img src="'.$dp.'" alt="Image placeholder" class="img-fluid mb-4">
              </div>
              <div class="desc">
                <h3>'.$nameauth.'</h3>
                <p>'.$row1['authorbio'].'</p>
              </div>
            </div>';
	
	
	}
	
	$sqlcomm = "select * from comments where blogid = '$blogno'";
	$result3 = $connection->query($sqlcomm);
	$comments = '';
	while($row3 =$result3->fetch_assoc())
	{	$usercomm = $row3['userid'];
		$namequery1 = "SELECT username from user where user_id = '$usercomm'";
		  $res1 = $connection->query($namequery1);
		 // echo $namequery;	
		 if( $row4 =$res1->fetch_assoc())
		{
		
		$nameuser= $row4['username'];
			$temp = $usercomm;
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
		}
		$comments.=' <ul class="comment-list">
                <li class="comment">
                  <div class="vcard bio">
                    <img src="'.$dp.'" alt="Image placeholder">
                  </div>
                  <div class="comment-body">
                    <h3>'.$nameuser.'</h3>
                    <div class="meta">'.$row3['date'].'  '.$row3['time'].'</div>
                    <p>'.$row3['comment'].'</p>
                    
                  </div>
                </li>';
		
	}
	
	
	
	

?>
  <head>
    <title>Read a blog</title>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
	<?php echo $titleBlock;?>
      </div>
    </div>

    <section class="ftco-section ftco-degree-bg">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 ftco-animate">
			<?php 
			echo $blogText;?>
			<p id = "likescount" value ="<?php echo $like;?>" ><span id = "c1"><?php echo $like;?></span> likes <a href="#likeb" id ="likeb" class="btn btn-primary px-3 py-2">Like<i  class="fa fa-thumbs-up"></i></a>
			</p>
			<?php echo $authorBio;?>

			
            <div class="pt-5 mt-5">
              <h3 class="mb-5"><?php echo $commentcount;?> Comments</h3>
				<?php echo $comments;?>




              </ul>
              <!-- END comment-list -->
			  
	<script>

	$("#likeb").click(function() {
    //in here we can do the ajax after validating the field isn't empty.
	 var newlikes = <?php echo $like;?>+1;
	document.getElementById("c1").innerHTML = newlikes;
	
        $.post("update.php",{ likec: <?php echo $like+1;?>, blogid:"<?php echo $blogno ?>"}, //your form data to post goes here as a json object
			 function (data, status, xhr) {
				
    
            } 
        );
		}
     
);



</script>
              <div class="comment-form-wrap pt-5">
                <h3 class="mb-5">Leave a comment</h3>
                <form action="" class="p-5 bg-light" method = "post">


                  <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="com" id="message" cols="30" rows="10" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
				  <input type = "hidden" name = "count" value ="<?php echo $commentcount;?>">
                    <input name = "commentsub" type="submit" value="Post Comment" class="btn py-3 px-4 btn-primary">
                  </div>

                </form>
              </div>
            </div>

          </div> <!-- .col-md-8 -->
          <div class="col-lg-4 sidebar ftco-animate">
            <div class="sidebar-box">
              <form action="" class="search-form">
                <div class="form-group">
                  <span class="icon icon-search"></span>
                  <input type="text" class="form-control" placeholder="Type a keyword and hit enter">
                </div>
              </form>
            </div>


         <!--   <div class="sidebar-box ftco-animate">
              <h3>Popular Articles</h3>
              <div class="block-21 mb-4 d-flex">
                <a class="blog-img mr-4" style="background-image: url(images/image_1.jpg);"></a>
                <div class="text">
                  <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
                  <div class="meta">
                    <div><a href="#"><span class="icon-calendar"></span> Oct. 04, 2018</a></div>
                    <div><a href="#"><span class="icon-person"></span> Dave Lewis</a></div>
                    <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                  </div>
                </div>
              </div>
              <div class="block-21 mb-4 d-flex">
                <a class="blog-img mr-4" style="background-image: url(images/image_2.jpg);"></a>
                <div class="text">
                  <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
                  <div class="meta">
                    <div><a href="#"><span class="icon-calendar"></span> Oct. 04, 2018</a></div>
                    <div><a href="#"><span class="icon-person"></span> Dave Lewis</a></div>
                    <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                  </div>
                </div>
              </div>
              <div class="block-21 mb-4 d-flex">
                <a class="blog-img mr-4" style="background-image: url(images/image_3.jpg);"></a>
                <div class="text">
                  <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind texts</a></h3>
                  <div class="meta">
                    <div><a href="#"><span class="icon-calendar"></span> Oct. 04, 2018</a></div>
                    <div><a href="#"><span class="icon-person"></span> Dave Lewis</a></div>
                    <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                  </div>
                </div>
              </div>
            </div>-->

            <div class="sidebar-box ftco-animate">
              <h3>Tag Cloud</h3>
              <ul class="tagcloud">
                <a href="#" class="tag-cloud-link">dish</a>
                <a href="#" class="tag-cloud-link">menu</a>
                <a href="#" class="tag-cloud-link">food</a>
                <a href="#" class="tag-cloud-link">sweet</a>
                <a href="#" class="tag-cloud-link">tasty</a>
                <a href="#" class="tag-cloud-link">delicious</a>
                <a href="#" class="tag-cloud-link">desserts</a>
                <a href="#" class="tag-cloud-link">drinks</a>
              </ul>
            </div>

						

        


            
          </div><!-- END COL -->

        </div>
      </div>
    </section> <!-- .section -->

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