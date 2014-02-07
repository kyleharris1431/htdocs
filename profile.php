<?php session_start();?>
<!--
	Prologue 1.1 by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php
  $id=''; 
  $first_name='';
  $last_name='';
  
  $tagline=''; 
  $portfolio_text='';
  $about_me='';
  
  
  $main_image = ''; 
  
  //Read your session (if it is set)
   if (isset($_SESSION['id_num']))
   {
     $id = $_SESSION['id_num'];
   }
   
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

?>
<!DOCTYPE HTML>
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
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-wide.css" />
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
                                <li><a href="edit.php" target="_self" id="edit-info-link" class="skel-panels"><span class="fa fa-edit">Edit My Information</span></a></li>
                                
                               <li><a href="edit_interests.php" target="_self" id="edit-interests-link" class="skel-panels"><span class="fa fa-edit">Interests</span></a></li>
                               
                               
                               <li><a href="find_a_friend.php" target="_self" id="edit-interests-link" class="skel-panels"><span class="fa fa-plus">Connect.</span></a></li>
                                
                               <li><a href="upload_images.php" target="_self" id="edit-interests-link" class="skel-panels"><span class="fa fa-plus">Upload to Gallery</span></a></li>
                                                                

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
								<h2 class="alt">This is <strong>BestBrightLight</strong>. An authentic social network.
							</header>
							
							<p>This is where we will put our company goal before the user Edits the information. We can state our intentions and the reason for creating <strong> BestBrightLight</strong>. This information is to be decided. </p>

							<footer>
								<a href="#portfolio" class="button scrolly">Magna Aliquam</a>
							</footer>

						</div>
					</section>
					
				<!-- Portfolio -->
					<section id="portfolio" class="two">
						<div class="container">
					
							<header>
								<h2>Portfolio</h2>
							</header>
							
							<p><?php echo $portfolio_text ?></p>
						
							<div class="row">
								<div class="4u">
									<article class="item">
										<a href="http://ineedchemicalx.deviantart.com/art/A-million-suns-384369739" class="image full"><img src="images/pic02.jpg" alt="" /></a>
										<header>
											<h3>Ipsum Feugiat</h3>
										</header>
									</article>
									<article class="item">
										<a href="http://ineedchemicalx.deviantart.com/art/Mind-is-a-clear-stage-375431607" class="image full"><img src="images/pic03.jpg" alt="" /></a>
										<header>
											<h3>Rhoncus Semper</h3>
										</header>
									</article>
								</div>
								<div class="4u">
									<article class="item">
										<a href="http://ineedchemicalx.deviantart.com/art/You-really-got-me-345249340" class="image full"><img src="images/pic04.jpg" alt="" /></a>
										<header>
											<h3>Magna Nullam</h3>
										</header>
									</article>
									<article class="item">
										<a href="http://ineedchemicalx.deviantart.com/art/Ad-infinitum-354203162" class="image full"><img src="images/pic05.jpg" alt="" /></a>
										<header>
											<h3>Natoque Vitae</h3>
										</header>
									</article>
								</div>
								<div class="4u">
									<article class="item">
										<a href="http://ineedchemicalx.deviantart.com/art/Elysium-355393900" class="image full"><img src="images/pic06.jpg" alt="" /></a>
										<header>
											<h3>Dolor Penatibus</h3>
										</header>
									</article>
									<article class="item">
										<a href="http://ineedchemicalx.deviantart.com/art/Emperor-of-the-Stars-370265193" class="image full"><img src="images/pic07.jpg" alt="" /></a>
										<header>
											<h3>Orci Convallis</h3>
										</header>
									</article>
								</div>
							</div>

						</div>
					</section>

				<!-- About Me -->
					<section id="about" class="three">
						<div class="container">

							<header>
								<h2>About Me</h2>
							</header>

							
							<span class="image"><img src="<?php echo $main_image?>" alt=""  id = "spaceimage" class = "space"/></span>
							
							<p><?php echo $about_me?> </p>

						</div>
					</section>
			
				<!-- Contact -->
					<section id="contact" class="four">
						<div class="container">

							<header>
								<h2>Contact</h2>
							</header>

							<p>Do you know <?php echo $first_name?> ? Send He or She a personal message. </p>
							
							<form method="post" action="#">
								<div class="row half">
									<div class="6u"><input type="text" class="text" name="name" placeholder="Name" /></div>
									<div class="6u"><input type="text" class="text" name="email" placeholder="Email" /></div>
								</div>
								<div class="row half">
									<div class="12u">
										<textarea name="message" placeholder="Message"></textarea>
									</div>
								</div>
								<div class="row">
									<div class="12u">
										<a href="#" class="button submit">Send Message</a>
									</div>
								</div>
							</form>

						</div>
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