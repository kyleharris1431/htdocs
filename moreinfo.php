<?php session_start();?>

<?php
 $id='';
     if (isset($_SESSION['id_num']))
     {
     $id = $_SESSION['id_num'];
     }
     
     echo "ID : ".$id;
?>

<!DOCTYPLE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="js/kickstart.js"></script> <!-- KICKSTART -->
<link rel="stylesheet" href="css/style.css" media="all" />

<style type = "text/css">
#form_div
{
 background: rgba(147,248,255,0.75);
 border: 1px solid;
}
</style>

</head>
<body>

    <div class ="header">
         <br>
        <h2> <center> BestBrightLight</center> </h2>
    </div>
    
 <div id="info1">
     <center><p></p> </center>
 <div id = "form_div">
 
 
 <form id="form1" method="post">
 <br>
  <p align="center" style="margin-top :5px"> Nickname (if any)   : <input type="text" name="nickname" id="nickname" required="true"/>  </p>
  
  <p align="center"> Alerntate Email :   <input type="text" name="alt_email" id="alt_email"required="true"/> </p>

  <p align="center"> Cell phone (optional)   <input type="text" name="cell_phone" id="cell_phone"required="true"/>  </p>
 
  <p align="center"> City  :  <input type="text" name="city" id="city" required="true"/> </p>
   
   <p align="center"> State : <input type="state" name="state" id="state"required="true"/> </p>
 
   <p align="center"> Zip Code: <input type="text" name="zip" id="zip"required="true"/>  </p>

   <input type="submit" value="Upadate Information"/>
 </form>
    
    
   </div>
      
  
 
   
 </div>
 </div>

<script type="text/javascript">
$('#form1').submit(function(event) 
     {  
       alert("Button clicked");
       event.preventDefault();
       $.ajax(
       {
       type: 'POST',
       url: 'more_info_ajax.php',
       data: $(this).serialize(),
       dataType: 'json',
       success: function (data) 
       {
       console.log(data);
       alert("Data updated");
       }
    });
 });

</script>
 <!-- END OF AJAX CALL --> 
 
 <br>
 <br>
 
</body>
</html>
