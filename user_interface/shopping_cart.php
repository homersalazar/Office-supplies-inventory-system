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
    $query = "SELECT item_name, colors, sizes, prod_id, units, img_name, cart_id, sku,
    SUM( IF(stat = 0, quantities, 0)) AS cart,
    SUM( IF(stats = 0, qty, 0)) AS in_stock,
    SUM( IF(stats = 1, qty, 0)) AS out_stock

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
    ON product_record.prod_id = quantity_record.product_id

    WHERE transaction_record.added_by = '".$_SESSION['ID']."' AND stat = '0'
    GROUP BY item_name
    ORDER BY item_name ASC
    ";
    $result = mysqli_query($conn, $query);  
?>
<div class="shopping-container">
    <div class="row">
        <div class="col-md-12 text-center mt-4">
            <p class=" fw-bold">Below are the contents of your shopping cart.</p>
            <p>To update the quantity of an item, enter the new quantity and click on the UPDATE button.</p>
            <p>To remove an item, select the item you wish to remove and click on the Remove Selected button.</p>
        </div>
    </div>
    <form id="shopping_form" method="POST">
        <div class="row">
            <div class="col-md-12 text-center mt-3">
                <button type="submit" name="update" id="update" class="btn btn-primary btn-sm btn-block shadow-none button" onclick="UP()">UPDATE</button>
            </div>
        </div>
    </form>
    <div class="row mt-4">
        <div class="col-2"></div>
        <div class="col-8">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col">Product</th>
                        <th scope="col">Current Stock</th>
                        <th scope="col">Quantity</th>
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
                        $cart = $row['cart_id'];
                        ?>
                        <tr>
                            <td class="pt-3"><button type="button" class="btn shadow-none text-primary fa fa-trash" onclick="DEL('<?php echo $row['cart_id']; ?>')"> </button></td>
                            <td><?php echo $image; ?></td>
                            <td>
                                <?php echo ucwords($row['item_name']); ?> <?php echo ucwords($row['sizes']); ?><br> 
                                Product #: 00<?php echo $row['prod_id']; ?> <?php echo $color; ?>                                
                            </td>
                            <td class="pt-4"><?php echo $sol; ?> <?php echo ucwords($row['units']); ?></td>
                            <td class="pt-3"><input type="text" id="cart" name="cart[]" form="shopping_form" value="<?php echo $row['cart']; ?>" class="form-control form-control-sm shadow-none" style="width: 100px;"></td>
                            <input type="hidden" name="c_s[]" form="shopping_form" id="c_s" value="<?php echo $sol; ?>" class="form-control">
                            <input type="hidden" name="c_id[]" form="shopping_form" id="c_id" value="<?php echo $row['cart_id']; ?>" class="form-control">
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <form id="checkout_form" action="checkout_function.php" method="post">
        <div class="row">
            <div class="col-md-12 text-center mt-3">
                <button type="submit" name="checkout" id="checkout" class="btn btn-primary shadow-none btn-block button">CHECKOUT</button>
            </div>
        </div>
    </form>
</div>

<script>
    function DEL(cart_id){
        var proceeds = confirm("This action will delete order. Are you sure?");
        if (proceeds) {
            $.ajax({
                url: "delete_function.php",
                type: "POST",
                cache: false,
                data:{
                    id: cart_id,
                },
                success:function(data){   
                    window.location.href = "shopping_cart.php";
                }  
            });
        }
    }
    function UP(){
        $('#shopping_form').on("submit", function(event){ 
            $.ajax({  
                url:"update_quantity.php",  
                method:"POST",  
                data:$('#shopping_form').serialize(),  
                success:function(data){  

                }  
            });     
        });
    }
    function CHECK(){
        $('#checkout_form').on("submit", function(event){ 
            $.ajax({  
                url:"checkout_function.php",  
                method:"POST",  
                data:$('#checkout_form').serialize(),  
                success:function(data){ 

                }  
            });     
        });
    }
</script>
<?php 
    include_once("../message/message_box.php");
    include_once("../layouts/footer.php");
?>