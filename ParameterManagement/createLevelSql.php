<?php 

function createLevel ($level, $Des){

    $db = new SQLite3('C:\xampp\Data\StudentModule.db');
    $sql = "INSERT INTO Level(Level, Description) VALUES (:Level, :Des)";
    $stmt = $db->prepare($sql);

    $stmt->bindParam(':Level', $level, SQLITE3_TEXT);
    $stmt->bindParam(':Des', $Des, SQLITE3_TEXT);

    $stmt->execute();

    if ($stmt)
    {
        echo "Level has been created";
    }
    else{
        echo "There was an error to create the level";
    }




}




