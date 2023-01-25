<?php
    require("../partials/session.php");
    require_once("../partials/connection.php");
    if(!empty($_POST)){
        $pro_id = $_POST['pro_id'];
        $qty = $_POST["input"];
        $stat = 0; // 0 = add to cart , 1 = checkout , 2 = approval
        $sql = "INSERT INTO transaction_record (sku , quantities, stat , added_by)
        VALUES('$pro_id' , '$qty' , '$stat' , '".$_SESSION['ID']."')";
        $result = mysqli_query($conn, $sql);
        $_SESSION['success_message'] =  "Add to cart successfully !";

    }
?>