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

    $stdId = $_GET['stdId'];
    $stdName = $_GET['stdName'];


    $db = new SQLite3('C:\xampp\Data\StudentModule.db');
    $sql = 'SELECT * FROM Student WHERE StdID=:sId'; // OR StdName=:stdName'
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':sId', $stdId, SQLITE3_TEXT);
    $res = $stmt->execute();
    $studRes = [];
    while($row=$res->fetchArray()){

        $studRes [] = $row; //should only have 1 record
    }
    //print_r($studRes);
?>

<div class="container pb-5">
    <main role="main">
        <h2>Admin : Update Student <?php echo $stdName." (".$stdId.")" ?></h2><br>

                <form method="post" action="UpdateStudent2.php">
                    
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <input type = "hidden" name="StdId" class="form-control" value="<?php echo $studRes[0]['StdID'] ?>"/>
                        </div>  
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-2 font-weight-bold">Student Name : </label>
                        <div class="col-sm-3">
                            <input type = "text" name="StdName" class="form-control" value="<?php echo $studRes[0]['StdName'] ?>"/>
                        </div>  
                    </div>

                  
                    <div class="form-group row">
                        <label class="control-label col-sm-2 font-weight-bold">Student Course : </label>
                        <div class="col-sm-3">
                             <input type = "text" name="StdCourse" class="form-control" value="<?php echo $studRes[0]['StdCourse'] ?>" />
                        </div>
                    </div>



                    <div class="form-group row">
                        <label class="control-label col-sm-2 font-weight-bold">Student Level : </label>
                        <div class="col-sm-1">
                            <input type = "text" name="StdLevel" class="form-control" value="<?php echo $studRes[0]['StdLevel'] ?>" />
                        </div>
                    </div>

 
                    <div class="form-group row">
                        <label class="control-label col-sm-2 font-weight-bold">Student Email : </label>
                        <div class="col-sm-4">
                            <input type = "text" name="StdEmail" class="form-control" value="<?php echo $studRes[0]['StdEmail'] ?>" />
                        </div>
                    </div>

                   <div class="form-group row">
                        <div  class="col-sm-4">
                            <button type = "submit" name="submit" class = "btn btn-primary">Update</button>
                        </div>
                   </div>

                   <div class="form-group row">
                        <div  class="col-sm-4">
                            <a href="ViewFilterStudent.php">Back</a>
                        </div>
                   </div>
                </form>

    </main>
</div>





<?php include("../Footer.php"); ?>