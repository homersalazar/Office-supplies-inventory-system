<?php
    require_once("../partials/session.php");
    require_once("../partials/connection.php");
    $id = $_POST["id"]; 
    if(!empty($_POST)){
        $sql = "DELETE FROM transaction_record  WHERE cart_id = '$id'";
        $result = mysqli_query($conn, $sql);
        $_SESSION['success_message'] = "Cancelled successfully";
    }
?>