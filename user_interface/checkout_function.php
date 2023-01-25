<?php 
    include_once("../partials/session.php");
    include_once("../partials/connection.php");
    // if(!empty($_POST)){
    if(isset($_POST['checkout'])){
        $query = "SELECT * FROM transaction_record WHERE added_by = '".$_SESSION['ID']."'";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result)){
            // variable = row
            // $sku = $row['sku'];
            // $qty = $row['quantities'];
            // $stats = 0; // for approval
            // $emp = $_SESSION['ID'];

            // insert
            // $sql = "INSERT INTO checkout (item_id , quantity , states , added_by)
            // VALUES ('$sku', '$qty', '$stats', '$emp')";
            // $res = mysqli_query($conn, $sql);

            // delete query
            // $squery = "DELETE  FROM add_to_cart WHERE added_by = '".$_SESSION['ID']."'";
            // $res_sql = mysqli_query($conn, $squery);
            $stat = 1; // 0 = add to cart , 1 = checkout , 2 = delete
            $dbsql = "UPDATE transaction_record SET stat = '$stat'";
            $results = mysqli_query($conn, $dbsql);
        }
        $_SESSION['success_message'] = "Checkout successfully.";
        header('Location: my_orders.php');

	}
?>