<?php 
include("../Nav/Admin/loggedHeaderAdmin.php");
include("../Session/session.php");


$path = "../Admin/LoginAdmin.php"; //this path is to pass to checkSession function from session.php 
     
session_start(); //must start a session in order to use session in this page.
if (!isset($_SESSION['name'])){
    session_unset();
    session_destroy();
    header("Location:".$path);//return to the login page
}

$user = $_SESSION['name'];
checkSession ($path); //calling the function from session.php

if ($_POST['StdName'] && $_POST['StdCourse'] && $_POST['StdLevel'] && $_POST['StdEmail']){

    //$stdID = str_replace(" ", "", $_POST['StdId']);
    //print_r("Std IDxx".$stdID);

    $db = new SQLite3 ('C:\xampp\Data\StudentModule.db');
    $sql = "UPDATE Student SET StdName = :SName, StdCourse = :SCourse, StdLevel = :SLevel, StdEmail = :SEmail WHERE StdID = :SID";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':SName', $_POST['StdName'], SQLITE3_TEXT);
    $stmt->bindParam(':SCourse', $_POST['StdCourse'], SQLITE3_TEXT);
    $stmt->bindParam(':SLevel', $_POST['StdLevel'], SQLITE3_TEXT);
    $stmt->bindParam(':SEmail', $_POST['StdEmail'], SQLITE3_TEXT);
    $stmt->bindParam(':SID', $_POST['StdId'], SQLITE3_TEXT);

    if ($stmt->execute()){
    //echo "Record updated successfully";
    //echo "<script>alert('Update Successful!');</script>"; 
        header("Location:ViewFilterStudent.php?updated=true");//return to the login page
    }
}
else{
    header("Location:ViewFilterStudent.php?updated=false");//return to the login page
}


?>