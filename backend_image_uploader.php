<?php

class backendImageUpload
{

 /*function transferImage() 
  {
     $target = "js_img_test/";
     $target = $target . basename( $_FILES['photo']['name']);
     $pic=($_FILES['photo']['name']);
     //Writes the photo to the server
     if(move_uploaded_file($_FILES['photo']['tmp_name'], $target))
     {
        $return = array();
        //$return['msg'] = '';     // just to get compiler to hush up
        //$return['error'] = false;
        $return['msg'] = "Success"; 
        return json_encode($return);
     }
     else
     {
	     $return ['msg'] = "failure"; 
	     return json_encode($return);
     }   
    
  }*/
  
  function testTheory()
  {
	  $temp_path = $_FILES['photo']['tmp_name'];
	  echo "<h1> Temporary path :".$temp_path."</h1>";
	  echo '<img src = "'.$temp_path.'" width = 100px height = 100px> </img>';
	  
  }

}

$x = new backendImageUpload();
$x->testTheory();
//echo $x->transferImage();

?>
