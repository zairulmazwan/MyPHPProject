<?php

function checkSession ($path) {
  
    /*
    $sessionMax = 10; //this is a parameteised variable for the maximum length of the session.
    //$_SESSION['expire'] = time() + 1*10;
    // To check if session is started.
    if(isset($_SESSION["name"])) //if $_SESSION["name"] has got a value from the previous page.
    {
        if(time()-$_SESSION['login_time_stamp']>$sessionMax) //$_SESSION["login_time_stamp"] was created in the login page and being used here.
        {
            session_unset();
            session_destroy();
            header("Location:".$path);//return to the login page
        }
    }
    else
    {
        header("Location:".$path); //if there is no session, the user will be rerouted to the login page. This is to avoid accessing the page via url.
    }
    $url=$_SERVER['REQUEST_URI'];//to obtain the current page 
    $timeOut = $sessionMax+1; //1 second after the max session allowed. 
    header("Refresh: $timeOut; URL=$url"); //refresh the screen
    $_SESSION["login_time_stamp"] = time();
    //html refresh can also be set in meta tag. Refer loggedHeader.php file line 6 (commented out)
    */

    //Expire the session if user is inactive for 30
    //minutes or more.
    $expireAfter = 35;

    //Check to see if our "last action" session
    //variable has been set.
    if(isset($_SESSION['last_action'])){
        
        //Figure out how many seconds have passed
        //since the user was last active.
        $secondsInactive = time() - $_SESSION['last_action'];
        
        //Convert our minutes into seconds.
        $expireAfterSeconds = $expireAfter * 60;
        
        //Check to see if they have been inactive for too long.
        if($secondsInactive >= $expireAfterSeconds){
            //User has been inactive for too long.
            //Kill their session.
            session_unset();
            session_destroy();
            header("Location:".$path);//return to the login page

        }
        
    }
    
    $_SESSION['last_action'] = time();
    $url=$_SERVER['REQUEST_URI'];//to obtain the current page
    $timeOut = ($expireAfter*60)+1; //1 second after the max session allowed. 
    header("Refresh: $timeOut; URL=$url"); //refresh the screen
    //Assign the current timestamp as the user's
    //latest activity
    //$_SESSION["login_time_stamp"] = time();
}
?>