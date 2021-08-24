<?php 
include("../Nav/Admin/loggedHeaderAdmin.php");
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

?>

<div class="container bgColor">
    <main role="main" class="pb-3">
        <h2>:: Update Level ::</h2>


    </main>
</div>



<?php 



include("../Nav/loggedFooter.php");

?>
