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
?>

<?php

$proud_text = $_POST['proud_textarea'];

$fileUpload  = new fileUploder();
$path = $fileUpload->uploadFile();
$new_post_query = "INSERT INTO posts VALUES ('".$id."', '".$path."' , '".$proud_text."','0');";
runQueryWithRes($new_post_query);

echo "<script>window.location = 'http://localhost:8888/my_posts.php'</script>";
 //header('Location: http://localhost:8888/my_posts.php');


class fileUploder
{
function uploadFile()
{


     $target = "js_img_test/";
     $target = $target . basename( $_FILES['file_input']['name']);
     $pic=($_FILES['file_input']['name']);
     //Writes the photo to the server
     if(move_uploaded_file($_FILES['file_input']['tmp_name'], $target))
     {
        //echo "<h1> FILE UPLOAD SUCCESSFUL <h1> ";
     }
     else
     {
       ////echo "<h1> FUCK! </h1>";
     }  
     
    return $target;
    }
}

function runQueryWithRes($query)
{

   $host = "localhost";
   $user = "root";
   $pass = "root";
   $db = "social";
   $sql = $query;
   //echo "QUERY  : " . $sql;
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

?>
