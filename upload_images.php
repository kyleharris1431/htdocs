<!DOCTYPE HTML>

<?php session_start();?>
<?php 
?> 
<?php
$id = '';
if (isset($_SESSION['id_num']))
{
 $id = $_SESSION['id_num'];
}
  $first_name='';
  $last_name='';
  
  $tagline=''; 
  $portfolio_text='';
  $about_me='';
  
   $main_image = '';    
   include('dAl.php'); 
   $x = new DataAccessProtocol();
   $res = $x->runQueryWithRes("SELECT * FROM users WHERE id = '".$id."';");
 
 while($row = mysqli_fetch_array($res)) // fetch results as array and print data
 {
     // get the user's first and last name;
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
 }     
 
 /// run query to get other data // 
 
 $res_2 = $x->runQueryWithRes("SELECT * FROM user_info_2 WHERE id = '".$id."'");
 
 while($row = mysqli_fetch_array($res_2)) // fetch results as array and print data
 {
    $tagline =  $row['tagline'];
    $about_me = $row['about_me'];
    $portfolio_text = $row['portfolio'];
 }     

 $res_3 = $x->runQueryWithRes("Select * FROM main_pictures_2 WHERE id = '".$id."'");
 while($row = mysqli_fetch_array($res_3)) // fetch results as array and print data
 {
     
    $main_image =  $row['main_picture'];
 }  
 
 $pictureRoots = getPicturesArray($id);
 
 function getPicturesArray($id)
 {
    $pic_roots = array();
  // include('dAl.php'); 
    $xc = new DataAccessProtocol();
    $res = $xc->runQueryWithRes("SELECT picture_root FROM images WHERE id = '".$id."';");
    while($row = mysqli_fetch_array($res)) // fetch results as array and print data
    {  
     // echo "Picture root : ".$row['picture_root'];
      array_push($pic_roots,$row['picture_root']);
    }     	 
    return $pic_roots;
 }
 $video_roots = getVideosArray($id);
 function getVideosArray($id)
 {
    $vid_roots = array();
  // include('dAl.php'); 
    $xyz = new DataAccessProtocol();
    $res = $xyz->runQueryWithRes("SELECT video_root FROM videos WHERE id = '".$id."';");
    while($row = mysqli_fetch_array($res)) // fetch results as array and print data
    {  
      //echo "Video Root: ".$row['video_root'];
      array_push($vid_roots,$row['video_root']);
    }     	 
    return $vid_roots;
 }
?>
<html>
	<head>
		<title>BestBrightLight</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600" rel="stylesheet" type="text/css" />
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<script src="js/init.js"></script>
		<script src="js/bjqs-1.3.min.js"></script>
		<script src="http://malsup.github.com/jquery.form.js"></script> 
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" /> 
			<link rel="stylesheet" href="css/style-wide.css" />
			<link rel="stylesheet" href="css/bjqs.css">
			<link rel="stylesheet" href="css/demo copy.css">
		</noscript>
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie8.css" /><![endif]-->
	</head>
	<body>

		<!-- Header -->
			<div id="header" class="skel-panels-fixed">

				<div class="top">

					<!-- Logo -->
						<div id="logo">
							<span class="image avatar48"><img src="images/avatar.jpg" alt="" /></span>
							<h1 id="title"><?php echo $first_name." ".$last_name?></h1>
							<span class="byline"><?php echo $tagline?></span>
						</div>

					<!-- Nav -->
						<nav id="nav">
							<ul>
								<li><a href="#top" id="top-link" class="skel-panels-ignoreHref"><span class="fa fa-home">Intro</span></a></li>
								<li><a href="#portfolio" id="portfolio-link" class="skel-panels-ignoreHref"><span class="fa fa-th">Portfolio</span></a></li>
								<li><a href="#about" id="about-link" class="skel-panels-ignoreHref"><span class="fa fa-user">About Me</span></a></li>
								<li><a href="#contact" id="contact-link" class="skel-panels-ignoreHref"><span class="fa fa-envelope">Contact</span></a></li>
								<li><a href="#contact" id="view_gallery" class="skel-panels-ignoreHref"><span class="fa fa-envelope">View Gallery</span></a></li>
                                                                                      
                          </ul>
						</nav>
						
				</div>
				
				<div class="bottom">

					<!-- Social Icons -->
						<ul class="icons">
							<li><a href="#" class="fa fa-twitter solo"><span>Twitter</span></a></li>
							<li><a href="#" class="fa fa-facebook solo"><span>Facebook</span></a></li>
							<li><a href="#" class="fa fa-github solo"><span>Github</span></a></li>
							<li><a href="#" class="fa fa-dribbble solo"><span>Dribbble</span></a></li>
							<li><a href="#" class="fa fa-envelope solo"><span>Email</span></a></li>
						</ul>
				
				</div>
			
			</div>
		<!-- Main -->
			<div id="main">
			
				<!-- Intro -->
					<section id="top" class="one">
						<div class="container">

							<a href="http://ineedchemicalx.deviantart.com/art/Moonscape-381829905" class="image featured"><img src="images/pic01.jpg" alt="" /></a>

							<header>
							<h2 class="alt">This is your gallery. Put photos and videos from any important part of your life, this will be an integral part of <strong><?php echo $first_name?>'s</strong> BestBrightLight </header>
			<form enctype="multipart/form-data" id = "photoform" method="post" action="process_image_upload.php">
            <h3>
             <center> Upload Photos  </center>  
             <br>  
            </h3>
            <input type="hidden" name="size" value="350000">
            <input type="file"   name="photo"> 
            <input type="submit" name="upload" title="Add Image to gallery" value="Add Photo"/>
          </form>
          <hr>
          <form method="post" action="process_video_upload.php" enctype="multipart/form-data">
           <h3> <center> Upload Videos</center></h3>  <br>
            <input type="hidden" name="size" value="350000000">
            <input type="file"   name="video"> 
            <input TYPE="submit" name="upload" title="Add Video to gallery" value="Add Video"/>
          </form>
          <hr>


						</div>
					</section>
					
				<!-- Portfolio -->
			<section id="portfolio" class="two">
			<header>
					<h1 class = "heading"> <center> Image Gallery </center> </h1> 
					</header>
					<hr>
