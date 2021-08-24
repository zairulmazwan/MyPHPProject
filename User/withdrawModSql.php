<?php
    include ("../Session/session.php");
    $path = "../User/Login.php";
    session_start(); //must start a session in order to use session in this page.
    if (!isset($_SESSION['name'])){
        session_unset();
        session_destroy();
        header("Location:".$path);//return to the login page
    }

    $user = $_SESSION['name'];
    checkSession ($path); //calling the function from session.php

    $modCode = $_POST['moduleCode'];
    $studId = $_SESSION['stdID'];

    $db = new SQLite3('C:\xampp\Data\StudentModule.db');

    $stmt = "DELETE FROM RegisteredModule WHERE StdID = :stdID AND ModuleCode = :mCode";
    $sql = $db->prepare($stmt);
    $sql->bindParam(':stdID', $studId, SQLITE3_TEXT);
    $sql->bindParam(':mCode', $modCode, SQLITE3_TEXT);

    $sql->execute();
    header("Location:myModule.php");

?>