<!DOCTYPE HTML>
<?php session_start();?>
<?php
  $id=''; 
    
  //Read your session (if it is set)
   if (isset($_SESSION['id_num']))
   {
     $id = $_SESSION['id_num'];
   }
   
  include('dAl.php'); 
  $x = new DataAccessProtocol();
  $res = $x->runQueryWithRes("SELECT * FROM hobbies WHERE id = '".$id."';");
 
 $hobbies_arr= array(); 
 
 while($row = mysqli_fetch_array($res)) // fetch results as array and print data
 {
    $hobbies_arr[0] = $row['hobby_1'];
    $hobbies_arr[1] = $row['hobby_2'];
    $hobbies_arr[2] = $row['hobby_3'];
    $hobbies_arr[3] = $row['hobby_4'];
    $hobbies_arr[4] = $row['hobby_5'];
  }     

/////////////////////////////

     //GLOBALS//
$hobby_1 = $hobbies_arr[0];
$hobby_2 = $hobbies_arr[1];
$hobby_3 = $hobbies_arr[2];
$hobby_4 = $hobbies_arr[3];
$hobby_5 = $hobbies_arr[4];

/////////////////////////////
/*for($x=0; $x<sizeOf($hobbies_arr); $x++)
{
  echo("Hobby ".$x." = ".$hobbies_arr[$x]."<br>"); // testing code
}*/


$hobbiesString = $hobbies_arr[0].", ".$hobbies_arr[1].", ".$hobbies_arr[2].", ".$hobbies_arr[3].", ".$hobbies_arr[4];

echo("Hobbies String: ".$hobbiesString);

// we will have to cycle through all that contain 1 match, AKA the first 
// hobby, we have to get a group of values that contain it and then further filter. 
// to do that we can use this sql statement: Select id from hobbies where Concat(hobby_1, '', hobby_2, '', hobby_3, '', hobby_4 , '', hobby_5) like "%hobbies_arr[0]%"//

// now we can list all people who contain atleast one interest - 

$sql_hobby_match = "Select id from hobbies where Concat(hobby_1, '', hobby_2, '', hobby_3, '', hobby_4,'',hobby_5) like '%".$hobbies_arr[0]."%';";
// time to run this query and push it to an array. 
$first_hobby_match = array(); 

$y = new DataAccessProtocol();

$one_hobby = $y->runQueryWithRes($sql_hobby_match); 
while($row = mysqli_fetch_array($one_hobby)) // fetch results as array and print data
{
    array_push($first_hobby_match, $row['id']);
}
// checking if this worked // 
echo "<hr> <br> <br>Matching ID numbers:  <br>";
for($x=0; $x<sizeOf($first_hobby_match); $x++)
{ 
 echo "ID #:".$first_hobby_match[$x]."<br>";
}


/// now we can search for more than one value && for hobbies, I would Like to have two matches // 
// so if hobby 2-5 are contained w/in any from fields 1-5 we are good to go. 
// now that we have the values in the array that we want, we can somehow iterate over those elements to see if there is a match

// we can do this : create a string of hobbies & then try to find substring matches, and if that is true, then there is also a 
// match. This way we can also have a ticker.


// FUNCTION TO COUNT MATCHES; TAKES AN IDNUM FROM ARRAY AND COUNTS MATCHES // 

// this needs to be mainpulated so it loops through 

$confirmed_matches = array(); 
$num_matches = array(); 


for($x=0; $x<sizeOf($first_hobby_match); $x++)
{
   if($first_hobby_match[$x]!=$id)
   {
     if(countHobbyMatches($first_hobby_match[$x]>=2))
     {
	     array_push($confirmed_matches, $first_hobby_match[$x]);
	     array_push($num_matches, countHobbyMatches($first_hobby_match[$x]));
     }
     //echo countMatches($first_hobby_match[$x]);
   }
}


echo("<h1> <center>TESTING MATCHING ALGORITHM </center> </h1>"); 
echo "<br>";

