<?php 
 include("../Nav/loggedHeader.php");
 include("../Session/session.php");

 $path = "../Admin/LoginAdmin.php"; //this path is to pass to checkSession function from session.php 
     
 session_start(); //must start a session in order to use session in this page.
 if (!isset($_SESSION['name'])){
     session_unset();
     session_destroy();
     header("Location:".$path);//return to the login page
 }

 $user = $_SESSION['name'];
 checkSession ($path); //calling the function from session.php

    $modCode = $modName = ""


 ?>

<div class="container bgColor">
        <main role="main" class="pb-3">
		<h1>:: Create Module ::</h2><br>

        <div class="row">
                <div class="col-md-4">
                    <form method="post" action="#">
                        <div asp-validation-summary="ModelOnly" class="text-danger"></div>

                        <div class="form-group col-6">
                            <label class="control-label">Module Code</label>
                            <input  class="form-control" type="text" value="<?=  $modCode;?>" placeholder="module code"/>
                            <span class="text-danger"></span>
                        </div>

                        <div class="form-group col-10">
                            <label class="control-label">Module Name</label>
                            <input type="text" class="form-control" value="<?php echo $modName;?>" placeholder="module name"/>
                            <span class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-4">
                            <!--<input type="submit" value="Login" class="btn btn-primary" />-->
                            <button type="Create" value="Login" id="createMod" class="btn btn-primary">Login</button>
                            
                        </div>

                    </form>
                </div>
            </div>
		
		</main>
	</div>




<?php include("../Nav/loggedFooter.php");?>