<!-------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------->
      <!--  Outer wrapper for presentation only, this can be anything you like -->
     <center> <div id="banner-fade"> 

        <!-- start Basic Jquery Slider -->
        <center><ul class="bjqs">
        
          <?php for($x=0; $x<sizeof($pictureRoots); $x++) { ?>
          <li><img src="user_images/<?php echo $pictureRoots[$x]?>" </li>
          <?php } ?>
          
        </ul></center>
        <!-- end Basic jQuery Slider -->

     </div>  </center>
      <!-- End outer wrapper -->

      <script class="secret-source">
        jQuery(document).ready(function($) {

          $('#banner-fade').bjqs({
            height      : 450,
            width       : 700,
            responsive  : true,
            animtype : 'slide', // accepts 'fade' or 'slide'
            animduration : 1500, // how fast the animation are
            animspeed : 4000, // the delay between each slide
            automatic : true
          });

        });
      </script>
<!------------------------------------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------------------------------------->
<!------------------------------------------------------------------------------------------------------------------------->
<hr><br>
<br>
				    <div id="hobby_div">
                    <?php for($x=0; $x<sizeOf($pictureRoots); $x++) { ?>
                       <div class = "hobby_container">
                      <img class = "hobby_img" src = "user_images/<?php echo $pictureRoots[$x]?>">
                       </div>
		             <?php } ?>
		          		</div>
					</section>

				<!-- About Me -->
					<section id="about" class="three">
					
					  <header>
					<h1 class = "heading"> <center> Video Gallery </center> </h1> 
			  </header>
			 <?php for($x=0; $x<sizeof($video_roots); $x++) { ?> 
<video width="400" height="270" controls>
<source src="user_videos/<?php echo $video_roots[$x];?>" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
</video> 

<?php } ?>
		</section>
			
	<!-- Contact -->
		<section id="contact" class="four">
	</section>
			</div>

		<!-- Footer -->
			<div id="footer">
				
				<!-- Copyright -->
					<div class="copyright">
						<p>&copy; 2013 <?php echo $first_name." ".$last_name?> All rights reserved.</p>
						<ul class="menu">
							<li>Design: Kyle Harris</li>
							<li>Images: <a href="http://ineedchemicalx.deviantart.com">Felicia Simion</a></li>
						</ul>
					</div>
				
			</div>
	</body>
</html>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <!-- bjqs.css contains the *essential* css needed for the slider to work -->
    <link rel="stylesheet" href="css/bjqs.css">
    <!-- some pretty fonts for this demo page - not required for the slider -->
    <link href='http://fonts.googleapis.com/css?family=Source+Code+Pro|Open+Sans:300' rel='stylesheet' type='text/css'> 
    <!-- demo.css contains additional styles used to set up this demo page - not required for the slider --> 
    <!-- load jQuery and the plugin -->
    <script src="js/bjqs-1.3.min.js"></script>
  </head>
  </html>
