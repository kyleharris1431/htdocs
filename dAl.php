<?php
 class DataAccessProtocol
 {
     const host = 'localhost';
     const user = 'root';
     const pass = 'root';
     const db   = 'social'; 
     
function runQuery($sql)
{
    /// get all database cxn info to get ready to connect..//
    $host      = DataAccessProtocol::host;
    $user      = DataAccessProtocol::user;
    $db_pass   = DataAccessProtocol::pass;
    $dbName    = DataAccessProtocol::db;
    
    echo "<h1> Testing </h1>"; 
    
    echo '<br> Host : '.$host;
    echo '<br> User : '.$user;
    echo '<br> db_pass : '.$db_pass;
    echo '<br> dbName : '.$dbName;

   $con=mysqli_connect($host,$user,$db_pass,$dbName); // basic mysql/php cxn// 

// Check connection// 
   
   /// connection-> runquery()// datadafa...//
 if (mysqli_connect_errno())
 {
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
 }
 else 
  {
     $res= mysqli_query($con,$sql);
     if(!$res)// if there is a problem, it lies here
     {
      echo "error with mysql query";
     }
     mysqli_close($con);  
  }
  ///// yes, success
 
   }
 
 
 
 function runQueryWithRes($sql)
 {
     /// get all database cxn info to get ready to connect..//
    $host   = DataAccessProtocol::host;
    $user   = DataAccessProtocol::user;
    $db_pass   = DataAccessProtocol::pass;
    $dbName = DataAccessProtocol::db;
    
   // echo "<h1> Testing </h1>"; 
    
    //echo '<br> Host : '.$host;
   // echo '<br> User : '.$user;
    //echo '<br> db_pass : '.$db_pass;
   // echo '<br> dbName : '.$dbName;

   $con=mysqli_connect($host,$user,$db_pass,$dbName); // basic mysql/php cxn// 

// Check connection// 
   
   /// connection-> runquery()// datadafa...//
  if (mysqli_connect_errno())
  {
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  else 
  {
     $res= mysqli_query($con,$sql);

     if(!$res)// if there is a problem, it lies here
     {
      echo "error with mysql query";
     }
     return $res;
     mysqli_close($con);  
  }
  ///// yes, success
 
   
 }
 }
?>
