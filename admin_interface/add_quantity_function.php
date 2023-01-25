<?php 
    include_once("../partials/session.php");
    include_once("../partials/connection.php");
    if(!empty($_POST)){
		$stats = 0; // add
		for ($a = 0; $a < count($_POST["prod_id"]); $a++){
			
			$sql = "INSERT INTO quantity_record (product_id, qty, added_by , stats) 
            VALUES ('" . $_POST["prod_id"][$a] . "', '" . $_POST["quantity"][$a] . "'  , '" . $_SESSION["ID"] . "' , $stats)";
			mysqli_query($conn, $sql);
		}
        $_SESSION['success_message'] = "Product quantity has been added.";

	}
?>