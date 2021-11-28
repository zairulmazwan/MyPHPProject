<?php 
    include ("../Nav/loggedHeader.php");
    include ("../Session/session.php");
    require_once ("getModule.php");

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
        <h2> Register Module Summary Page</h2><br>
        <h4>Student ID : <?php echo $_SESSION['stdID'];?></h4>
        <h4>Student Name : <?php echo $_SESSION['name'];?></h4>
        
      <?php //print_r($_POST['selectModule']);

        $moduleCode = $_POST['selectModule']; //from checkbox array from registerModule.php 
        $db = new SQLite3('C:\xampp\Data\StudentModule.db');
        $results = [];
        //print_r($moduleCode);

        for ($i=0; $i<count($moduleCode); $i++){

            //echo "Module code : ".$moduleCode[$i];
            
            $stmt = 'SELECT ModuleName, ModuleLevel FROM Module WHERE ModuleCode = :Mcode';
            $sql = $db->prepare($stmt);
            $sql->bindParam(':Mcode', $moduleCode[$i], SQLITE3_TEXT);
            $rows = $sql->execute();


            while ($row = $rows->fetchArray()){
                $results [] = $row;
            }
        }
        //print_r($results);
        $stmt = "SELECT ModuleCode FROM RegisteredModule WHERE StdID = :StdId";
        $sql = $db->prepare($stmt);
        $sql->bindParam(':StdId', $_SESSION['stdID'], SQLITE3_TEXT);
        $res = $sql->execute();
    
        $registeredMod = [];
        while($rows=$res->fetchArray()){
    
            $registeredMod [] = $rows;
        }
        $registeredModCode = [];
        for ($i=0; $i<count($registeredMod); $i++){
            $registeredModCode [] = $registeredMod[$i]['ModuleCode'];
        }
        //print_r($registeredModCode);
      ?>

      <br>
      <form method="post" action="myModule.php">
      <div class="row">
        <div class="col-10">
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Module Code</th>
                        <th>Module Name</th>
                        <th>Level</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <?php for ($i=0; $i<count($moduleCode); $i++) :?>
                <tr>
                    <td> <?= $i+1; ?></td>
                    <td><input type="hidden" name = "module[]" value="<?php echo $moduleCode[$i];?>"><?php echo $moduleCode[$i]; ?></td>
                    <td><?php echo $results[$i]['ModuleName']; ?></td>
                    <td><?php echo $results[$i]['ModuleLevel']; ?></td>
                    <td><?php echo (in_array($moduleCode[$i], $registeredModCode)) ? "Registered":"New"; ?></td>
                </tr>
                <?php endfor;?>
            </table>
        </div>
      </div>

      
        <div class="alert alert-danger col-10" role="alert">
            <?php //print_r($moduleCode); ?>
            Are you sure want to register the module/s?
            <button type="submit" class="btn" style="background-color: #fc7b03; font-weight: bold; font-size: 18px;">Yes</button>   |
        
            <a href="registerModule.php" style="font-weight: bold; font-size: 18px;">No</a>
        </div>
        </form>
      
    </main>
</div>

<?php
include ("../Nav/loggedFooter.php");
?>