<?php
    require("../partials/session.php");
    require_once("../partials/connection.php");
    if(!empty($_POST)){
            $sizes    = strtolower($_POST["sizes"]);
            $sql = "SELECT * FROM size_tbl WHERE sizes = '$sizes' LIMIT 1";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
        if ($row) { 
            if ($row['sizes'] === $sizes) {        
                $_SESSION['warning_message'] = ucwords($sizes). " already exists";
            }
        }else{
            $sizes    = strtolower($_POST["sizes"]);
            $sql = "INSERT INTO size_tbl (sizes) VALUES('$sizes')";
            $result = mysqli_query($conn, $sql);
            $_SESSION['success_message'] =  ucwords($sizes). " Added successfully !";
        }
    }
?>