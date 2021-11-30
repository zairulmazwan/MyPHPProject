<?php 

require("../HeaderNav.php");
require_once("checkUserLogin.php");

$nameErr = $pwderr = $invalidMesg = "";

if (isset($_POST['login'])) {

    if ($_POST["uname"]=="") {
        $nameErr = "Username is required";
      } 
      
      if ($_POST["pwd"]==null) {
        $pwderr = "Password is required";
      }

    if($_POST['uname'] != null && $_POST["pwd"] !=null)
    {
        $array_user = verifyUsers(); //calling this function from SelectUser.php. The function returns an array
        
        if ($array_user != null) {

      
            if ($array_user[0]['Role']=="student")
            {
                session_start();
                $_SESSION['name'] = $array_user[0]['firstName'];
                $_SESSION['stdID'] = $array_user[0]['userId'];
               
                header("Location: userIndex.php"); 
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
            <h1>Login</h1>

            <div class="row">
                <div class="col-6">
                    <form method = "post">
                        <div class="form-group col-8">
                            <label class="control-label">Username</label>
                            <input class="form-control" type="text" name = "uname">
                            <span class="text-danger"><?php echo $nameErr;?></span>
                        </div>

                        <div class="form-group col-5">
                            <label class="control-label">Password</label>
                            <input class="form-control" type="password" name = "pwd">
                            <span class="text-danger"><?php echo $pwderr;?></span>
                        </div>
                        <br>
                        <div class="form-group col-5">
                            <input type="submit" value="Login" name = "login" class="btn btn-primary">
                        </div>
                    
                    </form>
                    <div class="text-danger">
                        <?php echo $invalidMesg; ?>
                    </div>
                </div>
            </div>

		</main>
	</div>


<?php 
require("../Footer.php");
?>