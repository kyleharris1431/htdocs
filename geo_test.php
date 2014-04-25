<!DOCTYPE html>
<?php session_start(); ?>
<?php
$id ='';

  //Read your session (if it is set)
   if (isset($_SESSION['id_num']))
   {
     $id = $_SESSION['id_num'];
   }
   
   
   $zip_arr = array();
   

//echo "ID : ".$id;
$zip="";

$sql = "SELECT zip FROM more_information WHERE id = '".$id."' ; ";

echo("");
include('dAl.php');
$x = new DataAccessProtocol();

 $res_posts = $x->runQueryWithRes($sql);
	 
	// echo"<h1> <strong> WORKING... </strong> </h1>";
	 while($row_ps = mysqli_fetch_assoc($res_posts))
     { 
        $zip = $row_ps['zip'];
        
     }

//echo("Zip : ".$zip);
?>
<?php

 $arr_1 =array();
 $arr_2 =array();
class fetchZips
{
  function downloadCSV($zip , $radius)
  { 
  
  
  $url  = 'https://zipcodedistanceapi.redline13.com/rest/m61CrHmKLXipPrbCCbBg8D55SErk9w6vD785OvPAt8ZizbUbnwsv9yB2c2mlztRd/radius.csv/'.$zip.'/'.$radius.'/mile';
  $path = 'playground/newFile.csv';
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $data = curl_exec($ch);

  curl_close($ch);

  file_put_contents($path, $data);
       
  }
  
  // end of first function // 
  
  function readFile()
  {
  
    global $arr_1,$arr_2;
  
    $zips = array();
    $zi_array = array();
    

  
    $row = 1;
    
      if (($handle = fopen("playground/newFile.csv", "r")) !== FALSE) 
      {
       while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
       {
        $num = count($data);
       // echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
        for ($c=0; $c < $num; $c++)
        {
            array_push($zips, $data[$c]);
            if($c % 4 == 0)
            {
	            array_push($zi_array,$data[$c]);
            }
        }
      }
    }
    fclose($handle);
    
    /// split into two // 
    
    for($y=0; $y<sizeof($zips); $y++)
    {
	    if($y>1)
	    {
		    if($y % 2 == 0)
		    {
			    array_push($arr_1, $zips[$y]);
		    }
		    else
		    {
			    array_push($arr_2, $zips[$y]);
		    }
	    }
    }
    
    // testing code // 
    for($z=0; $z<sizeof($arr_1); $z++)
    {
	    //echo $arr_1[$z].";<br> Distance :".$arr_2[$z]."<br>";
    }
       return $zi_array;

   }
   }
  
   
  ?>
   
 <?php


  $x = new fetchZips();
  $x->downloadCSV($zip , 10);
  $zip_arr = $x->readFile();
  
  echo("UNIT TEST");
  array_shift($zip_arr);
  //var_dump($zip_arr);
  
  $id_arr = getIdsInRange($zip_arr);
  
  echo "<h1> ZIPS </h1>";
 // var_dump($id_arr);
  //echo $id_arr[0];
    
  //$names_arr = getDemNames($id_arr);
  //var_dump($names_arr);
?>

<?php


function getIdsInRange($arr)
{
   $ids  = array(); 
   
   $x = new DataAccessProtocol();

  for($y=0; $y<sizeof($arr); $y++)
  {
    $sql =  "SELECT id FROM more_information WHERE zip = '".$arr[$y]."'";
   // echo("SQL : " . $sql. " <br");
     $res_posts = $x->runQueryWithRes("SELECT id FROM more_information WHERE zip = '".$arr[$y]."'");
     //echo "Working...<br>";
     //echo $arr[$y];
	 // echo"<h1> <strong> WORKING... </strong> </h1>";
	 while($row_ps = mysqli_fetch_assoc($res_posts))
     { 
        $id_to_arr = $row_ps['id'];
        array_push($ids, $row_ps['id']);
        
     }
}

return $ids;

}

