<?php 
    include_once("../partials/session.php");
    $page = " Shopping Cart";
    $topbar = "SHOPPING CART";
    include("../layouts/header.php");
    include_once("../partials/navbar.php");
    include_once("../message/message_box.php");
    require_once("../user_interface/my_modal.php");
    include_once("../partials/connection.php");
    include_once("../partials/breadcrumb.php");
    include_once("../partials/topbar.php");
    $sql = "SELECT * , fname , date_format(transaction_record.added_at,'%m-%d-%Y') AS dates , qty , 
    SUM( IF(quantity_record.stats = 0, qty, 0)) AS in_stock,
    SUM( IF(quantity_record.stats = 1, qty, 0)) AS out_stock
    FROM transaction_record
    LEFT JOIN product_record 
    ON product_record.prod_id = transaction_record.sku
    LEFT JOIN color_tbl  
    ON product_record.color = color_tbl.color_id
    LEFT JOIN size_tbl  
    ON product_record.size = size_tbl.size_id
    LEFT JOIN unit_tbl  
    ON product_record.unit = unit_tbl.unit_id
    LEFT JOIN quantity_record  
    ON quantity_record.product_id = transaction_record.sku
    LEFT JOIN user_record  
    ON transaction_record.added_by = user_record.user_id
    GROUP BY item_name
    ORDER BY item_name ASC
    ";
    $result = mysqli_query($conn,$sql);
?>
<div class="shopping-container">
    <div class="row">
        <div class="col-md-12 text-center mt-4">
            <p class=" fw-bold">Below are the contents of all shopping cart.</p>
            <p>To approve all of an item, enter and click on the APPROVE ALL button.</p>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-2"></div>
        <div class="col-8">
            <table id="request_table" class="table">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Product</th>
                        <th scope="col">Current Stock</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Requester</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  while($row = mysqli_fetch_array($result)){ 
                        $color = !empty($row["colors"])  ? "| Color: ".ucwords($row["colors"]) : "" ;
                        $sol = (int)$row['in_stock'] - (int)$row['out_stock'];

                        ?> 
                        <tr>
                            <td class="pt-3"><button type="button" class="btn shadow-none text-success fa fa-check" onclick="APPROVED('<?php echo $row['cart_id']; ?>' , '<?php echo $sol; ?>')"> </button></td>
                            <td>
                                <?php echo ucwords($row['item_name']); ?> <?php echo ucwords($row['sizes']); ?><br> 
                                Product #: 00<?php echo $row['prod_id']; ?> <?php echo $color; ?>                                
                            </td>                            
                            <td class="pt-3"><?php echo $sol; ?> <?php echo ucwords($row['units']) ?></td>
                            <td class="pt-3"><?php echo $row['quantities']; ?> <?php echo ucwords($row['units']) ?></td>
                            <td class="pt-3"><?php echo ucwords($row['fname']) ?></td>
                            <td class="pt-3"><?php echo $row['dates']; ?></td>
                            <input type="hidden" name="sol" id="sol" form="approve_form" value="<?php echo $sol; ?>" class="form-control">
                            <input type="hidden" name="c_id" id="c_id" form="approve_form" value="<?php echo $row['cart_id']; ?>" class="form-control">
                        </tr>
                    <?php } ?> 
                </tbody>
            </table>
        </div>
    </div>
    <form id="approve_form" method="post">
        <div class="row">
            <div class="col-md-12 text-center mt-3">
                <button type="submit" name="submit" id="submit" class="btn btn-primary shadow-none btn-block button">APPROVE ALL</button>
            </div>
        </div>
    </form>
</div>

<script>
    function APPROVED(cart_id , total){
        var proceeds = confirm("This action will approved this request. Are you sure?");
        if (proceeds) {
            $.ajax({
                url: "approve_function.php",
                type: "POST",
                cache: false,
                data:{
                    id: cart_id,
                    total: total,
                },
                success:function(data){   

                }  
            });
        }
    }

    $(document).ready( function () {
        $('#approve_form').on("submit", function(event){ 
            $.ajax({  
                url:"approve_all_function.php",  
                method:"POST",  
                data:$('#approve_form').serialize(),  
                success:function(data){ 

                }  
            });     
        });

        $('#request_table').DataTable();
    });
</script>
<?php 
    include_once("../layouts/footer.php");
?>