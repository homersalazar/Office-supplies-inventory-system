<?php 
    include_once("../partials/session.php");
    include("../layouts/header.php");
    include_once("../partials/connection.php");
    include_once("../partials/navbar.php");
    include_once("../message/message_box.php");
    include_once("../partials/productbar.php");
    require("../admin_interface/modal.php");
    $sql = "SELECT item_name , colors , sizes , prod_id , units , img_name, 
    SUM( IF(stats = 0, qty, 0)) AS in_stock,
    SUM( IF(stats = 1, qty, 0)) AS out_stock
    FROM product_record
    LEFT JOIN color_tbl  
    ON product_record.color = color_tbl.color_id
    LEFT JOIN size_tbl  
    ON product_record.size = size_tbl.size_id
    LEFT JOIN unit_tbl  
    ON product_record.unit = unit_tbl.unit_id
    LEFT JOIN quantity_record  
    ON product_record.prod_id = quantity_record.product_id
    GROUP BY prod_id
    ORDER BY item_name ASC 
    ";
    $result = mysqli_query($conn, $sql);  
?>
<style>
.dataTables_paginate {
  width: 100%;
  text-align: center;
}

</style>
<div class="edit_container mt-4">
    <div class="row text-center ">
        <div class="col-2"></div>
        <div class="col-lg-8">
            <div class="mt-1">
                <p class="fw-bold">Edit Product</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8 mb-3">
            <table id="product_table" class="table">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Product</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  while($row = mysqli_fetch_array($result)){ 
                        $color = !empty($row["colors"])  ? "| Color: ".ucwords($row["colors"]) : "" ;
                        $image = "";
                        $img = $row['img_name'];
                        if($img == ""){ 
                            $image = '<img src="../product/not-available.png" id="output" width="55" height="55"/>';
                        }else{
                            $image = '<img src="../product/'.$row['img_name'].'" id="output" width="55" height="55"/>';
                        }
                        $sol = (int)$row['in_stock'] - (int)$row['out_stock'];
                        $status = "";
                        if($sol <= 5){
                            $status = "Low Stock";
                            $hue = 'class="pt-4 text-warning"';
                        }   
                        if($sol == 0){
                            $status = "Out of Stock"; 
                            $hue = 'class="pt-4 text-danger"';
                        }
                        if($sol > 5){
                            $hue = 'class="pt-4 text-success"';
                            $status = "Available";
                        }
                        ?>
                        <tr>
                            <td><?php echo $image; ?></td>
                            <td><a href="update_product.php?id=<?php echo $row['prod_id'];  ?>"><?php echo ucwords($row['item_name']); ?> <?php echo ucwords($row['sizes']); ?></a> <br> 
                                Product #: 00<?php echo $row['prod_id']; ?> <?php echo $color; ?>
                            </td>
                            <td class="pt-4"><a class="dark" href="quantity_history.php?id=<?php echo $row['prod_id']; ?>"><?php echo $sol; ?> <?php echo ucwords($row['units']); ?></a></td>
                            <td <?php echo $hue; ?>><?php echo $status; ?></td>
                        </tr>
                    <?php  }   ?>  
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>

    $(document).ready( function () {
        $('#product_table').DataTable({
            "bLengthChange": false,
            "bInfo": false,
        });
    });
</script>
<?php 
    include("../layouts/footer.php");
?>