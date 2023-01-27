<?php
    require("../partials/session.php");
    require_once("../partials/connection.php");
    if(!empty($_POST)){
            $dept    = strtolower($_POST["depart"]);
            $sql = "SELECT * FROM department_tbl WHERE department = '$dept' LIMIT 1";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
        if ($row) { 
            if ($row['department'] === $dept) {        
                $_SESSION['warning_message'] = ucwords($dept). " already exists";
            }
        }else{
            $dept    = strtolower($_POST["depart"]);
            $sql = "INSERT INTO department_tbl (department) VALUES('$dept')";
            $result = mysqli_query($conn, $sql);
            $_SESSION['success_message'] =  ucwords($dept). " Added successfully !";
        }
    }
?>