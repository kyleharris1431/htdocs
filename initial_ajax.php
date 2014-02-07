<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ajaxValidate 
{

    function formValidate() 
    {
        //Put form elements into post variables (this is where you would sanitize your data)
        //$field1 = $_POST['field1'];
        $f_name   = $_POST['f_name'];
        $l_name   = $_POST['l_name'];
        $email    = $_POST['email'];
        $password = $_POST['pass'];

        //Establish values that will be returned via ajax
        $return = array();
        $return['msg'] = '';     // just to get compiler to hush up
        $return['error'] = false;

        //Begin form validation functionality
        if (!isset($f_name) || empty($f_name))      // checks if fiellds are empty
        {
            $return['error'] = true;
            $return['msg'] .= '<li>Error: Field1 is empty.</li>';
        }

        //Begin form success functionality
        if ($return['error'] === false)    // checks for an error
        {
            // running a query, need to optimize feilds. 
            // at this point we can run a sql query with the post variables from the form
            include 'dAl.php';
            $host = DataAccessProtocol::host;
            $user = DataAccessProtocol::user;
            $db_pass = DataAccessProtocol::pass;
            $dbName = DataAccessProtocol::db;

            $con = mysqli_connect($host, $user, $db_pass, $dbName); // basic mysql/php cxn// 
            // Check connection// 
            /// connection-> runquery()// datadafa...//
            if (mysqli_connect_errno())
            {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            else 
            {
                $sql = "INSERT INTO users VALUES('NULL' , '".$f_name."' , '".$l_name."' , '".$email."','".$password."');";
                $res = mysqli_query($con, $sql);
                
                // this is getting sloppy, clean up!
                $aboutme = "Tell the world about you in a positive way. What are some interests, goals, hobbies
                etc? If you think you are awesome, you most likely are. So write about your pure awesomeness here. Show the world your BestBrightLight. - Make yourself unique in a world of similarity";
                
                $portfolio = "This is where you will show your proof of awesomeness. - If you display your genius musically, post a video of you singing or in an orchestra. If you are into working on cars show us a video of your best 1/4 mile at the track. If you play sports put up some team pictures. Literally anything can go on here, put up what makes you, YOU.";
                
                $sql_2 = "INSERT INTO user_info_2 VALUES ('NULL','What are you? Make it creative','".$aboutme."','".$portfolio."');";
                
                $sql_3 = "INSERT INTO main_pictures_2 VALUES ('NULL' , 'images/placeholder.jpg', 'images/anotherplaceholder.jpg' , 'random text');";
                
                
                $sql_4 = "INSERT INTO interests VALUES('NULL', 'Reading', 'Music', 'Cooking', 'Family', 'Photography', 'Sports',
                'Hiking', 'Movies', 'Running', 'Street Racing');";
                
                
                $sql_5 = "INSERT INTO hobbies VALUES('NULL', 'Computer Programming', 'Fishing', 'Painting', 'Building things', 'Adventuring');";
               
               
                $res_2 = mysqli_query($con, $sql_2);
                // we can also add generic user info to the db in this ajax call so we can customize it later
                $res_3 = mysqli_query($con,$sql_3);
                
                $res_4 = mysqli_query($con,$sql_4);
               
                $res_5 = mysqli_query($con , $sql_5);
                ///// THIS IS WHERE WE WILL SPECIFY THE OUTPUT///////
    
                /////// get 
                include ('layouts/phpLayouts.php');
                $x = new layouts();
                $return['msg'] = $x->getAfterLoginLayout();//fix;
                /////////////////////////////////////////////////////
                if (!$res)
                {// if there is a problem, it lies here
                    echo "error with mysql query";
                }   
                mysqli_close($con);
             }
             
             
            ///// yes, success
     }
        //Return json encoded results SO US CARBON UNITS CAN READ IT!!!
         
        return json_encode($return);
    }

}

$ajaxValidate = new ajaxValidate;
echo $ajaxValidate->formValidate();
?>
