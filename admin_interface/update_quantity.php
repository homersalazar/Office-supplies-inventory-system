<?php 
    include_once("../partials/session.php");
    include_once("../partials/connection.php");
    if(!empty($_POST)){
		for ($a = 0; $a < count($_POST["qty_id"]); $a++){
            $sql = "UPDATE quantity_record SET qty = '".$_POST["qty"][$a]."' WHERE qty_id = '".$_POST["qty_id"][$a]."'";
            mysqli_query($conn, $sql);
            $_SESSION['success_message'] = "Updated successfully.";
		}
	}
?>