<?php session_start(); ?>

<?php 
/////////////// POST VARIABLES ///////////////
// FIRSTNAME, LASTNAME, EMAIL, PASSWORD
$firstname = $_POST['entered_first_name'];
$lastname  = $_POST['entered_last_name'];
$email     = $_POST['entered_email'];
$pass      = $_POST['entered_pass'];
///////////////////////////////////////////////
////// TEXTAREA VALUES ////////
$one_year_field   = $_POST['one_year_entered_text'];
$one_year_goals   = explode(",", $one_year_field);

$three_year_field   = $_POST['three_year_entered_text'];
$three_year_goals   = explode(",", $three_year_field);

$five_year_field = $_POST['five_year_entered_text'];
$five_year_goal  = explode("," , $five_year_field);

$passion_field = $_POST['passions_entered_text'];
$passions_arr  = explode(",", $passion_field);

$proud_text    = $_POST['proud_text'];              // also first post critera 

//// CHECKED VALUES ////
$checked_vals = $_POST['checked_checkboxes']; 
$checked_array = explode("," , $checked_vals); 

echo "<h1> Checked boxes : ".var_dump($checked_array) . "</h1>";
//

echo  "Passions CHECK : ".$passion_field;
echo "<br> One year : ".$one_year_field;
echo "<br> three year : ".$three_year_field;
echo "<br> five year : ".$five_year_field;

/// DATABASE NAME = flep_passions_test /// 
//uploadFile();
/////// END OF POST VARIABLE DECLARATION //////////

// I will thank me later for throwing this in an array.//

echo "<h1> <center> TEST </center> </h1>";
$flepArr = array();
$flepArr[0] = $firstname; 
$flepArr[1] = $lastname; 
$flepArr[2] = $email; 
$flepArr[3] = $pass;  
// and I do //


$x = new letsGetOrginized;
$x->doFleps();

echo "ID = ".$x->getId();
$tableId = $x->getId();

insertPassions($tableId , $passions_arr);

$x->insertPreliminaries();


// THE REST OF THE POST VARIABLES // 

// Since we now have the data, we can now insert the values into our db. But this function 
// should only fire if all the fields are filled out. I knew I would thank my self
// for putting the data in a loop. And when the hell am I going to learn how to write
// block comments? /* lol */
         
         echo "flep test : <br>";
         
         for($x=0; $x<sizeOf($flepArr); $x++)
         {
	         echo $flepArr[$x]."<br>"; 
	         
         } 
         
         /// FOR THE GOALS DB, IM JUST GOING TO THROW GOALS IN TO A DB AND MATCH CORRESPONDING ID'S(HADOOP?)// 
         
         /* TABLE STRUCTURE */ 
         
         /*  
	         --------------------------- 
	         |            |             |
	         |   $id's    |   $goals    | // (goals are 1-5)
	         |____________|_____________|
	         |                          |
	         |    1       |     5       |
	         |    69      |     4       |
	         |    77      |     1       |
	         |    77      |     2       |
	         |    1045    |     3       |
	         |    1045    |     4       |
	         |    1045    |     5       |
	         |    77      |     5       |
	         ----------------------------
	         
	   */
               
          
class letsGetOrginized
{

function doFleps()
{
   global $flepArr;
   $sql = "INSERT INTO users VALUES('NULL', '".$flepArr[0]."', '".$flepArr[1]."' , '".$flepArr[2]."', '".$flepArr[3]."');";
   runQueryWithRes($sql);
 }
 
 function getId ()
 {
  global $flepArr;   
  
  $sql = "SELECT id FROM users WHERE first_name = '".$flepArr[0]."' AND last_name = '".$flepArr[1]."' and password = '".$flepArr[3]."';";
  $res = runQueryWithRes($sql);

  $id = '';
  
  while($row = mysqli_fetch_array($res)) // fetch results as array and print data
  {
  $id =  $row['id'];
  }
  return  $id;
 }
 
