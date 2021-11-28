 <?php 
 include("../Nav/loggedHeader.php");
 include("../Session/session2.php");
 
 $path = "Login.php"; //this path is to pass to checkSession function from session.php 
     
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
		<h1>Tutorial Week 9</h2><br>
		<div><p>Hello <?php echo ucfirst($user); ?></p></div>

			<?php
				print "This page appears after successful logged in!";
 			?>

		<div>
			<a href="userPage.php">Let's go to page 2</a>
		</div>
		</main>
	</div>

<?php include("../Nav/loggedFooter.php");?>


