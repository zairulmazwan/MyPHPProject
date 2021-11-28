<?php 

    function insertModule()
    {
        //from the previous page i.e from, we know that we have 2 fields that allow multiple-choice
        //Thus, we need to prepare variables to get those multiple choice as a text
        $course = ""; //we need this variable because we want to save the record as a text, e,g "aaaa, bbbb, cccc"
        $year = ""; //we need this variable because we want to save the record as a text, e,g "1, 2, 3"
        $created = false;//for the result of sql execution
        $courseList = $_POST['course'];//we get the array of course (multiple select)

       
        if (isset($_POST["course"]))
        {
             //$_POST["course"] is an array, we need to get each element and add into a text
            foreach ($courseList as $cr) //this is how foreach is used in PHP
            {
                $course .= $cr.","; //this is where we concatenate the elements become a text. Each element is separated by a ","
            }
        }

        if (isset($_POST["year"]))
        {
            //$_POST["year"] is an array, we need to get each element and add into a text
            foreach ($_POST['year'] as $yr) 
            {
                $year .= $yr.","; //this is where we concatenate the elements become a text. Each element is separated by a ","
            }
        }

        //db connection
        $db = new SQLite3('C:\xampp\Data\StudentModule.db');
        $sql = 'INSERT INTO Module(ModuleCode, ModuleName, ModuleLevel, ModuleCourse, ModuleYear, ModuleStatus) VALUES(:MCode, :MName, :Mlevel, :MCourse, :MYear, :MStatus)';
        $stmt = $db->prepare($sql);

        $stmt->bindParam(':MCode', $_POST['mcode'], SQLITE3_TEXT);
        $stmt->bindParam(':MName', $_POST['mname'], SQLITE3_TEXT);
        $stmt->bindParam(':Mlevel', $_POST['mlevel'], SQLITE3_INTEGER); //level in the table is defined as integer, thus we use INTEGER
        $stmt->bindParam(':MCourse', $course, SQLITE3_TEXT);
        $stmt->bindParam(':MYear', $year, SQLITE3_TEXT);
        $stmt->bindParam(':MStatus', $_POST['status'], SQLITE3_TEXT);

        
        $stmt->execute();
        
        if ($stmt) //if the statement successfully executed, we changed the variable's value to true, otherwise it's false
        {
            $created=true;
        }
        return $created;
    }
