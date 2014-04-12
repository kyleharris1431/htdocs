<?php 

 $arr_1 =array();
 $arr_2 =array();
class fetchZips
{
  function downloadCSV()
  { 
  
  $url  = 'https://zipcodedistanceapi.redline13.com/rest/m61CrHmKLXipPrbCCbBg8D55SErk9w6vD785OvPAt8ZizbUbnwsv9yB2c2mlztRd/radius.csv/21773/10/mile';
  $path = 'playground/newFile.csv';
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $data = curl_exec($ch);

  curl_close($ch);

  file_put_contents($path, $data);
       
  }
  
  // end of first function // 
  
  function readFile()
  {
  
    global $arr_1,$arr_2;
  
    $zips = array();

  
    $row = 1;
    
      if (($handle = fopen("playground/newFile.csv", "r")) !== FALSE) 
      {
       while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
       {
        $num = count($data);
       // echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
        for ($c=0; $c < $num; $c++)
        {
            array_push($zips, $data[$c]);
        }
      }
    }
    fclose($handle);
    
    /// split into two // 
    
    for($y=0; $y<sizeof($zips); $y++)
    {
	    if($y>1)
	    {
		    if($y % 2 == 0)
		    {
			    array_push($arr_1, $zips[$y]);
		    }
		    else
		    {
			    array_push($arr_2, $zips[$y]);
		    }
	    }
    }
    
    // testing code // 
    for($z=0; $z<sizeof($arr_1); $z++)
    {
	    echo $arr_1[$z]." Distance :".$arr_2[$z]."<br>";
    }
    
   }
   
   }
  
   
  ?>
   
 <?php


  $x = new fetchZips();
  $x->downloadCSV();
  $x->readFile();
?>