for($x=0; $x<sizeOf($confirmed_matches);$x++)
{
   echo "<br> CONFIRMED MATCH - ID# : ".$confirmed_matches[$x] , " / NUMBER MATCHES OF HOBBIES BETWEEN USERS : ".$num_matches[$x];
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function countHobbyMatches($idnum)// param $idnum
{
//  WE NEED TO DECLARE GLOBALS SO THEY CAN BE ACCESSED W/IN THIS FUNCTION//
$local_hobby_1 = $GLOBALS['hobby_1'];
$local_hobby_2 = $GLOBALS['hobby_2'];
$local_hobby_3 = $GLOBALS['hobby_3'];
$local_hobby_4 = $GLOBALS['hobby_4'];
$local_hobby_5 = $GLOBALS['hobby_5'];
//////////////////////// END OF GLOBAL DECLARATION ////////////////////////
// include('dAl.php');
 $z = new DataAccessProtocol();
 $res = $z->runQueryWithRes("SELECT * FROM hobbies WHERE id = '".$idnum."';"); // nth hobbies
 
 $matches = 1 ;
 //////////// creating second string /////////
 $hobbies_2_arr= array(); 
 
 while($row = mysqli_fetch_array($res)) // fetch results as array and print data
 {
    $hobbies_2_arr[0] = $row['hobby_1'];
    $hobbies_2_arr[1] = $row['hobby_2'];
    $hobbies_2_arr[2] = $row['hobby_3'];
    $hobbies_2_arr[3] = $row['hobby_4'];
    $hobbies_2_arr[4] = $row['hobby_5'];
  }    
  
 $second_string  = $hobbies_2_arr[0].$hobbies_2_arr[1].$hobbies_2_arr[2].$hobbies_2_arr[3].$hobbies_2_arr[4];
 // end of second string creation // 
 
 // time to see matches // 
 if(strpos($second_string,$local_hobby_2) !== false) 
 {
    // echo 'true'; 
     $matches++;
    
 }
 if (strpos($second_string,$local_hobby_3) !== false) 
 {
    // echo 'true'; 
     $matches++;
    
 }
 if (strpos($second_string,$local_hobby_4) !== false) 
 {
    // echo 'true'; 
     $matches++;
 }
 if (strpos($second_string,$local_hobby_5) !== false) 
 {
    // echo 'true'; 
     $matches++;
 } 
  
  return $matches; 
}
// END OF MATCH COUNTING // /////
// we can now use the same structure of algorithm to match people based on interests  ///
function getUserPictureRoot($userid)
{
  $x = new DataAccessProtocol();
  $res = $x->runQueryWithRes("SELECT main_picture FROM main_pictures_2 WHERE id = '".$userid."';");
 
  $root = '';
 while($row = mysqli_fetch_array($res)) // fetch results as array and print data
 {
    $root = $row['main_picture'];
 }     
 
 return $root;
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



$zx = new DataAccessProtocol();
$res = $zx->runQueryWithRes("SELECT * FROM interests WHERE id = '".$id."';");
 

 $interest_arr= array(); 
 
 while($row = mysqli_fetch_array($res)) // fetch results as array and print data
 {
    $interest_arr[0] = $row['interest_1'];
    $interest_arr[1] = $row['interest_2'];
    $interest_arr[2] = $row['interest_3'];
    $interest_arr[3] = $row['interest_4'];
    $interest_arr[4] = $row['interest_5'];
    $interest_arr[5] = $row['interest_6'];
    $interest_arr[6] = $row['interest_7'];
    $interest_arr[7] = $row['interest_8'];
    $interest_arr[8] = $row['interest_9'];
    $interest_arr[9] = $row['interest_10'];

  }     

/////////////////////////////

     //GLOBALS//
$interest_1 = $interest_arr[0];
$interest_2 = $interest_arr[1];
$interest_3 = $interest_arr[2];
$interest_4 = $interest_arr[3];
$interest_5 = $interest_arr[4];
$interest_6 = $interest_arr[5];
$interest_7 = $interest_arr[6];
$interest_8 = $interest_arr[7];
$interest_9 = $interest_arr[8];
$interest_10 = $interest_arr[9];

/////////////////////////////
/*for($x=0; $x<sizeOf($hobbies_arr); $x++)
{
  echo("Hobby ".$x." = ".$hobbies_arr[$x]."<br>"); // testing code
}*/


$interestString = $interest_arr[0].", ".$interest_arr[1].", ".$interest_arr[2].", ".$interest_arr[3].", ".$interest_arr[4].",".$interest_arr[5].", ".$interest_arr[6].", ".$interest_arr[7].", ".$interest_arr[8].", ".$interest_arr[9]; // tweak

echo("Interest String: ".$interestString);

// we will have to cycle through all that contain 1 match, AKA the first 
// hobby, we have to get a group of values that contain it and then further filter. 
// to do that we can use this sql statement: Select id from hobbies where Concat(hobby_1, '', hobby_2, '', hobby_3, '', hobby_4 , '', hobby_5) like "%hobbies_arr[0]%"//

// now we can list all people who contain atleast one interest - 

$sql_interest_match = "Select id from interests where Concat(interest_1,'', interest_2, '',interest_3, '', interest_4,'',interest_5,'',interest_6,'',interest_7,'',interest_8,'',interest_9,'',interest_10) like '%".$interest_arr[0]."%';";
// time to run this query and push it to an array. 
$first_interest_match = array(); 

$z = new DataAccessProtocol();

$one_interest = $z->runQueryWithRes($sql_interest_match); 
while($row = mysqli_fetch_array($one_interest)) // fetch results as array and print data
{
    array_push($first_interest_match, $row['id']);
}
// checking if this worked // 
echo "<hr> <br> <br>Matching ID numbers:  <br>";
for($x=0; $x<sizeOf($first_interest_match); $x++)
{ 
 echo "ID #:".$first_interest_match[$x]."<br>";
}


/// now we can search for more than one value && for hobbies, I would Like to have two matches // 
// so if hobby 2-5 are contained w/in any from fields 1-5 we are good to go. 
// now that we have the values in the array that we want, we can somehow iterate over those elements to see if there is a match

// we can do this : create a string of hobbies & then try to find substring matches, and if that is true, then there is also a 
// match. This way we can also have a ticker.


// FUNCTION TO COUNT MATCHES; TAKES AN IDNUM FROM ARRAY AND COUNTS MATCHES // 

// this needs to be mainpulated so it loops through 

$confirmed_interest_matches = array(); 
$num_interest_matches = array(); 


for($x=0; $x<sizeOf($first_interest_match); $x++)
{
   if($first_interest_match[$x]!=$id)
   {
     if(countInterestMatches($first_interest_match[$x]>=2))
     {
	     array_push($confirmed_interest_matches, $first_interest_match[$x]);
	     array_push($num_interest_matches, countInterestMatches($first_interest_match[$x]));
     }
     //echo countMatches($first_hobby_match[$x]);
   }
}


echo("<h1> <center>TESTING INTEREST MATCHING ALGORITHM </center> </h1>"); 
echo "<br>";

for($x=0; $x<sizeOf($confirmed_interest_matches);$x++)
{
   echo "<br> CONFIRMED INTEREST MATCH - ID# : ".$confirmed_interest_matches[$x] , " / NUMBER MATCHES OF INTERESTS BETWEEN USERS : ".$num_interest_matches[$x];
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function countInterestMatches($idnum)// param $idnum
{
//  WE NEED TO DECLARE GLOBALS SO THEY CAN BE ACCESSED W/IN THIS FUNCTION//
$local_interest_1 = $GLOBALS['interest_1'];
$local_interest_2 = $GLOBALS['interest_2'];
$local_interest_3 = $GLOBALS['interest_3'];
$local_interest_4 = $GLOBALS['interest_4'];
$local_interest_5 = $GLOBALS['interest_5'];
$local_interest_6 = $GLOBALS['interest_6'];
$local_interest_7 = $GLOBALS['interest_7'];
$local_interest_8 = $GLOBALS['interest_8'];
$local_interest_9 = $GLOBALS['interest_9'];
$local_interest_10 = $GLOBALS['interest_10'];
//////////////////////// END OF GLOBAL DECLARATION ////////////////////////
// include('dAl.php');
 $zz = new DataAccessProtocol();
 $res_2 = $zz->runQueryWithRes("SELECT * FROM interests WHERE id = '".$idnum."';"); // nth hobbies
 
 $matches = 1 ;
 //////////// creating second string /////////
 $interest_2_arr= array(); 
 
 while($row = mysqli_fetch_array($res_2)) // fetch results as array and print data
 {
    $interest_2_arr[0] = $row['interest_1'];
    $interest_2_arr[1] = $row['interest_2'];
    $interest_2_arr[2] = $row['interest_3'];
    $interest_2_arr[3] = $row['interest_4'];
    $interest_2_arr[4] = $row['interest_5'];
    $interest_2_arr[5] = $row['interest_6'];
    $interest_2_arr[6] = $row['interest_7'];
    $interest_2_arr[7] = $row['interest_8'];
    $interest_2_arr[8] = $row['interest_9'];
    $interest_2_arr[9] = $row['interest_10'];

 }    
  
$second_interest_string  = $interest_2_arr[0].$interest_2_arr[1].$interest_2_arr[2].$interest_2_arr[3].$interest_2_arr[4].$interest_2_arr[5].$interest_2_arr[6].$interest_2_arr[7].$interest_2_arr[8].$interest_2_arr[9];
 // end of second string creation // 
 
 // time to see matches // 
 if(strpos($second_interest_string,$local_interest_2) !== false) 
 {
    // echo 'true'; 
     $matches++;
    
 }
 if (strpos($second_interest_string,$local_interest_3) !== false) 
 {
    // echo 'true'; 
     $matches++;
    
 }
 if (strpos($second_interest_string,$local_interest_4) !== false) 
 {
    // echo 'true'; 
     $matches++;
 }
 if (strpos($second_interest_string,$local_interest_5) !== false) 
 {
    // echo 'true'; 
     $matches++;
 } 
 
 if (strpos($second_interest_string,$local_interest_6) !== false) 
 {
    // echo 'true'; 
     $matches++;
 } 
 if (strpos($second_interest_string,$local_interest_7) !== false) 
 {
    // echo 'true'; 
     $matches++;
 } 
 if (strpos($second_interest_string,$local_interest_8) !== false) 
 {
    // echo 'true'; 
     $matches++;
 } 
 if (strpos($second_interest_string,$local_interest_9) !== false) 
 {
    // echo 'true'; 
     $matches++;
 } 
 if (strpos($second_interest_string,$local_interest_10) !== false) 
 {
    // echo 'true'; 
     $matches++;
 } 

  
  return $matches; 
}




/// END OF INTEREST MATCHING ALGORITHM // 
?>
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
   
   //include('dAl.php'); 
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
								<h2 class="alt">This is the <strong>connect</strong> page. It's a place where you can find others that share similar interests to you.	</header> 
							
								<h3> <center>  Our matching algorithm will pick the people that share genuine interests and hobbies with you. Just select a fellow user and start up a conversation. You'll probably get along! - BestBrightLight Team
								</center></h3>
							
							</div>
					</section>
					
				<!-- Portfolio -->
					<section id="portfolio" class="two">
						<div class="container">
					
							<header>
								<h2>People Who Share Hobbies</h2>
							</header>
							 <div id="hobby_div">
                              <?php for($x=0; $x<sizeOf($confirmed_matches); $x++) { ?>
                              <div class = "hobby_container">
							  <img class="hobby_img" src="<?php echo getUserPictureRoot($confirmed_matches[$x]); ?>"> 
							  <?php echo getUserName($confirmed_matches[$x])." ".getUserLastName($confirmed_matches[$x]);?>
                              </div>
		                       <?php } ?>
                             </div>
							
			</section> 

				<!-- About Me -->
					<section id="about" class="three">
						<header> 
						<h2> People Who share interests </h2>
						</header>
						 <div id="hobby_div">
                              <?php for($x=0; $x<sizeOf($confirmed_interest_matches); $x++) { ?>
                              <div class = "hobby_container">
							 <a href="viewprofile.php?id=<?php echo $confirmed_interest_matches[$x]?>">
							 <img class="hobby_img" src="<?php echo getUserPictureRoot($confirmed_interest_matches[$x]); ?>"> 
							 </a> 
							  <?php echo getUserName($confirmed_interest_matches[$x])." ".getUserLastName($confirmed_interest_matches[$x]);?>
                              </div>
		                       <?php } ?>

					</section>
			

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