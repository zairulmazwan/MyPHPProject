<?php 
 include("../Nav/Admin/loggedHeaderAdmin.php");
 include("../Session/session.php");
 include("getModule.php");
 require_once("updateModuleSql.php");

 $path = "../Admin/LoginAdmin.php"; //this path is to pass to checkSession function from session.php 
     
 session_start(); //must start a session in order to use session in this page.
 if (!isset($_SESSION['name'])){
     session_unset();
     session_destroy();
     header("Location:".$path);//return to the login page
 }

 $user = $_SESSION['name'];
 checkSession ($path); //calling the function from session.php
 $emptyMsg = "";

 $modCode = $_GET['moduleCode'];

 if (isset($_POST['submit'])) 
 { 
     //print_r($_POST['year']);
     $moduleUpdated = updateModule (); //this function returns true or false
     if ($moduleUpdated){
        //echo '<script>alert("Module update successful");</script>';
        header("Location:viewModule.php?updated=true");//passing the parameter value true to the page
     }
     else{
        //echo "Not Successful";
        header("Location:viewModule.php?updated=false");
     }
     exit();
 }

 ?>

<script>
    function toggle(source){
        var checkBoxes = document.querySelectorAll('input[type="checkbox"]');

        for (var i=0; i<checkBoxes.length; i++){
            if(checkBoxes[i]!=source)
                checkBoxes[i].checked = source.checked;
        }
    }
</script>

<div class="container bgColor">
    <main role="main" class="pb-5">
		<h1>Update Module <?php echo $modCode ?></h2>

        <?php //retrieving the module details into an array -> $rowResult
            $db = new SQLite3('C:\xampp\Data\StudentModule.db');
            $sql = 'SELECT * FROM Module WHERE ModuleCode = :mCode';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':mCode', $modCode, SQLITE3_TEXT);
            $result = $stmt->execute();
            $rowResult = [];
            while($row = $result->fetchArray())
            {
                $rowResult [] = $row;
            }
        
        ?>

        <div class="row pb-3">
            <div class="col-5">
                <form method="post">

                    <div class="form-group col-6">
                        <label class="control-label font-weight-bold">Module Code : </label>
                        <input type = "text" name="moduleCode" class="form-control" value="<?php echo $rowResult[0]['ModuleCode']?>"/>
                        <input type = "hidden" name="moduleCodeOld" class="form-control" value="<?php echo $rowResult[0]['ModuleCode']?>"/>
                        <span class="text-danger"></span>
                    </div>

                    <div class="form-group col-12">
                        <label class="control-label font-weight-bold">Module Name : </label>
                        <input type = "text" name="moduleName" class="form-control" value="<?php echo $rowResult[0]['ModuleName']?>"/>
                        <span class="text-danger"></span>
                    </div>

                    <div class="form-group col-5">
                        <label class="control-label font-weight-bold">Module Level : </label>
                        <?php 
                      
                            $db = new SQLite3('C:\xampp\Data\StudentModule.db');
                            $sql = "SELECT * FROM Level ORDER BY Level ASC;";
                            $rows = $db->query($sql);

                            while($row=$rows->fetchArray()){

                                $level [] = $row;
                            }

                             //print_r($level);

                        ?>

                        <select type = "text" name="level" class="form-control">
                             
                             <?php for ($i=0; $i<count($level); $i++): ?>
                                <option value=<?php echo '"'.$level[$i]['Level'].'"';?><?php if ($rowResult[0]['ModuleLevel']==$level[$i]['Level']) echo "selected"; ?>><?php echo $level[$i]['Level'] ?></option>
                             <?php endfor; ?>
                        </select>
                        <span class="text-danger"></span>
                    </div>

                    <?php

                        $db = new SQLite3('C:\xampp\Data\StudentModule.db');
                        $sql = "SELECT * FROM Courses ORDER BY Code ASC;";
                        $rows = $db->query($sql);

                        while($row=$rows->fetchArray()){

                            $course_array [] = $row;
                        }

                        //to split the course for the module into an array
                        $modCourse =  explode(",", $rowResult[0]['ModuleCourse']);
                        //print_r($modCourse); //use this to print array elements
                        $modYear = explode(",", $rowResult[0]['ModuleYear']);

                    ?>

                    <div class="form-group col-7">
                        <label class="control-label font-weight-bold">Course : </label>
                        <select type = "text" name="course[]" class="form-control" placeholder="Enter module name" multiple="multiple" size = 4>
                            <?php 
                            for ($i=0; $i<count($course_array); $i++):?>
                            <option value=<?php echo '"'.$course_array[$i]['Course'].'"'?> <?php if(in_array($course_array[$i]['Course'], $modCourse))  echo "selected";?>>
                            <?php echo $course_array[$i]['Course'];?></option>
                            <?php endfor; ?>
                        </select>
                        <span class="text-danger"></span>
                    </div>

                    <div class="form-group col-7">
                        <label class="control-label font-weight-bold">Module Year : </label><br>
                            <div style="display: inline-block; margin-left: 5px">
                            <input type="checkbox" id="selectAll" onclick="toggle(this);" class="form-check-inline"/>Select all<br>
                            <?php
                                for ($i=0; $i<4; $i++):?>
                               <input type="checkbox" name="year[]" value="<?php echo ($i+1);?>" class="form-check-inline" <?php if (in_array($i+1, $modYear)) echo 'checked'; ?>/><?php echo $i+1;?><br />
                               <?php endfor; ?>
                            </div>
                           
                        <span class="text-danger"></span>
                    </div>

                    <div class="form-group col-7">
                        <label class="control-label font-weight-bold">Status : </label><br>
                            <div style="display: inline-block;">
                                <input type="radio" name="status" value="Active" class="form-check-inline" <?php if ($rowResult[0]['ModuleStatus']=="Active") echo "checked";?>>Active
                                <input type="radio" name="status" value="Close" class="form-check-inline" style="margin-left: 20px" <?php if ($rowResult[0]['ModuleStatus']=="Close") echo "checked";?>>Close
                            </div>
                           
                        <span class="text-danger"></span>
                    </div>

                    <div class="form-group col-7">
                        <input type="submit" name="submit" value="Update Module" class="btn btn-secondary" />
                    </div>

                    <div class="form-group col-7">
                        <a href="viewModule.php">Back</a>
                    </div>

                </form>
            </div>

        </div>
    </main>
</div>


<?php include("../Nav/loggedFooter.php");?>