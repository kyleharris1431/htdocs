<?php

include 'phpFiles/dAl.php'; // include_once for dataAccessLayerClass

class AccountCreator 
{
    private $f_name = 'f';
    private $l_name = 'l';
    private $email  = 'e';
    private $pass   = 'p';
     
    public function __construct($f, $l, $e, $p) 
    {
       $this->f_name=$f;
       $this->l_name=$l;
       $this->email=$e;
       $this->pass=$p;
    }
    
    // generic getters
    function getFirstName()
    {
        return $this->f_name;
    }
    function getLastName()
    {
        return $this->l_name;
    }
    function getEmail()
    {
        return $this->email;
    }
    function getPass()
    {
        return $this->pass;
    }
    /// end of generic getters // 
    //                         //
    /// start of setters       // 
    function setFirstName($str_fname)
    {
        $this->f_name=$str_fname;
    }
    function setLastName($str_lname)
    {
        $this->l_name=$str_lname;
    }
    function setEmail($str_email)
    {
        $this->email = $str_email;
    }
    function setPass($str_pass)
    {
        $this->pass = $str_pass;
    }
    // not really needed, but handy when coding
    function createAccount($first, $last, $email, $pass)
    {
     $query =  "INSERT INTO `users`VALUES ('NULL','" .$first. "','" .$last. "','" .$email. "','" .$pass. "');";
     DataAccessProtocol::runQuery($query); // calling run query method //
     // header location: thankyou_login.php
    }
}
// not to be confused w/ class vars...
$f_name = $_POST['f_name'];
$l_name = $_POST['l_name'];
$email  = $_POST['email'];
$pass   = $_POST['pass'];
// create new accountcreator object //
$ob = new AccountCreator($f_name,$l_name,$email,$pass);
// to make it more OO 
$f = $ob->getFirstName();
$l = $ob->getLastName();
$e = $ob->getEmail();
$p = $ob->getPass();
// also makes query more readable
// query works
// create account from AccountCreator Class which calls from the DAP to run a baseline query. 
$ob->createAccount($f, $l, $e, $p);
?>