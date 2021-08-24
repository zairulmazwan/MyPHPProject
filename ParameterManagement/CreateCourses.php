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
        
     
     $codeErr = $courseErr = $createMsg = "";

    if(isset($_POST['submit'])){

        if ($_POST["code"]==""){
            $codeErr="Course code is required";
        }

        if ($_POST["course"]==""){
            $courseErr="Course name is required";
        }

        if($_POST["code"]!="" && $_POST["course"]!=""){
            
            $db = new SQLite3('C:\xampp\Data\StudentModule.db');
            $sql = 'INSERT INTO Courses(Code, Course) VALUES(:Code, :Course)';

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':Code', $_POST['code'], SQLITE3_TEXT);
            $stmt->bindParam(':Course', $_POST['course'], SQLITE3_TEXT);

            $stmt->execute();

            if ($stmt)
            {
                $createMsg="A course is successfully created";
            }
            else{
                $createMsg="A course is not successfully created";
            }
        } 
    }


?>

<div class="container bgColor">
    <main role="main" class="pb-3">
        <h2>Parameter Creation : Course</h2>

        <div class="row">
            <div class="col-sm-4">
                <form method="post">

                    <div class="form-group col-7">
                        <label class="control-label">Course Code</label>
                        <input type="text" class="form-control" name="code"/>
                        <span class="text-danger"><?php echo $codeErr;?></span>
                    </div>
                    
                    <div class="form-group col-10">
                        <label class="control-label">Course Name</label>
                        <input type="text" class="form-control" name="course"/>
                        <span class="text-danger"><?php echo $courseErr;?></span>
                    </div>

                    <div class="form-group col-10">
                        <button type="submit" name="submit" class="btn btn-primary">Create Course</button>
                    </div>

                    <div class="form-group col-10">
                        <label style="color: red"><?php echo $createMsg; ?></label>
                    </div>
                </form>

                <div>
                        <h4>::Created Courses::</h4>
                </div>

                <div class="form-group" >
                    <?php

                        $db = new SQLite3('C:\xampp\Data\StudentModule.db');
                        $sql = "SELECT * FROM Courses ORDER BY Code ASC;";
                        $rows = $db->query($sql);

                        while($row=$rows->fetchArray()){

                            $row_array [] = $row;
                        }
          
                    ?>

                    <br>
                    <select class="form-control">
                        <?php
                            for ($i=0; $i<count($row_array); $i++): ?>
                             <option value=<?php echo "'".$row_array[$i]['Course']."'" ?>><?php echo $row_array[$i]['Code']."  ".$row_array[$i]['Course']?></option>
                       <?php endfor; ?>
                    </select>
                
                </div>


            </div>
        </div>

        <div>

        </div>


    </main>

</div>

<?php
    include("../Nav/loggedFooter.php");
?>