<?php

function runBasicQuery($string_query)
{
  $host='localhost'; 
  $user='root';
  $pass='root';
  $db_name='social'; 
  
  $cxn = mysql_connect($host,$user,$pass,$db_name);
  
  $res = mysqli_query($cxn,$string_query);
 
  return $res;
}

 class basic_profile
 {
	 // flep
	private $first_name;
	private $last_name;
	private $email; 
	private $password;
	 
	 function setFirstName($firstName)
	 {
		 $this->first_name = $firstName;
	 }
	 function setLastName($lastName)
	 {
		 $this->last_name = $lastName;
	 }
	 function setEmail($em)
	 {
		 $this->first_name = $em;
	 }
	 function setPassword($pass)
	 {
		 $this->last_name = $pass;
	 }

	 function getFirstName()
	 {
		 return $this->first_name;
	 }
	 function getLastName()
	 {
		 return $this->last_name;
	 }
	 function getEmail()
	 {
		 return $this->email;
	 }
	 function getPassword()
	 {
		 return $this->first_name;
	 }
	 
	 function setValuesInDatabase()
	 {
$sql = "INSERT INTO users VALUES('NULL','".$this->getFirstName();."', '".$this->getLastName()."', '".$this->getEmail()."', '".$this->getPassword()."');";
		 runBasicQuery($sql);
	 }

 }


?>