
<?php

function getSearchStudents () {
	
	$db = new SQLite3('C:\xampp\Data\StudentModule.db');
	$rows = $db->query('SELECT * FROM Student');
	
	while ($row=$rows->fetchArray())
	{
		$rows_array[]=$row;
	}
	return $rows_array;
	
   }
?>
