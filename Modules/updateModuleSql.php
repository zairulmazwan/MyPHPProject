<?php

function updateModule (){

    $success = false;
    $course = "";
    $year = "";
    //print_r($_POST['course']);
    $courseList = $_POST['course'];
        //adding course into a string -> $course
        if (isset($_POST["course"]))
        {
            foreach ($courseList as $cr) 
            {
                $course .= $cr.",";
            }
        }
        //adding year into a string -> $year
        if (isset($_POST["year"]))
        {
            foreach ($_POST['year'] as $yr) 
            {
                $year .= $yr.",";
            }
        }

    $db = new SQLite3 ('C:\xampp\Data\StudentModule.db');
    $sql = "UPDATE Module SET ModuleCode = :MCode, ModuleName = :MName, ModuleLevel = :MLevel, ModuleCourse = :MCourse, ModuleYear = :MYear, ModuleStatus = :MStat WHERE ModuleCode = :ModuleCodeOld";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':MCode', $_POST['moduleCode'], SQLITE3_TEXT);
    $stmt->bindParam(':MName', $_POST['moduleName'], SQLITE3_TEXT);
    $stmt->bindParam(':MLevel', $_POST['level'], SQLITE3_TEXT);
    $stmt->bindParam(':MCourse', $course, SQLITE3_TEXT);
    $stmt->bindParam(':MYear', $year, SQLITE3_TEXT);
    $stmt->bindParam(':MStat', $_POST['status'], SQLITE3_TEXT);
    $stmt->bindParam(':ModuleCodeOld', $_POST['moduleCodeOld'], SQLITE3_TEXT);

    if ($stmt->execute()){
        $success = true;
    }
  return $success;
}

?>