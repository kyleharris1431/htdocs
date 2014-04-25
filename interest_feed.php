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
 

 include('dAl.php'); 
 $x = new DataAccessProtocol();
 $res = $x->runQueryWithRes($query);
  
 // we shall now do things // 
 $passions_arr = array();
 $sql_passions = "SELECT passion FROM flep_passions_test WHERE id = '".$id."'";
 $res_passions = $x->runQueryWithRes($sql_passions);
 
 while($row_passion = mysqli_fetch_assoc($res_passions))
 { 
    array_push($passions_arr , $row_passion['passion']);
 }
 
 var_dump($passions_arr);
 
 $array_of_ids = array();
 
 for($y =0; $y<sizeof($passions_arr); $y++)
 {
	 $sql_ids = "SELECT id FROM interest_tags WHERE tag = '".$passions_arr[$y]."'";
	 $res_ids = $x->runQueryWithRes($sql_ids);
	 
	 while($row_ids = mysqli_fetch_assoc($res_ids))
     { 
      array_push($array_of_ids , $row_ids['id']);
     }
 }
 
// echo "<br> <br> <center>IDS : ".var_dump($array_of_ids)."</center>"; 

// variables we need for post 
$authors = array();
$post_texts = array();
$post_files = array();

// here are the variables we need


echo "<h1> SIZE OF ARRAY : ".sizeof($array_of_ids);

for($yz=0; $yz<sizeof($array_of_ids); $yz++)
{
 echo "ID :".$array_of_ids[$yz];
}


for($z=0; $z<sizeof($array_of_ids); $z++)
{
   $sql_for_posts  = "SELECT * FROM interest_posts WHERE id  = '".$array_of_ids[$z]."' ;";
   $res_posts = $x->runQueryWithRes($sql_for_posts);
	 
	 echo"<h1> <strong> WORKING... </strong> </h1>";
	 while($row_ps = mysqli_fetch_assoc($res_posts))
     { 
      array_push($authors,$row_ps['author']);
      array_push($post_texts, $row_ps['post_text']);
      array_push($post_files, $row_ps['post_file']);
     }
 
}
 
 
$post_author;

$firstname;
$lastname;

 $name_res = $x->runQueryWithRes("SELECT * FROM users WHERE id = '".$id."'");

 while($name_row = $name_res->fetch_assoc())
 {
	$firstname = $name_row['first_name'];
	$lastname  = $name_row['last_name'];
 }
 
$post_author = $firstname." ".$lastname; 

  
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>BuBL</title>
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
height:auto;
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

.comments_div
{
 background: rgba(190,192,173,0.6);
 border-radius: 12px;
}
.comments
{
display: none;
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
								<h2 class="alt">This is the <strong> passion feed </strong> We will only return posts that genuinely  interest you.</h2>
							</header>
							
						<div id = "new_post_div">
					
						 <form id = "file_form" method="post" action="new_interest_post.php" class="login_form" enctype="multipart/form-data">
                          <div>
                          <img src ="" width="75%"height="90%" id = "preview">              
                          <input type="file" id="file_input" onchange="showPreview()" name = "file_input">
                          </p>
                          </div>
                          <!--<img class="placeholder" id = "img_placeholder"> -->
                          <textarea id = "p" name="p">Description</textarea>	
                          <br>
                         <p> <strong> Tags : </strong> <input type="text" id = "tags" name = "tags"/> </p>
                          <p align="center"><input type="submit" value="Post to bulletin."/> </p>	
                          </form>					
						</div>
						
						    <br>
						    <br>
							<hr>
						<?php for($z=0; $z<sizeof($authors); $z++) {?>
						
						  <div class="poster_div">
						  
						  <p align="left" class="author"> <?php echo $authors[$z] ?> </p>
						  <div class = "content_div">
						  <img src ="<?php echo $post_files[$z];?>" class="post_img"/>
						  <p class ="post_text"><?php echo $post_texts[$z];?> <br> </p>	
						  </div>
						  <hr>
						  <div class="comments_div">
						  <br>
						  
						  <form class = "post_form" action="">
						  <input type="hidden" value="<?php echo $post_author?>" class = "hidden_author">
						  <input type="hidden" value="<?php echo $array_of_ids[$z]?>" class = "hidden_id">
						  <textarea style="width: 90%; height: 20%;" class="comment_poster">Post a comment</textarea>
						  <center class="center"><input  class = "comment_post" type="button" value="Post"/></center>
						  </form>
						  
						  <hr>
						  <p align="left"> <button class="show_comments" onclick=""> Show Comments </button> </p>
						  <div class = "comments">
						  <?php 
						  // for int x=0 size of current array element in two sided array // print
						  //echo "<p> ID : ".$array_of_ids[$z]."</p>";
						  // special query // 
						  $dynamic_res = $x->runQueryWithRes("SELECT * FROM comments WHERE id = '".$array_of_ids[$z]."'");
						  while($dynamic_row = $dynamic_res->fetch_assoc())
						  {
							  echo "<hr><p align='left'>".$dynamic_row['author']."<br> Comment : &nbsp;".$dynamic_row['comment'];
						  }
						  
						  ?>
						  </div>
						   <! -- USE A 2-D array to get comments -- > 
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
$('.show_comments').click(function()
{
 // alert("YOU CLICKED ME NIGGA!");
$(this).parent().next('.comments').slideDown(); 
});
</script>


<script type="text/javascript">
$('.comment_post').click(function()
{
 //alert($(this).parent().parent().attr('class'));
 var author = $(this).parent().parent().children('.hidden_author').val();
 var id = $(this).parent().parent().children('.hidden_id').val();
 var comment  = $(this).parent().parent().children('.comment_poster').val();

// alert(author);
 //alert(id);
 //alert(comment);
 
 $('#hidden_id').val(author);
 $('#hidden_author').val(id);
 $('#hidden_comment').val(comment);
 
 console.log("HIDDEN ID :" + $('#hidden_id').val());
 console.log("HIDDEN Author :" + $('#hidden_author').val());
 console.log("HIDDEN Comment :" + $('#hidden_comment').val());
  
  //$('#hidden_post_form').submit();
  // ajax call for hidden form // 
   $.ajax
   (
   {
    type: 'POST',
    url: 'post_comment.php',
    data: $('#hidden_post_form').serialize(),
    dataType: 'json',
    success: function (data) 
    {
     console.log(data);
     alert("Comment posted");
     location.reload();
    }
    });
});

</script>
<form id = "hidden_post_form" method="post"  onsubmit="sayHi()">
<input type="hidden" id = "hidden_id" name="hidden_id" value="">
<input type="hidden" id = "hidden_author" name="hidden_author" value="">
<input type="hidden" id = "hidden_comment" name="hidden_comment" value="">
</form>



	</body>
</html>