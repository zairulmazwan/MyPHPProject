<?php 

    function verifyUsers () {

        if (!isset($_POST['usrname']) or !isset($_POST['password'])) {
            return;  // <-- return null;  
        }

        $db = new SQLite3('C:\xampp\Data\StudentModule.db');
        $stmt = $db->prepare('SELECT UserName, userId, firstName FROM User WHERE UserName=:usrname AND Password=:password AND Status="active"');
        $stmt->bindParam(':usrname', $_POST['usrname'], SQLITE3_TEXT);
        $stmt->bindParam(':password', $_POST['password'], SQLITE3_TEXT);

        $result = $stmt->execute();

        $rows_array = [];
        while ($row=$result->fetchArray())
        {
            $rows_array[]=$row;
        }
        return $rows_array;
    }
