<?php
    require("../partials/session.php");
    require_once("../partials/connection.php");
    if(!empty($_POST)){
        $product = strtolower($_POST['product_name']);
        $attr = $_POST['attr'];
        $size = $_POST['size_id'];
        $color = $_POST['color_id'];
        $unit = $_POST['unit_id'];

        $sql = "INSERT INTO product_record (item_name , attr , unit , size , color) 
        VALUES ('$product' , '$attr' , '$unit' , '$size' , '$color')";
        $result =  mysqli_query($conn, $sql);
        $_SESSION['success_message'] =  " Added successfully !";
    }
?>