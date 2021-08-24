<?php 

function getModule() {

    $db = new SQLite3('C:\xampp\Data\StudentModule.db');
    $row_res = []; //prepare this empty array variable first

    if (!isset($_POST['filterLevel'])){ //this is hit when the page first loaded
        
        $stmt = "SELECT ModuleCode, ModuleName, ModuleLevel FROM Module";

        $rows = $db->query($stmt);
        //$row_res = [];
    
        while($row = $rows->fetchArray()) {
            $row_res [] = $row;
        }
    }
    else { //this is hit when the user select the drop down button and submit

        if ($_POST['filterLevel']!="All"){ //if the value selected is not All, should be a number i.e level

            $intLevel = intval($_POST['filterLevel']); //need to convert the string value into int because the field type in db is int
            //print_r("not all ".$intLevel);
            $stmt = $db->prepare('SELECT ModuleCode, ModuleName, ModuleLevel FROM Module WHERE ModuleLevel = :level');
            $stmt->bindParam(':level', $intLevel, SQLITE3_INTEGER);
            $result = $stmt->execute();
        
            while($row = $result->fetchArray()) {
                $row_res [] = $row;
            }
        }else { //otherwise the value should be All - from the drop down button

            //print_r("else ".$_POST['filterLevel']);
            $stmt = "SELECT ModuleCode, ModuleName, ModuleLevel FROM Module";

            $rows = $db->query($stmt);
            //$row_res = [];

            while($row = $rows->fetchArray()) {
                $row_res [] = $row;
            }
        }

    }

    return $row_res;

}



?>