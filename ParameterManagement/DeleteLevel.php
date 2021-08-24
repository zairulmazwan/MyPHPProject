<?php 

$Id = $_GET['Id']; //i just tested to convert the value into int, before this i dont convert. but still not ok

echo $Id;

if (isset($Id)){

    $db = new SQLite3('C:\xampp\Data\StudentModule.db');
    $sql = "DELETE FROM Level WHERE Id = :LvId";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':LvId', $Id, SQLITE3_TEXT);
    $stmt->execute();
    header("Location:createLevel.php");
}

?>