<?php 

    function verifyUsers () {
        if (!isset($_POST['usrname']) or !isset($_POST['password'])) {
            return;  // <-- return null;  
        }

        $db = new SQLite3('C:\xampp\Data\StudentModule.db');
        // WE HAVE A SECURITY PROBLEM HERE
        // because we are using _POST vars directly from the form, a bad user could inject code here
        // I explain this to you once
        // we'd need to "work" with this vars before using it in a query, but for a first approach to PHP is enough
        $stmt = $db->prepare('SELECT * FROM User WHERE Username=:usrname AND Password=:password');
        $stmt->bindParam(':usrname', $_POST['usrname'], SQLITE3_TEXT);
        $stmt->bindParam(':password', $_POST['password'], SQLITE3_TEXT); //what is SQLITE3_TEXT???

        // we are going to see what $rows have
        //die(print_r($stmt));

        // Is a type of SQLITE, defined in SQLite3 class
        // DOC: https://www.php.net/manual/en/sqlite3stmt.bindvalue.php
        $result = $stmt->execute();

        // TESTING
        // die stop a routine
        // var_dump or print_r show the content of a var/object, etc
        //die(print_r($result)); 
        // NO, this STOPS all and show what $result has
        // NO, result is: SQLiteResult object() 1
        // and I don't know why result object is empty
       
        while ($row=$result->fetchArray())
        {
            $rows_array[]=$row;
        }
        return $rows_array;

        //eturn $result;//OMG! Whats this
        // I'm reading the doc of the link before, and says that with SQLITE3_ASSOC returns an associative array only
        // if you don't put anything, it returns values twice, as an associative array an a non one
        // https://www.php.net/manual/en/sqlite3result.fetcharray.php
    }




//yes, was about to ask. Can i save this file outside htdoc?
// yes, you can save tis file in other location
// but don't worry because this file doesn't return anything, so you don't be worried about be called publicly
// I'm refering to other problem, with _GET or _POST var, we NEVER should use their values directly in a query
// we need to process their values before, to avoid an attack from a user
// that kind of attacks are called XSS (injection)



//==>we need to process their values before, to avoid an attack from a user. I dont understand
// we have several ways of secure our code
// ONE WAY: htmlspecialchars(), stripslahses()....
// OTHER WAY:
// using ->prepare() method of SQLite3 class, and ->bind() values
// parameters, as you read yesterday
