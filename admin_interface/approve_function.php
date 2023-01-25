<?php
    require_once("../partials/session.php");
    require_once("../partials/connection.php");
    $id = $_POST["id"]; 
    if(!empty($_POST)){
        $total = $_POST["total"];
        $query = "SELECT * FROM transaction_record WHERE cart_id = '$id'";
        $res = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($res)){
            $sku = $row['sku'];
            $customer = $row['added_by'];
            $r_date = $row['added_at'];
            $qty = $row['quantities'];
            $stats = 1;
            if($total > $qty){
                $sql1 = "INSERT INTO quantity_record (product_id, qty , stats , added_by) 
                VALUES ('$sku' , '$qty' , '$stats' , '$customer')";
                $result1 = mysqli_query($conn,$sql1);

                $sql = "INSERT INTO approve_record (c_id, item_id, quantity , request_date , act) 
                VALUES ('$customer', '$sku'  , '$qty' , '$r_date' , '0')";
                $result = mysqli_query($conn,$sql);

                $sqls = "DELETE FROM transaction_record  WHERE cart_id = '$id'";
                $results = mysqli_query($conn, $sqls);
                $_SESSION['success_message'] = "Approved successfully";

            }
        }

    }
?>