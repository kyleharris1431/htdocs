<? session_start();?> 
<?php 
if (isset($_SESSION['id_num']))
{
     $id = $_SESSION['id_num'];
}
?>
<?php
  $id=''; 
  $first_name='';
  $last_name='';
  
  $tagline=''; 
  $portfolio_text='';
  $about_me='';
  
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
     // get the user's first and last name;
    $tagline =  $row['tagline'];
    $about_me = $row['about_me'];
    $portfolio_text = $row['portfolio'];
 }  
 
 ?>   
<!DOCTYPE HTML>
<!--
	Prologue 1.1 by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
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
		<script type="text/javascript" src="/js/jQuery.js"></script>
		<script type="text/javascript" src="/scripts/jquery.min.js"></script>

	
		<script type="text/javascript" src="/scripts/jquery.form.js"></script>

<script type="text/javascript" >
 $(document).ready(function() 
 { 
            $('#photoimg').live('change', function()			
            { 
			           $("#preview").html('');
			    $("#preview").html('<img src="loader.gif" alt="Uploading...."/>');
			$("#imageform").ajaxForm({
						target: '#preview'
		}).submit();
		
			});
        }); 
</script>
		
		<noscript>
			<link rel="stylesheet" href="/css/skel-noscript.css" />
			<link rel="stylesheet" href="/css/style.css" />
			<link rel="stylesheet" href="/css/style-wide.css" />
			<link rel="stylesheet" href="/my_style.css" />
		</noscript>
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie8.css" /><![endif]-->
	</head>
	<body>

		<!-- Header -->
					<!-- Main -->
			<div id="main">
			
				<!-- Intro -->
					<section id="top" class="one">
						<div class="container">

							<a href="http://ineedchemicalx.deviantart.com/art/Moonscape-381829905" class="image featured"><img src="images/pic01.jpg" alt="" /></a>

							<header>
<h2 class="alt"> <center>This is the <strong>Edit</strong> page. Write what makes you, <strong> You </strong>   </center> </h2> </header>
						 <h2> <center> <strong> About me </strong> </center> </h2>
 <center>
   
    <div class="editable_text">
                           
    <form id="form1"  method="post">
   
    <textarea name="about_text" id = "about_text"> <?php echo"".$about_me."";?> </textarea>

   <input type="submit" name="submit" id="submit" value="Save Changes">
   
   </form> 
   <br> 
   
   <center>
   
<div style="width:600px">

<form id="imageform" method="post" enctype="multipart/form-data" action='ajaximage.php'>
Upload your image <input type="file" name="photoimg" id="photoimg" />
</form>
<div id='preview'>
</div>   

  
  </center>
                           
	</div>
					</section>
					
				<!-- Portfolio -->
					<section id="portfolio" class="two">
						<div class="container">
					
						
							
					     <h2> <center> <strong> Portfolio </strong> </center> </h2>
                          <div class="editable_text">
                           
    <form id="form2"  method="post">
   
    <textarea name="portfolio_text" id = "portfolio_text"> <?php echo"".$portfolio_text.""; ?> </textarea>

   <input type="submit" name="submit" id="submit" value="Save Changes">
   
   </form>  
   <br> 

						
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
			
<script type="text/javascript">
$('#form1').submit(function(event) 
     {  
       event.preventDefault();
       $.ajax(
       {
       type: 'POST',
       url: 'ajax_aboutme.php',
       data: $(this).serialize(),
       dataType: 'json',
       success: function (data) 
       {
       console.log(data);
       alert("Data updated");
       }
    });
 });

</script>

<script type="text/javascript">
$('#form2').submit(function(event) 
     {  
       event.preventDefault();
       $.ajax(
       {
       type: 'POST',
       url: 'ajax_portfolio.php',
       data: $(this).serialize(),
       dataType: 'json',
       success: function (data) 
       {
       console.log(data);
       alert("Data updated");
       }
    });
 });

</script>

<!-- IMAGE UPLOADING JS --> 

</body

</html>