<?php
include('../HeaderNav.php');
require_once("../SelectUser.php");
$nameErr = $pwderr = $invalidMesg = "";

// This could be a solution for you ask. what about line no 57?
// is the same logic. Still need both? if you want to show the message later... yes
// this is a bit "tricky" for a redirect
// because I don't like making redirects in browsers
// you can use a header redirect too... but I don't like because could give you problems with caches
if (isset($_POST['submit'])) {

    if ($_POST["usrname"]=="") {
        $nameErr = "Username is required";
      } 
      
      if ($_POST["password"]==null) {
        $pwderr = "Email is required";
      }

    if($_POST['usrname'] != null && $_POST["password"] !=null)
    {
        $array_user = verifyUsers(); //calling this function from SelectUser.php. The function returns an array
        if ($array_user != null) {

            //print_r($array_user);
            //echo "Test ".$array_user[0]["Role"];
            if ($array_user[0]['Role']=="non-admin")
            {
                session_start();
                $_SESSION['name'] = $_POST['usrname'];
                $_SESSION["login_time_stamp"] = time(); 
                $_SESSION['stdID'] = $array_user[0]['PersonalId'];
                //include('OtherPage.php');// why dont we use this in line 70? Because in line 70 you want to show a text
                                            // not include contents of a diferent page. OK ok. 

                // You can make a redirect too:
                // Absolute URI:
                // DOC: https://www.php.net/manual/es/function.header.php
                $host  = $_SERVER['HTTP_HOST'];
                $uri   = rtrim(dirname($_SERVER['PHP_SELF'], 2), '/\\');
                $extra = 'User/UserIndex.php';
                header("Location: http://$host$uri/$extra"); //i created a php file with the name OtherPage
                // I don't like this way, because this redirection happens in the browser
                // I prefer control things in the server
                exit();
            }

            if ($array_user[0]['Role']=="admin") //if the user is admin, this message will be prompted
            {
                $invalidMesg = "This page is for student login";
            }


            
        }
        else{
            $invalidMesg = "Invalid username and password!";
        }
    }
    
}
?>


  <div class="container bgColor">
    <main role="main" class="pb-3">
    <h2>Student Login Page</h2><br>
        <div class="row">
            <div class="col-md-4">
                <form method="post">
                    <div class="form-group">
                        <label class="control-label">Username</label>
                        <input  class="form-control" type="text" name="usrname"/>
                        <span class="text-danger"> <?php echo $nameErr;?></span>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Insert Password</label>
                        <input type="password" class="form-control" type="text" name="password"/>
                        <span class="text-danger"> <?php echo $pwderr;?></span>
                    </div>

                    <div class="form-group">
                        <!--<input type="submit" value="Login" class="btn btn-primary" />-->
                        <button type="submit" name="submit" value="Login" id="SubmitButton" class="btn btn-primary">Login</button>
                    </div>
                    <div>
                       <label style="color: red"><?php echo $invalidMesg; ?></label>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>

<div>
<?php

// TESTING
// echo "<pre>";
// print_r($_POST);m
// echo "</pre>";

/*
    if (isset($_POST['submit'])) { // here we check if the magic var _POST have a var called 'submit'
                                    // submit var is the button who send your form, its name is submit
                                    // so is a way of know if the user has clicked on that button
                                    // <button name="submit" />s
        
                               
      $array_user = verifyUsers();

        if ($array_user != null) {
            $logUser = $array_user['Username'];
            $logName = $array_user['Name'];

            echo "User ".$logUser." is valid";
        } else {
            $invalidMesg = "Invalid username and password!";
            //echo "Invalid username and password! Tau tak!!!";
        }
    }
*/?>
</div>

<?php include('../Footer.php'); ?>