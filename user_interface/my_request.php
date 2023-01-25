<?php 
    include_once("../partials/session.php");
    $page = "My Request";
    $topbar = "MY REQUEST";
    include("../layouts/header.php");
    require_once("../user_interface/my_modal.php");
    include_once("../partials/navbar.php");
    include_once("../partials/breadcrumb.php");
    include_once("../partials/topbar.php");
    include_once("../message/message_box.php");
    $sql = "SELECT * , date_format(added_at,'%m-%d-%Y') AS dates
    FROM transaction_record 
    LEFT JOIN product_record
    ON product_record.prod_id = transaction_record.sku
    LEFT JOIN size_tbl  
    ON product_record.size = size_tbl.size_id
    LEFT JOIN color_tbl  
    ON product_record.color = color_tbl.color_id
    LEFT JOIN unit_tbl  
    ON product_record.unit = unit_tbl.unit_id
    WHERE stat = 1 AND added_by = '".$_SESSION['ID']."'";
    $result = mysqli_query($conn, $sql);
?>
<div class="account-container">
    <div class="row">
        <div class="col-md-12 text-center mt-4">
            <p class="fw-bold">My Request</p>
            <p>To view the list of checkout items, select the item you wish to cancel and click on the Cancel Selected button.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <table class="table center">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col">Product</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Status</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  while($row = mysqli_fetch_array($result)){ 
                       // for image 
                        $img = $row['img_name'];
                        if($img == ""){ 
                            $image = '<img src="../product/not-available.png" id="output" width="55" height="55"/>';
                        }else{
                            $image = '<img src="../product/'.$row['img_name'].'" id="output" width="55" height="55"/>';
                        }

                        // for color
                        $color = !empty($row["colors"])  ? "| Color: ".ucwords($row["colors"]) : "" ;

                        ?>
                        <tr>
                            <td class="pt-3"><button type="button" class="btn shadow-none text-danger fa fa-ban" onclick="CANCEL('<?php echo $row['cart_id']; ?>')"> </button></td>
                            <td><?php echo $image; ?></td>
                            <td>
                                <?php echo ucwords($row['item_name']); ?> <?php echo ucwords($row['sizes']); ?><br> 
                                Product #: 00<?php echo $row['prod_id']; ?> <?php echo $color; ?>    
                            </td>
                            <td class="pt-4"><?php echo $row['quantities']; ?> <?php echo ucwords($row['units']); ?></td>
                            <td class="pt-4"><?php if($row['stat'] = 2){ echo "Pending"; } ?></td>
                            <td class="pt-4"><?php echo $row['dates']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
         </div>
    </div>
</div>
<script>
    function CANCEL(cart_id){
        var proceeds = confirm("This action will cancel order. Are you sure?");
        if (proceeds) {
            $.ajax({
                url: "cancel_function.php",
                type: "POST",
                cache: false,
                data:{
                    id: cart_id,
                },
                success:function(data){   
                    window.location.href = "my_request.php";
                }  
            });
        }
    }
</script>
<?php 
    include_once("../layouts/footer.php");
?>