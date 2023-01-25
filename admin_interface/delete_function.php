<?php
    require_once("../partials/session.php");
    require_once("../partials/connection.php");
    $id = $_POST["id"]; 
    if(!empty($_POST)){
        $sql = "DELETE  FROM quantity_record WHERE qty_id = '$id'";
        $result = mysqli_query($conn, $sql);
        $_SESSION['success_message'] = "Deleted successfully";
    }
?>