<?php session_start();?>

<?php 

// verbatum // -
//Select * from users where email = $post email AND pass = $post pass;
include 'dAl.php';
$email = $_POST['email'];
$password = $_POST['password'];

$sql = (" SELECT * FROM users WHERE email = '".$email."' and password = '".$password."' ;"); 
// sql query
$res = DataAccessProtocol::runQueryWithRes($sql);
 
while($row = mysqli_fetch_array($res)) // fetch results as array and print data
{
    $id = $row['id'];
    $_SESSION['id_num'] = $id;
    //echo "Session : ".$_SESSION['id_num'];
    echo "<meta http-equiv='refresh' content='0;url=http://localhost:8888/profile.php'>";
}  

if(mysql_num_rows($res)==0)
{ 
// aka query is false;
echo "<h2 color = 'red'>We are sorry, but the supplied credentials are incorrect. </h2>" ;
echo'<h3>Log In To BBL</h3>
<form class="formclass" action="login.php" method="post">
<label> E Mail Address: <br> <input type="text" id = "email" name="email">
<br>
<label> Password: <br> <input type="password" id = "password" name="password">
<br>
<br>
<input type="submit" value="Log In!">
</form>';
}  

?>
