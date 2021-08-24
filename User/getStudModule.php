<?php

function getModule($stdId){

    $db = new SQLite3('C:\xampp\Data\StudentModule.db');
    $sql = "SELECT * FROM RegisteredModule WHERE StdID = :stdID";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':stdID', $stdId, SQLITE3_TEXT);
    //echo $stdId;
    $results = $stmt->execute();
    $rows_array = [];

    while($row = $results->fetchArray()){
        $rows_array[]=$row;
    }
    return $rows_array;
}

function getModuleName ($moduleCode){

    $db = new SQLite3('C:\xampp\Data\StudentModule.db');
    $rows_array = [];

    for ($i=0; $i<count($moduleCode); $i++){
        
        $sql = "SELECT ModuleName FROM Module WHERE ModuleCode = :modCode";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':modCode', $moduleCode[$i]['ModuleCode'], SQLITE3_TEXT);
        $results = $stmt->execute();
    
        while($row = $results->fetchArray()){
            $rows_array[]=$row;
        }

    }

    return $rows_array;
}







