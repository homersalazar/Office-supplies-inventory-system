<?php 
    include_once("../partials/session.php");
    $page = "My orders";
    $topbar = "MY ORDERS";
    include("../layouts/header.php");
    include_once("../partials/navbar.php");
    require_once("../user_interface/my_modal.php");
    include_once("../partials/connection.php");
    include_once("../partials/breadcrumb.php");
    include_once("../partials/topbar.php");

    $sql = "SELECT item_name , colors , sizes , prod_id , units , img_name , qty , attr , 
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
    ORDER BY item_name ASC";
    $result = mysqli_query($conn, $sql);  

?>
<div class="account-container">
    <div class="row">
        <div class="col-md-12 text-center mt-4">
            <p>Welcome, <?php echo ucwords($_SESSION['UserName']); ?>!</p>
            <p class=" fw-bold">Orders</p>
        </div>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
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
                        $colors = $row["colors"];
                        $sizes = $row["sizes"];
                        $res = "";
                        if($sizes != "" && $colors != ""){
                            $res = ucwords($sizes) .' - '. ucwords($colors);
                        }elseif($sizes !=""){
                            $res = ucwords($sizes); 
                        }else if($colors != ""){
                            $res = ucwords($colors);
                        }

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
                            <td>
                                <a href="#" onclick="MyOrders('<?php echo $row['prod_id'] ?>' , '<?php echo $row['item_name'] ?>' , '<?php echo $res ?>' , '<?php echo $sol ?>' , '<?php echo $row['attr'] ?>' , '<?php echo $row['sizes'] ?>' , '<?php echo $row['colors'] ?>' , '<?php echo $row['units'] ?>' , '<?php echo $row['img_name'] ?>' , '<?php echo $row['prod_id'] ?>')"> <?php echo ucwords($row['item_name']); ?> <?php echo ucwords($row['sizes']); ?></a> <br> 
                                Product #: 00<?php echo $row['prod_id']; ?> <?php echo $color; ?>
                            </td>
                            <td class="pt-4"><?php echo $sol; ?> <?php echo ucwords($row['units']); ?></td>
                            <td <?php echo $hue; ?>><?php echo $status; ?></td>
                        </tr>
                    <?php  }   ?>  
                </tbody>
            </table>
         </div>
    </div>
</div>

<script>
    //displaying data
    function MyOrders(prod_id , prod_name , res , qty , attr , sizes , colors , units , image , pro_id){
        $('#MyOrders').modal('show');
        document.querySelector("#product_name").innerHTML = prod_name;
        document.querySelector("#res").innerHTML = res;
        document.querySelector("#prod_id").innerHTML = prod_id;
        document.querySelector("#qty").innerHTML = qty;
        document.querySelector("#attr").innerHTML = attr;
        document.querySelector("#sizes").innerHTML = sizes;
        document.querySelector("#colors").innerHTML = colors;
        document.querySelector("#units").innerHTML = units;
        document.querySelector("#pro_id").value = pro_id;
        const img = document.querySelector("#image"); 
        img.src = "../product/"+image;
        img.width = 300;
        img.height = 400;
        const zero = document.querySelector("#qty").innerHTML;
        if(zero == 0){
            document.getElementById("myBtn").disabled = true;
        }else{
            document.getElementById("myBtn").disabled = false;
        }
    }   

    // Plus & Minus Button
	$(document).ready(function() {
        // plus & minus button
        $('#minus').click(function () {
            var $input = $(this).parent().find('input');
            var count = parseInt($input.val()) - 1;
            count = count < 1 ? 1 : count;
            $input.val(count);
            $input.change();
            return false;
        });
        $('#plus').click(function () {
            var zero = document.querySelector("#qty").innerHTML;
            var $input = $(this).parent().find('input');
            var count = parseInt($input.val()) + 1;
            count = count > zero ? zero : count;
            $input.val(count);
            $input.change();
            return false;
        });

        // Datatable
        $('#product_table').DataTable({
            "bLengthChange": false,
            "bInfo": false,
        });


        $('#Add_to_cart').on("submit", function(event){ 
            $.ajax({  
                url:"cart_function.php",  
                method:"POST",  
                data:$('#Add_to_cart').serialize(),  
                success:function(data){  

                }  
            });                  
        });
    });
</script>
<?php 
    include_once("../message/message_box.php");
    include_once("../layouts/footer.php");
?>