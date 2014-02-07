<?php include('session_and_data.php') ?> 

<?php
// init code to have interests fields have hint values or initial values
$host      = DataAccessProtocol::host;
$user      = DataAccessProtocol::user;
$db_pass   = DataAccessProtocol::pass;
$dbName    = DataAccessProtocol::db;

$x = new DataAccessProtocol();
$res = $x->runQueryWithRes("SELECT * FROM hobbies WHERE id = '".$id."';");
 
 
$hobbies_array = array();
 
while($row = mysqli_fetch_array($res)) // fetch results as array and print data
{
     // get the user's first and last name;
     $hobbies_array[0] = $row['hobby_1'];
     $hobbies_array[1] = $row['hobby_2'];
     $hobbies_array[2] = $row['hobby_3'];
     $hobbies_array[3] = $row['hobby_4'];
     $hobbies_array[4] = $row['hobby_5'];
} 

$interest_array = array(); 

$res_2 = $x->runQueryWithRes("SELECT * FROM interests WHERE id = '".$id."';");

while($row = mysqli_fetch_array($res_2))
{
     $interest_array[0] = $row['interest_1'];
     $interest_array[1] = $row['interest_2'];
     $interest_array[2] = $row['interest_3'];
     $interest_array[3] = $row['interest_4'];
     $interest_array[4] = $row['interest_5'];
     $interest_array[5] = $row['interest_6'];
     $interest_array[6] = $row['interest_7'];
     $interest_array[7] = $row['interest_8'];
     $interest_array[8] = $row['interest_9'];
     $interest_array[9] = $row['interest_10'];
} 





// testing // 
  
/* for($x=0; $x<sizeof($hobbies_array); $x++) 
{
 echo " <br> Testing : ".$hobbies_array[$x];
} */  
 


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
			<link rel="stylesheet" href="css/kickstart.css" />
		</noscript>
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie8.css" /><![endif]-->
	</head>
	
	
<body>


<div id = "container">
<center>
<div class= "main">
<img src="images/pic_08.jpg" alt=""  class="image featured"/>
<p>This is your <strong>interest</strong> page. It is where you put what makes you, <strong>you.</strong>
If you are into horseback riding, tell us here. If you love sports, tell us which ones. Specify anything that makes you different from everyone else. This is how we will connect you to other, like minded people.
</p> 
</div>

<div class="generic_interest_heading">

<center> <h1 class="heading"><strong> Hobbies </strong> </h1> </center>

<center>

<p> What are some of your <strong>hobbies</strong>, things you enjoy doing? If you had a free day off of work or school what would you want to be doing? Tell us your top 5 favorite pastimes here! 
</p> 

<form id = "hobby_form">
<input type="text" id = "hobby_1" name="hobby_1" value="<?php echo $hobbies_array[0]?>"> <span> Hobby 1 </span> <br> <br> 
<input type="text" id = "hobby_2" name="hobby_2" value="<?php echo $hobbies_array[1]?>"> <span> Hobby 2 </span> <br> <br> 
<input type="text" id = "hobby_3" name="hobby_3" value="<?php echo $hobbies_array[2]?>"> <span> Hobby 3 </span> <br> <br> 
<input type="text" id = "hobby_4" name="hobby_4" value="<?php echo $hobbies_array[3]?>"> <span> Hobby 4 </span> <br> <br> 
<input type="text" id = "hobby_5" name="hobby_5" value="<?php echo $hobbies_array[4]?>"> <span> Hobby 5 </span> <br> <br>
<button type="submit" class="blue" id = "interest_submit"> Submit Hobbies!</button> 
</form>

</center>
</div>
<br>
<hr>

<div class="generic_interest_heading">

<center> <h1 class="heading"><strong> Interests </strong> </h1> </center>

<center>

<p> What are some of your <strong>interests</strong>, things you find fascinating? For example if you like horseback riding, let us know. If you like sports, tell us which ones you love. This is how we will connect you to other people with similar interests. Choose ten of your favorite things. Choose what captivates your attention</p>
</center> 

<form id = "interest_form">
<input type="text" id = "interest_1" name="interest_1" value="<?php echo $interest_array[0] ?>"> <span>   Interest 1 </span> <br> <br> 
<input type="text" id = "interest_2" name="interest_2" value="<?php echo $interest_array[1] ?>"> <span>   Interest 2 </span> <br> <br> 
<input type="text" id = "interest_3" name="interest_3" value="<?php echo $interest_array[2] ?>"> <span>   Interest 3 </span> <br> <br> 
<input type="text" id = "interest_4" name="interest_4" value="<?php echo $interest_array[3] ?>"> <span>   Interest 4 </span> <br> <br> 
<input type="text" id = "interest_5" name="interest_5" value="<?php echo $interest_array[4] ?>"> <span>   Interest 5 </span> <br> <br>
<input type="text" id = "interest_6" name="interest_6" value="<?php echo $interest_array[5] ?>"> <span>   Interest 6 </span> <br> <br> 
<input type="text" id = "interest_7" name="interest_7" value="<?php echo $interest_array[6] ?>"> <span>   Interest 7 </span> <br> <br> 
<input type="text" id = "interest_8" name="interest_8" value="<?php echo $interest_array[7] ?>"> <span>   Interest 8 </span> <br> <br> 
<input type="text" id = "interest_9" name="interest_9" value="<?php echo $interest_array[8] ?>"> <span>   Interest 9 </span> <br> <br> 
<input type="text" id = "interest_10" name="interest_10" value="<?php echo $interest_array[9] ?>"> <span> Interest 10 </span> <br> <br>
<button type="sumbit" class="blue" id = "interest_submit">       Submit Interests!</button> 
</form>
</center>
</div>

<hr>

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

// Basic Hide spans 
$('span').hide();

$('input').focus(function()
{
 $(this).next().fadeIn("slow");
 
}).blur(function() 
{ 
  $(this).next().hide();
});

// Start of AJAX calls 
$('#interest_form').submit(function(event) 
     {  
       event.preventDefault();
       $.ajax(
       {
       type: 'POST',
       url: 'ajaxinterests.php',
       data: $(this).serialize(),
       dataType: 'json',
       success: function (data) 
       {
       console.log(data);
       alert("Interests Updated! :)")
       }
    });
 });////
 
 $('#hobby_form').submit(function(event) 
     {  
       event.preventDefault();
       $.ajax(
       {
       type: 'POST',
       url: 'ajax_hobbies.php',
       data: $(this).serialize(),
       dataType: 'json',
       success: function (data) 
       {
       console.log(data);
       alert("Hobbies Updated! :)")
       }
    });
 });////

</script> 


</body>		


</html>