<?php 
include("../Nav/loggedHeader.php");
include("../Session/session.php");
require_once("getStudModule.php");

$path = "Login.php"; //return to this page if the session is not active/no session
session_start();

if (!isset($_SESSION['name'])){
    session_unset();
    session_destroy();
    header("Location:".$path);//return to the login page
}
$user = $_SESSION['name']; //this value is obtained from the login page when the user is verified
$userID = $_SESSION['stdID']; //this value is obtained from the login page when the user is verified
checkSession ($path); //calling the function from session.php

//this is when the user register new modules - form registerModule2.php file

if(isset($_POST['module'])) {
    $moduleToReg = $_POST['module'];
    //print_r($_POST['module']);
    //echo "Student Id : ".$userID;
    $db = new SQLite3('C:\xampp\Data\StudentModule.db');
    //check whether the module is already registered or not
    $stmt = "SELECT ModuleCode FROM RegisteredModule WHERE StdID = :StdId";
    $sql = $db->prepare($stmt);
    $sql->bindParam(':StdId', $userID, SQLITE3_TEXT);
    $res = $sql->execute();

    $registeredMod = [];
    while($rows=$res->fetchArray()){

        $registeredMod [] = $rows;
    }
    //print_r($registeredMod);
    for ($i=0; $i<count($moduleToReg); $i++){
        $registered = false;
        
        for ($j=0; $j<count($registeredMod); $j++){
            //echo $registeredMod[$j];
            
            if($moduleToReg[$i] == $registeredMod[$j]['ModuleCode']) {
                $registered = true;
                break;
            }
        }
        if($registered==false) {
            $stmt = "INSERT INTO RegisteredModule (StdID, ModuleCode, Date) VALUES (:Std, :Mcode, :date)";
            $sql = $db->prepare($stmt);
            $sql->bindParam(':Std', $userID, SQLITE3_TEXT);
            $sql->bindParam(':Mcode', $moduleToReg[$i], SQLITE3_TEXT);
            $date = date("d/m/Y");
            $sql->bindParam(':date', $date, SQLITE3_TEXT);
            $sql->execute();
        }

    }

}
$modulesCode = getModule($userID);
$modules = getModuleName($modulesCode);
?>

<div class="container bgColor">
        
        <main role="main" class="pb-5">
            <h1>My Module</h2><br>
            <h4>Student ID : <?php echo $_SESSION['stdID'];?></h4>
            <h4>Student Name : <?php echo $_SESSION['name'];?></h4><br>

			<?php //print_r($modules);  ?>
            <div class="row">
                <div class="col-10">
                    <table class = "table table-striped">
                        <thead class = "table-dark">
                            <tr>
                                <td>#</td>
                                <td>Module Code</td>
                                <td>Module Name</td>
                                <td>Actions</td>
                            </tr>
                        </thead>
                        
                        <?php 
                            for ($i=0; $i<count($modules); $i++): ?>
                            <tr>
                                <td><?php echo $i+1;?></td>
                                <td><?php echo $modulesCode[$i]['ModuleCode']; ?></td>
                                <td><?php echo $modules[$i]['ModuleName']; ?></td>
                                <td><?php echo '<a href="withdrawModule.php?module='.$modulesCode[$i]['ModuleCode'].'&moduleName='.$modules[$i]['ModuleName'].'">Withdraw</a></td>';?>
                            </tr>
                        <?php endfor;?>
                      


                    </table>


                </div>
            </div>

		</main>
</div>


<?php include("../Nav/loggedFooter.php");?>