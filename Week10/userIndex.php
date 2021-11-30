<?php require("../HeaderNav.php");
include("../Session/session2.php");
 

 $path = "../Week10/login.php"; //this path is to pass to checkSession function from session.php 
     
 session_start(); //must start a session in order to use session in this page.

 if (!isset($_SESSION['name'])){
     session_unset();
     session_destroy();
     header("Location:".$path);//return to the login page
 }

 $user = $_SESSION['name']; //this value is obtained from the login page when the user is verified
 $userID = $_SESSION['stdID']; //this value is obtained from the login page when the user is verified
 checkSession ($path); //calling the function from session.php

?>

	<div class="container bgColor">
        <main role="main" class="pb-3">
        <h1>Student Landing Page</h1>

        <h2>Welcome <?php echo $user." ".$userID; ?></h2>
		</main>
	</div>

<?php require("../Footer.php");?>