 function insertPreliminaries()// this is bad practise in terms of efficeny and cost, but for a prototype, IDRC, not applicable // 
{
 $aboutme = "Tell the world about you in a positive way. What are some interests, goals, hobbies
                etc? If you think you are awesome, you most likely are. So write about your pure awesomeness here. Show the world your BestBrightLight. - Make yourself unique in a world of similarity";
                
 $portfolio = "This is where you will show your proof of awesomeness. - If you display your genius musically, post a video of you singing or in an orchestra. If you are into working on cars show us a video of your best 1/4 mile at the track. If you play sports put up some team pictures. Literally anything can go on here, put up what makes you, YOU.";
                
  $sql_2 = "INSERT INTO user_info_2 VALUES ('NULL','What are you? Make it creative','".$aboutme."','".$portfolio."');";
  runQueryWithRes($sql_2);

}

}   



function insertPassions($id , $arr) 

{
  echo "<br> <h1> PASSION TESTING </h1> <br>";
  for($x=0; $x<sizeOf($arr); $x++)
  {
  echo "ID : ".$id." Passion: ".$arr[$x]; 
  $sql = "INSERT INTO flep_passions_test VALUES ('".$id."' , '".$arr[$x]."');";
  runQueryWithRes($sql);
  }
}


function runQueryWithRes($query)
{

   $host = "localhost";
   $user = "root";
   $pass = "root";
   $db = "social";
   $sql = $query;
   echo "QUERY  : " . $sql;
   $cxn = mysqli_connect($host , $user , $pass , $db);
   $res = mysqli_query($cxn , $sql);
   
  // $res_2 = mysql_result($res)
  if (!$res) 
  {
    printf("Error: %s\n", mysqli_error($cxn));
    exit();
  }
  return $res;

}

echo"<h1> <center> POST TEST </h1> </center>";
var_dump($_POST);
echo"<h1> <center> FILES TEST </h1> </center>";

var_dump($_FILES);
$fileUpload  = new fileUploder();
$path = $fileUpload->uploadFile();

echo "PATH OF FILE :".$path;
$y = new letsGetOrginized();
$this_id = $y->getId();
$posts_query = "INSERT INTO posts VALUES ('".$this_id."', '".$path."' , '".$proud_text."','0');";
runQueryWithRes($posts_query);
?>
<?php
class fileUploder
{
function uploadFile()
{
 // this will also be profile picture for simplicity // 

     $target = "js_img_test/";
     $target = $target . basename( $_FILES['file_input']['name']);
     $pic=($_FILES['file_input']['name']);
     //Writes the photo to the server
     if(move_uploaded_file($_FILES['file_input']['tmp_name'], $target))
     {
        echo "<h1> FILE UPLOAD SUCCESSFUL <h1> ";
     }
     else
     {
       echo "<h1> Unsuccessful </h1>";
     }  
     
    return $target;
    }
}
?>

<!--
	Prologue 1.1 by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
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
							
							<h1 align="center"><strong> <?php echo $firstname; ?>, your account creation was successful</h1> 
							
							<h3> You can now log-in to <strong> BestBrightLight </strong></h3>
							<br>
							
							<form method="post" action="login.php">
							
							<p>Email address : <input type="text" id = "email" name = "email"/> </p>
							<p>Password :<input type="password" id = "password" name = "password"/> </p>
							<input type="submit" value="Log-In"/>
							</form>
							
							
		<!-- Footer -->
			<div id="footer">
				
				<!-- Copyright -->
					<div class="copyright">
						<p>&copy; 2014 BestBrightLight All rights reserved.</p>
						<ul class="menu">
							<li>Design: BBL Team</li>
							<li>Images: <a href="http://ineedchemicalx.deviantart.com">Felicia Simion</a></li>
						</ul>
					</div>
				
			</div>

	</body>
</html>
