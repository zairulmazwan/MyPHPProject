<?php

function insertStudPicture($sID, $fName)
{
    $created = false;
    $db = new SQLite3('C:\xampp\Data\StudentModule.db');
    $sql = 'INSERT INTO StudentPicture (StudentId, FileName) VALUES (:sID, :fName)';
    $stmt = $db->prepare($sql);

    $stmt->bindParam(':sID', $sID, SQLITE3_TEXT);
    $stmt->bindParam(':fName', $fName, SQLITE3_TEXT);
    

    $stmt->execute();

    if($stmt){
        $created = true;
    }

    return$created;

}

?>
