<?php include("../HeaderNav.php"); 

require_once("../SelectUser.php");
$nameErr = $pwderr = $invalidMesg = "";

if (isset($_POST['submit'])) {
    
    if ($_POST["usrname"]=="") {
        $nameErr = "Username is required";
      } 
      
      if ($_POST["password"]==null) {
        $pwderr = "Password is required";
      }

    if($_POST['usrname'] != null && $_POST["password"] !=null) //only if these 2 fields have input the following will be processed.
    {
        $array_user = verifyUsers(); //verify user and get their username
        //print_r ("test ".$array_user);
        if ($array_user != null) {

            //print_r($array_user);
            //echo "Test ".$array_user[0]["Role"];
            if ($array_user[0]['Role']=="admin") //if the user role is admin
            {
                session_start(); //start the session
                $_SESSION['name'] = $_POST['usrname']; //get the username and register as a session. $_SESSION['name'] will be used in the targeted page.
                $_SESSION['user'] = "admin";
                //$_SESSION["login_time_stamp"] = time(); //this is to stamp the time of the session created. $_SESSION["login_time_stamp"] will be used in the targeted page.
                //include('OtherPage.php');// why dont we use this in line 70? Because in line 70 you want to show a text
                                            // not include contents of a diferent page. OK ok. 

                // You can make a redirect too:
                // Absolute URI:
                // DOC: https://www.php.net/manual/es/function.header.php
                $host  = $_SERVER['HTTP_HOST'];
                $uri   = rtrim(dirname($_SERVER['PHP_SELF'], 2), '/\\');
                $extra = 'Admin/AdminIndex.php';
                header("Location: http://$host$uri/$extra"); //i created a php file with the name OtherPage
                // I don't like this way, because this redirection happens in the browser
                // I prefer control things in the server
                exit();
            }
            else
            {
                $invalidMesg = "This page is for admin login";
                //exit();
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
        <h2>Admin Login Page</h2><br>
     

            <div class="row">
                <div class="col-md-4">
                    <form method="post">
                        <!-- asp tags don't exist here <div asp-validation-summary="ModelOnly" class="text-danger"></div> -->
                        <div class="text-danger"></div>

                        <div class="form-group">
                            <label class="control-label">Username</label>
                            <input  class="form-control" type="text" name="usrname"/>
                            <span class="text-danger"><?php echo $nameErr;?></span>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Insert Password</label>
                            <input type="password" class="form-control" name ="password"/>
                            <span class="text-danger"><?php echo $pwderr;?></span>
                        </div>

                        <div class="form-group">
                            <!--<input type="submit" value="Login" class="btn btn-primary" />-->
                            <button type="submit" value="Login" name="submit" class="btn btn-primary">Login</button>
                            
                        </div>
                        <div>
                            <label style="color: red"><?php echo $invalidMesg; ?></label>
                        </div>

                    </form>
                </div>
            </div>
        </main>
    </div>

<?php include("../Footer.php"); ?>