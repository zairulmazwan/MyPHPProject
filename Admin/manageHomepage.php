<?php 
 include("../Nav/Admin/loggedHeaderAdmin.php");
 include("../Session/session.php");
 
 session_start(); //must start a session in order to use session in this page.
 $path = "LoginAdmin.php"; //this path is to pass to checkSession function from session.php 
 if (!isset($_SESSION['name'])){
	session_unset();
	session_destroy();
	header("Location:".$path);//return to the login page
 }
 $user = $_SESSION['name'];
 checkSession ($path); //calling the function from session.php


 //getting the existing message from welcomeNote.txt
 $fileName = "C:/xampp/Data/WelcomeNote/WelcomeNote.txt";

 $welcomeNote = file_get_contents($fileName);
 $readFile = fopen($fileName, "r") or die ("Unable to open a file");


 ?>

 <div class="container">
     <main role="main" class="pb-3">
        <h2>Manage Homepage Content</h2><br>

        <div class="row">
            <div class="col-6">
                <form method="post" action="saveWelcomeNote.php">
                    <div class="form-group">
                        <label class="control-label" style="font-weight: bold;">Welcome Note </label><br>
                        <textarea rows="10" cols="100" name="welcome"><?php echo $welcomeNote ?></textarea>
                    </div>
                    <div>
                        <p style="font-style: italic; color: red;">The message will be overrided</p>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Update" class="btn btn-primary">
                    </div>
                   
                </form>
            </div>
        </div>
        
     
    
    </main>
 </div>


<?php include("../Nav/loggedFooter.php");?>