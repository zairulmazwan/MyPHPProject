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

if(isset($_POST['welcome'])){

    $fileName = "C:/xampp/Data/WelcomeNote/WelcomeNote.txt";

    $file = fopen($fileName, "w") or die("File not found!");

    fwrite($file, $_POST['welcome']);
    fclose($file);

    //echo "<script>alert('Welcome note successfully updated'); </script>";
    //header("Location: manageHomepage.php");
}
?>
<div class="container">
     <main role="main" class="pb-3">
     <div class="alert alert-success" role="alert">
         Welcome message successfully updated
     </div>
    <a href="manageHomepage.php">Back</a>
    </main>
</div>
<?php include("../Nav/loggedFooter.php");?>