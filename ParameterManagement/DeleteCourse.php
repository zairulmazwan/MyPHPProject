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
        <h2>Parameter Deletion : Course</h2>

        <br>
            <div class=" form-group col-5"> 
                <?php

                    $db = new SQLite3('C:\xampp\Data\StudentModule.db');
                    $sql = "SELECT * FROM Courses ORDER BY Code ASC;";
                    $rows = $db->query($sql);

                    while($row=$rows->fetchArray()){

                        $row_array [] = $row;
                    }

                ?>

                <div class="row form-group">
                    <select class="form-control course" name="course" id="courseSelect">
                        <?php
                            for ($i=0; $i<count($row_array); $i++): ?>
                                <option value=<?php echo '"'.$row_array[$i]['Code']." ".$row_array[$i]['Course'].'"' ?>><?php echo $row_array[$i]['Code']."  ".$row_array[$i]['Course']?></option>
                        <?php endfor; ?>
                    </select>
                </div>
            
            </div>
         <br>  
        
        <div class="row form-group col-8">
            <button type="button" onclick="getCourse ()" class="btn btn-danger">Select to delete</button>
        </div>
      

         <br>             
        <div class="col-8">
              <table class="table" id="selectTable">
              </table>        
        </div>

        <!-- <div><p id="test"></p></div> -->
       


    </main>
</div>

<script>    
    function getCourse ()
    {
        document.getElementById("selectTable").innerHTML = ""; //dummy value first
        var course = document.getElementById("courseSelect").value; //get the value from the tag  i.e drop down button
        var table = document.getElementById("selectTable"); //create a table
        var row = table.insertRow(0); //insert a row into the table
        var cell1 = row.insertCell(0); //insert the column into the row - col 1
        var cell2 = row.insertCell(1); //insert the column into the row - col 2

        var splitCourse = course.split(" ");//splitting the code and course name. We need the course ID to be passed to another process
        cell1.innerHTML = course;//splitCourse[0]+" "+splitCourse[1]; change that course to splitCourse[1], see what happens?
        var del = "<?php echo "Do you really want to delete?"; ?>"; //the example how to embed php code in js
        del = del.bold(); //making the text bold
        var linkable = del.link('DeleteRecordCourse.php?code='+splitCourse[0]); //to make the value linkable, and pass a parameter i.e code
        cell2.innerHTML = linkable; //add the value into the table
        //document.getElementById("test").innerHTML = course;

        //this is for the header
        var table = document.getElementById("selectTable");
        var rowHeader = table.insertRow(0);
        var cell1 = rowHeader.insertCell(0);
        var cell2 = rowHeader.insertCell(1);

        cell1.innerHTML = "Course";
        cell2.innerHTML = "Action";


    }
</script>

<?php 


function deleteRecord($course){

    $courseSplit = explode(" ", $course);
    $code = $courseSplit[0];

    $db = new SQLite3('C:\xampp\Data\StudentModule.db');
    $sql = "DELETE FROM Courses WHERE Code = :code";
    $stmt = $db->prepare($sql);
    //bindParam(':usrname', $_POST['usrname'], SQLITE3_TEXT);
    $stmt.bindParam(':code', $code, SQLITE3_TEXT);
    $stmt->execute();
    //header("Location:DeleteCourse.php");

}


include("../Nav/loggedFooter.php");

?>
