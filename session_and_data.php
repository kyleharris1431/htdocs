<?php session_start();?>
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