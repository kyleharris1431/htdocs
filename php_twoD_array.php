<?php 
class commenter
{
   
  function doWork()
  {
   
  $authors_array = array();
  $id_array = array();
  $comment_array = array();
    
   $sql = "SELECT * FROM comments;";
   include('dAl.php');
   $x = new DataAccessProtocol();
   $res = $x->runQueryWithRes($sql);

  while($row = $res->fetch_assoc())
  {
   array_push($id_array, $row['id']);
   array_push($authors_array,$row['author']);
   array_push($comment_array,$row['comment']);
   }
   
   
 var_dump($id_array);
 var_dump($authors_array);
 var_dump($comment_array);

 }
 

}
 $x = new commenter();
 $x->doWork();


  $arr_test = array();
  $arr_test[0] = array("I", "Like","Cars");
  
  for($y=0; $y<sizeof($arr_test); $y++)
  {
	  
	  echo $arr_test[0][$y];
  } 

?>