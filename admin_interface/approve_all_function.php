<?php 
    include_once("../partials/session.php");
    include_once("../partials/connection.php");
    $sol = $_POST['sol'];
    if(!empty($_POST)){
        
        $query = "SELECT * FROM transaction_record";
        $res = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($res)){
            $sku = $row['sku'];
            $customer = $row['added_by'];
            $r_date = $row['added_at'];
            $qty = $row['quantities'];
            $stats = 1;
            if($sol > $qty){

                $sql1 = "INSERT INTO quantity_record (product_id, qty , stats , added_by) 
                VALUES ('$sku' , '$qty' , '$stats' , '$customer')";
                $result1 = mysqli_query($conn,$sql1);

                $sql = "INSERT INTO approve_record (c_id, item_id, quantity , request_date , act) 
                VALUES ('$customer', '$sku'  , '$qty' , '$r_date' , '0')";
                $result = mysqli_query($conn,$sql);

                $sqls = "DELETE FROM transaction_record";
                $results = mysqli_query($conn, $sqls);
                $_SESSION['success_message'] = "Approved successfully";

            }else{
                $_SESSION['danger_message'] = "Insufficient stock";
            }
        }
	}
?>