function getDemNames($id_array_names)
{

   $names  = array();    
   $x = new DataAccessProtocol();

  for($y=0; $y<sizeof($id_array_names); $y++)
  {
   // echo("SQL : " . $sql. " <br");
     $res_posts = $x->runQueryWithRes("SELECT first_name FROM users WHERE id = '".$id_array_names[$y]."' ; ");
     //echo "Working...<br>";
     //echo $arr[$y];
	 // echo"<h1> <strong> WORKING... </strong> </h1>";
	 while($row_ps = mysqli_fetch_assoc($res_posts))
     {        
      array_push($names, $row_ps['first_name']);
     }
}

return $names;
}
?>
<?php
function getProPic($thisid)
{
 $query = "SELECT * FROM posts WHERE id = '".$thisid."';";

 $fileroots = array();
 $post_texts = array();
 $liked = array();
 
 //include('dAl.php'); 
 $x = new DataAccessProtocol();
 $res = $x->runQueryWithRes($query);
 
 while($row = mysqli_fetch_array($res)) // fetch results as array and print data
 {
     // get the user's first and last name;
    array_push($fileroots, $row['file_root']); 
    array_push($post_texts,$row['post_text']);
    array_push($liked, $row['likes']);
 } 
 return $fileroots[0];    
 
}
/// put in library of functions for better orginization // 
function getUserName($userid)
{
  $x = new DataAccessProtocol();
  $res = $x->runQueryWithRes("SELECT first_name FROM users WHERE id = '".$userid."';");
 
  $first_name = '';
 while($row = mysqli_fetch_array($res)) // fetch results as array and print data
 {
    $first_name = $row['first_name'];
 }     
 
 return $first_name;
}
function getUserLastName($userid)
{
  $x = new DataAccessProtocol();
  $res = $x->runQueryWithRes("SELECT last_name FROM users WHERE id = '".$userid."';");
 
  $last_name = '';
 while($row = mysqli_fetch_array($res)) // fetch results as array and print data
 {
    $last_name = $row['last_name'];
 }     
 
 return $last_name;
}
// INTEREST MATCHING ALGORIGTHM  // 
/////////////////////////////

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
                               
                               
                               <li><a href="geo_test.php" target="_self" id="findfriends-link" class="skel-panels"><span class="fa fa-plus">Connect.</span></a></li>
                                
                               <li><a href="upload_images.php" target="_self" id="upload_imgs-link" class="skel-panels"><span class="fa fa-plus">Upload to Gallery</span></a></li>
                                
                               <li><a href="my_posts.php" target="_self" id="my-posts-link" class="skel-panels"><span class="fa fa-plus">Poster</span></a></li> 
                               <li><a href="interest_feed.php" target="_blank" id="my-posts-link" class="skel-panels"><span class="fa fa-plus">Bulletin</span></a></li> 

                               
                               
                                                                

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
								<h2 class="alt">This is <strong>Connect.</strong> Find people. </h2>
								
							  
							   <div id="hobby_div">
							   <?php for($x=0; $x<sizeOf($id_arr); $x++) { ?>
                              <div class = "hobby_container">
							  <a href="viewprofile.php?id=<?php echo $id_arr[$x]?>">
							  <img class="hobby_img" src="<?php echo getProPic($id_arr[$x]);?>">
							  </a> 
							  <?php echo getUserName($id_arr[$x])." ".getUserLastName($id_arr[$x]);?>
                              </div>
		                       <?php } ?>
							   </div>
							   
							   </header>
							
							<p>  </p>

							</div>
						</div>
					</section>
										
				<!-- Portfolio -->
					<section id="portfolio" class="two">
					
					</section>
					</div>

				<!-- About Me -->
					
			
				<!-- Contact -->
					<section id="contact" class="four">
					</section>
			
			</div>
			</div>

		<!-- Footer -->
			<div id="footer">
				
				<!-- Copyright -->
					<div class="copyright">
						<p>&copy; 2014 Buble All rights reserved.</p>
						<ul class="menu">
							<li>Design: Kyle Harris</li>
							<li>Images: <a href="http://ineedchemicalx.deviantart.com">Felicia Simion</a></li>
						</ul>
					</div>
				
			</div>
			</div>

	</body>
</html>