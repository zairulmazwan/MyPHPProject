
<?php

function filterStudent () {

    $db = new SQLite3('C:\xampp\Data\StudentModule.db');

    if (!isset($_POST['filterLevel'])) {
        
	    $rows = $db->query('SELECT * FROM Student');

        while ($row=$rows->fetchArray())
        {
            $rows_array[]=$row;
        }
        return $rows_array;
    }
    else
    {
        if ($_POST['filterLevel']!="All")
        {
            $stmt = $db->prepare('SELECT * FROM Student WHERE StdLevel=:level');
            $stmt->bindParam(':level', $_POST['filterLevel'], SQLITE3_TEXT);
    
            $result = $stmt->execute();
            //print_r("Level - ".$_POST['filterLevel']);
            $rows_array = [];//need this because the array can be empty
            while ($row=$result->fetchArray())
            {
                $rows_array[]=$row;
            }
            return $rows_array;
        }
        else
        {
            //print_r($_POST['filterLevel']);
            $rows = $db->query('SELECT * FROM Student');
            //print_r($rows);
    
            while ($row=$rows->fetchArray())
            {
                $rows_array[]=$row;
            }
            return $rows_array;
    
        }
    }

}
?>
