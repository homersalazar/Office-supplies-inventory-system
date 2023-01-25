<?php
    session_start();
    // Destroy session
    unset($_SESSION['UserEmail']);
    unset($_SESSION['UserType']);
    echo header("Location: ../user/login.php");
    
?>