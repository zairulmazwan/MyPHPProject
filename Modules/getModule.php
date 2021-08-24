
<?php

function getModules (){

    $db = new SQLite3('C:\xampp\Data\StudentModule.db');
    $stmt = $db->prepare('SELECT * FROM Module');

    $result = $stmt->execute();
    $rows_array = [];//need this because the array can be empty
    while ($row=$result->fetchArray())
    {
        $rows_array[]=$row;
    }
    return $rows_array;

}

?>