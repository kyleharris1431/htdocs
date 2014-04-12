<!DOCTYPE html>
<?php session_start();?>
<!--
	Prologue 1.1 by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php
 $id ="" ; 
 
 $id='';
 if (isset($_SESSION['id_num']))
 {
 $id = $_SESSION['id_num'];
 }
 
 // run this query , { SELECT * FROM posts WHERE 'id' = '".$id."'; }
 
 // from there, we can select data from assoc. arrays / 
 $query = "SELECT * FROM posts WHERE id = '".$id."';";

 $fileroots = array();
 $post_texts = array();
 $liked = array();
 
 include('dAl.php'); 
 $x = new DataAccessProtocol();
 $res = $x->runQueryWithRes($query);
 
 while($row = mysqli_fetch_array($res)) // fetch results as array and print data
 {
     // get the user's first and last name;
    array_push($fileroots, $row['file_root']); 
    array_push($post_texts,$row['post_text']);
    array_push($liked, $row['likes']);
 }     
 
 //var_dump($post_texts);
 //var_dump($fileroots);
 //var_dump($liked);

  
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
		    <link rel="stylesheet" href="css/post_style.css" />
		</noscript>
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie8.css" /><![endif]-->
		
<style type="text/css">
.poster_div
{
width: 90%;
height:10%;
background-color:rgba(236,236,236,0.60);
border: 1px solid steelblue;
margin: 10px;
padding: 10px;
border-radius: 15px;

}

#new_post_div
{
 margin: auto;
 width: 60%;
 height: 10%;
 height: auto;
 border: 1px solid rgba(70,155,234,0.77);
 padding: 20px;
 
}
.post_img
{
width: 50%;
height: auto;
border-radius: 10px;
}

.post_text
{
background: white;
}
</style>
	</head>
	<body>

		<!-- Header -->
			<div id="header" class="skel-panels-fixed">

				<div class="top">

					<!-- Logo -->
						<div id="logo">
							<span class="image avatar48"><img src="images/avatar.jpg" alt="" /></span>
							<h1 id="title"><?php echo $first_name." ".$last_name?></h1>
							<hr>
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
								<h2 class="alt">This is your Posts page. Post things </h2>
							</header>
							
						<div id = "new_post_div">
					
						 <form id = "file_form" method="post" action="new_post.php" class="login_form" enctype="multipart/form-data">
                          <div>
                          <img src ="" width="75%"height="90%" id = "preview">              
                          <input type="file" id="file_input" onchange="showPreview()" name = "file_input">
                          </p>
                          </div>
                          <!--<img class="placeholder" id = "img_placeholder"> -->
                          <textarea id = "proud_textarea" name="proud_textarea">What are you proud of?</textarea>	
                          <br>
                          <p align="center"><input type="submit"/> </p>	
                          </form>					
						</div>
						
						    <br>
						    <br>
							<hr>
						<?php for($z=0; $z<sizeof($post_texts); $z++) {?>
						
						  <div class="poster_div">
						  <div class = "content_div">
						  <img src =" <?php echo $fileroots[$z];?>" class="post_img"/>
						  <p class ="post_text"><?php echo $post_texts[$z];?> <br> </p>	
						  </div>
						  </div>
						  <br>
						  <hr>
						  <?php }?>
						
			</div>
					</section>
			
					
							
		<!-- Footer -->
			<div id="footer">
				
				<!-- Copyright -->
					<div class="copyright">
						<ul class="menu">
							<li>Design: Kyle Harris</li>
							<li>Images: <a href="http://ineedchemicalx.deviantart.com">Felicia Simion</a></li>
						</ul>
					</div>
				
			</div>
	
<script type="text/javascript">
function showPreview()
{
  var preview = $('#preview');
  var file = document.getElementById('file_input').files[0];
  var reader = new FileReader();
  
  reader.onloadend = function()
  {
	  preview.attr('src' , reader.result);
  }
  if(file)
  {
	  reader.readAsDataURL(file);
  }
  else
  {
		  preview.attr('src' , '');
  }
}
</script>

<script>
$('.poster_div').hover(function()
{
   $(this).css("background-color", "white");
});

</script>

	</body>
</html>