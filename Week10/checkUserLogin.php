<?php

function verifyUsers () {

if (!isset($_POST['uname']) or !isset($_POST['pwd'])) {
    return;  // <-- return null;  
}

$db = new SQLite3('C:\xampp\Data\StudentModule.db');
$stmt = $db->prepare('SELECT UserName, userId, firstName, Role FROM User WHERE UserName=:usrname AND Password=:password AND Status="active"');
$stmt->bindParam(':usrname', $_POST['uname'], SQLITE3_TEXT);
$stmt->bindParam(':password', $_POST['pwd'], SQLITE3_TEXT);

$result = $stmt->execute();

$rows_array = [];
while ($row=$result->fetchArray())
{
    $rows_array[]=$row;
}
return $rows_array;
}
