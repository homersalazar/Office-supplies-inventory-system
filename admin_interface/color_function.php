<?php
    require("../partials/session.php");
    require_once("../partials/connection.php");
    if(!empty($_POST)){
            $colors    = strtolower($_POST["colors"]);
            $sql = "SELECT * FROM color_tbl WHERE colors = '$colors' LIMIT 1";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
        if ($row) { 
            if ($row['colors'] === $colors) {        
                $_SESSION['warning_message'] = ucwords($colors). " already exists";
            }
        }else{
            $colors    = strtolower($_POST["colors"]);
            $sql = "INSERT INTO color_tbl (colors) VALUES('$colors')";
            $result = mysqli_query($conn, $sql);
            $_SESSION['success_message'] =  ucwords($colors). " Added successfully !";
        }
    }
?>