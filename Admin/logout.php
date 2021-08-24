<?php 

    if ($_GET['user']=="admin"){
        session_start();
        session_destroy();
        header('Location: ../Admin/LoginAdmin.php');
        exit;
    }
    else {
        session_start();
        session_destroy();
        header('Location: ../User/Login.php');
        exit;
    }
   


?>