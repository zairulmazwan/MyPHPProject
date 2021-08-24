<?php
    echo "Deleting...";

    $test=false;
    $courseCode = $_GET["code"];


    $db = new SQLite3('C:\xampp\Data\StudentModule.db');
    $sql = "DELETE FROM Courses WHERE Code = :code";
    $stmt = $db->prepare($sql);
    //bindParam(':usrname', $_POST['usrname'], SQLITE3_TEXT);
    $stmt->bindParam(':code', $courseCode, SQLITE3_TEXT);
    $stmt->execute();

    if ($stmt){
        echo $courseCode;
        header("Location: DeleteCourse.php");
    }
    else{
        echo "Deletion was not successful";
    }
?>