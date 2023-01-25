<?php 
    include_once("../partials/session.php");
    include_once("../partials/connection.php");
    if(!empty($_POST)){
		for ($a = 0; $a < count($_POST["c_id"]); $a++){
			if($_POST['c_s'][$a] >= $_POST["cart"][$a]){
				$sql = "UPDATE transaction_record SET quantities = '".$_POST["cart"][$a]."' WHERE cart_id = '".$_POST["c_id"][$a]."'";
				mysqli_query($conn, $sql);
				$_SESSION['success_message'] = "Updated successfully.";
			}else{
				$_SESSION['danger_message'] = "Insufficient Stock.";
			}
		}
	}
?>