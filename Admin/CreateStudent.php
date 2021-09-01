<?php
//include("../HeaderNav.php");
include("../Nav/Admin/loggedHeaderAdmin.php");
require_once("CreateStudentInsert.php");
include("../Session/session.php");

session_start(); //must start a session in order to use session in this page.
$user = $_SESSION['name'];
$path = "LoginAdmin.php"; //this path is to pass to checkSession function from session.php 
checkSession ($path); //calling the function from session.php
$user = $_SESSION['name']; //this is how a session value is obtained from the previous page.


$errorMsgStdID = $errorMsgStdName = $errorMsgCourse = $errorMsgLevel = $errorMsgEmail = $studentID = $studentName = "";
$allFields = "yes";

if (isset($_POST['submit'])) {
        if ($_POST['studID']==""){
            $errorMsgStdID = "Student ID is mandatory";
            $allFields = "no";
        }
        if ($_POST['studName']==null){
            $errorMsgStdName = "Student Name is mandatory";
            $allFields = "no";
        }
        if ($_POST['studCourse']=="Select Course"){
            $errorMsgCourse = "Student Course is mandatory";
            $allFields = "no";
        }
        if ($_POST['studLevel']=="Select Level"){
            $errorMsgLevel = "Student Level is mandatory";
            $allFields = "no";
        }
        if ($_POST['studEmail']==""){
            $errorMsgEmail = "Student Email is mandatory";
            $allFields = "no";
        }

        if($allFields == "yes")
        {
            $createStudent = createStudent();
            echo $createStudent;
            header('Location: CreateStudentPostCreation.php?createStudent='.$createStudent);
        }

    }

?>

<div class="container pb-5">
    <main role="main">
    <h2>Admin : Create Student</h2><br>
    <div class="row">
        <div class="col-6">
        <form method = "post">
            <div class="form-group col-5">
                <label style="font-weight: bold;">Student ID</label>
                <input type="text" name="studID" class="form-control "/>
                <span class="text-danger"><?php echo $errorMsgStdID; ?></span>
            </div>

            <div class="form-group col-8">
                <label style="font-weight: bold;">Student Name</label>
                <input type="text" name="studName" class="form-control "/>
                <span class="text-danger"><?php echo $errorMsgStdName; ?></span>
            </div>

            <div class="form-group col-7">

                    <?php

                        $db = new SQLite3('C:\xampp\Data\StudentModule.db');
                        $sql = "SELECT * FROM Courses ORDER BY Code ASC;";
                        $rows = $db->query($sql);

                        while($row=$rows->fetchArray()){

                            $course_array [] = $row;
                        }

                    ?>
                <label style="font-weight: bold;">Student Course</label>
                <select name="studCourse" type="text" class="form-control" style="font-family: arial; color: blue;"> 
                    <option value="Select Course" selected="selected">Select Course</option>
                    <?php
                    for ($i=0; $i<count($course_array); $i++): ?>
                                    <option value=<?php echo "'".$course_array[$i]['Course']."'" ?>><?php echo $course_array[$i]['Code']."  ".$course_array[$i]['Course']?></option>
                            <?php endfor; ?>
                    
                    <!-- <option value="Select Course" selected="selected">Select Course</option>
                    <option value="Software Engineering">Software Engineering</option>
                    <option value="Computer Science">Computer Science</option>
                    <option value="Network">Network</option>
                    <option value="Forensics">Forensics</option> -->
                </select>
                <span class="text-danger"><?php echo $errorMsgCourse; ?></span>
            </div>

            <div class="form-group col-7">
                <label style="font-weight: bold;">Level</label>
                <select name="studLevel" type="text" class="form-control" style="font-family: arial; color: green;"> 
                    <option value="Select Level" selected="selected">Select Level</option>
                    <option value="4">1</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                </select>
                <span class="text-danger"><?php echo $errorMsgLevel; ?></span>
            </div>

            <div class="form-group col-8">
                <label style="font-weight: bold;">Email</label>
                <input type="text" name="studEmail" class="form-control "/>
                <span class="text-danger"><?php echo $errorMsgEmail; ?></span>
            </div>

            <div class="form-group col-8">
                <button type="submit" name ="submit" class= "btn btn-primary"  style="font-family: arial;" class="form-control ">Create Student</button>
            </div>
        
                <div class="form-group col-5 pb-4">
                    <a href="AdminIndex.php">Back</a>   
                </div> 
        </form>
        </div>     
             
    </div>   
    </main>
</div>

<?php
include("../Footer.php");
?>