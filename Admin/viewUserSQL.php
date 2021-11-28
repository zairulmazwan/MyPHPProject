<?php

function getUsers (){
    $db = new SQLITE3('C:\xampp\Data\StudentModule.db');
    $sql = "SELECT * FROM User";
    $stmt = $db->prepare($sql);
    $result = $stmt->execute();

    $arrayResult = [];//prepare an empty array first
    while ($row = $result->fetchArray()){ // use fetchArray(SQLITE3_NUM) - another approach
        $arrayResult [] = $row;
    }
    return $arrayResult;
}
