<?php 

    function insertModule()
    {

        $course = "";
        $year = "";
        $created = false;
        $courseList = $_POST['course'];

        if (isset($_POST["course"]))
        {
            foreach ($courseList as $cr) 
            {
                $course .= $cr.",";
            }
        }

        if (isset($_POST["year"]))
        {
            foreach ($_POST['year'] as $yr) 
            {
                $year .= $yr.",";
            }
        }

        //echo("Course : ".$course);
        //echo("Year : ".$year);
        //echo("error is here");

        $db = new SQLite3('C:\xampp\Data\StudentModule.db');
        $sql = 'INSERT INTO Module(ModuleCode, ModuleName, ModuleLevel, ModuleCourse, ModuleYear, ModuleStatus) VALUES(:MCode, :MName, :Mlevel, :MCourse, :MYear, :MStatus)';
        $stmt = $db->prepare($sql);

        $stmt->bindParam(':MCode', $_POST['moduleCode'], SQLITE3_TEXT);
        $stmt->bindParam(':MName', $_POST['moduleName'], SQLITE3_TEXT);
        $stmt->bindParam(':Mlevel', $_POST['level'], SQLITE3_INTEGER);
        $stmt->bindParam(':MCourse', $course, SQLITE3_TEXT);
        $stmt->bindParam(':MYear', $year, SQLITE3_TEXT);
        $stmt->bindParam(':MStatus', $_POST['status'], SQLITE3_TEXT);

        
        $stmt->execute();
        
        if ($stmt)
        {
            $created=true;
        }
        return $created;
        
    }


?>