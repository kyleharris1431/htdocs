<?php
 
class layouts
{
    function getAfterLoginLayout()
    {
      $after ='Thank you for creating an account on Best<strong>Bright</strong>Light. <br> You can now log-in! <br> <form action ="login.php" method="post"> 
          <label>E Mail:</label>
          <input type = "text" name = "email" id = email/> <br>
          <label> Password:</label> 
          <input type = "password" name = "password" id="password"/>
          <br> <input type = "submit"> 
          </form>';
        
      return $after;
    }
    
    
}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

// after ajax 

/*$part1 = '';
$part2 = ''; 
  // formclass div //
$part3 = '<div class = "formclass">';
$part4 = '<label> Email: </label> <br> <input type = "text"> <br>';
$part5  = '<label> Password:</label> <br> <input type="text"> <br> </div>';
$part6 = '<br> <br> <input type = submit value = "Login!" >';*/

 


 
?>
