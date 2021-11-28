<?php

function getModule() {

    $db = new SQLite3('C:\xampp\Data\StudentModule.db');
    $modules = []; //prepare this empty array variable first
    
    //this if is hit when the page is loaded. The input fileterLevel is null
    if (!isset($_POST['filterLevel'])){
        $stmt = "SELECT ModuleCode, ModuleName, ModuleLevel FROM Module";

        $rows = $db->query($stmt);
    
            while($row = $rows->fetchArray()) {
                $modules [] = $row;
            }
    }
    else{//if the user starts to select the option AND clicks the filter button, this else is hit

        //if the value of level selected by the use is not All (i.e 3,4...8) we go to this if
        if ($_POST['filterLevel'] != "All"){

            $level = intval($_POST['filterLevel']);//we define levels as string. Here is how we do type casting - the value becomes integer
            $sql = "SELECT * FROM Module WHERE ModuleLevel = :level";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':level', $level, SQLITE3_INTEGER);
            $results = $stmt->execute();

            while($row = $results->fetchArray()){
                $modules [] = $row;
            }
        }
        else{//otherwise, All is selected and we'll diplay all records

            $stmt = "SELECT ModuleCode, ModuleName, ModuleLevel FROM Module";

            $rows = $db->query($stmt);
    
            while($row = $rows->fetchArray()) {
                $modules [] = $row;
            }
        }
    }
   
    return $modules;
}