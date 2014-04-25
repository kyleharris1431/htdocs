<?php

class backendImageUpload
{

 function transferImage() 
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
    
  }
  
}

$x = new backendImageUpload();

//echo $x->transferImage();

?>
