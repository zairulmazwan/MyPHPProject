<?php 

include ("../Nav/loggedHeader.php");
include ("../Session/session.php");
$path = "../User/Login.php"; //this path is to pass to checkSession function from session.php. If the session is expired or no session, it will route to this page

    session_start(); //must start a session in order to use session in this page.
      if (!isset($_SESSION['name'])){
          session_unset();
          session_destroy();
          header("Location:".$path);//return to the login page
      }
     
      $user = $_SESSION['name'];
      checkSession ($path); //calling the function from session.php


?>

<div class="container pb-5">
    <main role="main">
        <h2>Register Module Summary Page</h2><br>
        <h3>Student ID : <?php echo $_SESSION['stdID'];?></h3>
        <h3>Student Name : <?php echo $_SESSION['name'];?></h3><br>
        <h4 style="color: red;">Are you sure want to withdraw this module?</h4><br>
        
        <div class="row">
            <div class="col-sm-2" style="font-weight: bold; font-size: 20px">
                Module Code
            </div>
            <div class="col-sm-10" style="font-size: 20px">
                <?php echo $_GET['module']; ?>
            </div>
            <div class="col-sm-2" style="font-weight: bold; font-size: 20px">
                Module Name
            </div>
            <div class="col-sm-10" style="font-size: 20px">
                <?php echo $_GET['moduleName']; ?>
            </div>

            <div class="col-sm-10">
                <form method="post" action="withdrawModSql.php">
                    <input type="hidden" name="moduleCode" value="<?php echo $_GET['module'];?>"><br>
                    <input type="submit" value="Withdraw" class="btn btn-danger"><a href="myModule.php" style="font-weight: bold; padding-left: 30px;">Back</a>
                </form>
            </div>
        </div>

        
    </main>
</div>

<?php 
include ("../Nav/loggedFooter.php");

?>