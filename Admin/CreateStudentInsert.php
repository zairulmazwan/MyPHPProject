<?php

function createStudent()
{
    $created = false;
    $db = new SQLite3('C:\xampp\Data\StudentModule.db');
    $sql = 'INSERT INTO Student(StdID, StdName, StdCourse, StdLevel, StdEmail) VALUES (:sID, :sName, :sCourse, :sLevel, :sEmail)';
    $stmt = $db->prepare($sql);

    $stmt->bindParam(':sID', $_POST['studID'], SQLITE3_TEXT);
    $stmt->bindParam(':sName', $_POST['studName'], SQLITE3_TEXT);
    $stmt->bindParam(':sCourse', $_POST['studCourse'], SQLITE3_TEXT);
    $stmt->bindParam(':sLevel', $_POST['studLevel'], SQLITE3_TEXT);
    $stmt->bindParam(':sEmail', $_POST['studEmail'], SQLITE3_TEXT);

    $stmt->execute();

    if($stmt){
        $created = true;
    }

    return$created;

}

?>

