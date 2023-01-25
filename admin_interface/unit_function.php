<?php
    require("../partials/session.php");
    require_once("../partials/connection.php");
    if(!empty($_POST)){
            $units    = strtolower($_POST["units"]);
            $sql = "SELECT * FROM unit_tbl WHERE units = '$units' LIMIT 1";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
        if ($row) { 
            if ($row['units'] === $units) {        
                $_SESSION['warning_message'] = ucwords($units). " already exists";
            }
        }else{
            $units    = strtolower($_POST["units"]);
            $sql = "INSERT INTO unit_tbl (units) VALUES('$units')";
            $result = mysqli_query($conn, $sql);
            $_SESSION['success_message'] =  ucwords($units). " Added successfully !";
        }
    }
?>