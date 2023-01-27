<?php 
    include_once("../partials/session.php");
    include("../layouts/header.php");
    include_once("../partials/connection.php");
    include_once("../partials/navbar.php");
    include_once("../message/message_box.php");
    include_once("../partials/productbar.php");
    $id = $_GET['id'];
    $sql = "SELECT * , date_format(quantity_record.added_at,'%m-%d-%Y') AS dates, fname , quantity_record.stats AS actions
    FROM quantity_record 
    LEFT JOIN product_record
    ON product_record.prod_id = quantity_record.product_id
    LEFT JOIN color_tbl  
    ON product_record.color = color_tbl.color_id
    LEFT JOIN size_tbl  
    ON product_record.size = size_tbl.size_id
    LEFT JOIN unit_tbl  
    ON product_record.unit = unit_tbl.unit_id
    LEFT JOIN user_record  
    ON user_record.user_id = quantity_record.added_by
    WHERE product_id = '$id'
    -- GROUP BY 
    ORDER BY dates ASC
    ";
    $result = mysqli_query($conn , $sql);
?>
<div class="history-container">
    <div class="row text-center">
        <div class="col-2"></div>
        <div class="col-lg-8">
            <div class="mt-4">
                <p class="fw-bold">Quantity History</p>
            </div>
        </div>
    </div>
    <form id="edit_form" method="POST">
        <div class="row">
            <div class="col-md-12 text-center mt-3">
                <button type="submit" name="update" id="update" class="btn btn-primary btn-sm btn-block shadow-none button" onclick="UPDATE()">UPDATE</button>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <table id="hq_table" class="table">
                <thead>
                    <tr>
                        <th scope="col">Action</th>
                        <th scope="col">Product</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Status</th>
                        <th scope="col">User</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  while($row = mysqli_fetch_array($result)){ 
                        $color = !empty($row["colors"])  ? "| Color: ".ucwords($row["colors"]) : "" ;
                        $stat = "";
                        $status = $row['actions'];
                        if($status == 0){
                            $stat = "Stock - In";
                        }else{
                            $stat = "Stock - Out";
                        }
                        ?>
                        <tr>
                            <td class="pt-3"><button type="button" class="btn shadow-none text-danger fa fa-trash" onclick="DELETE('<?php echo $row['qty_id']; ?>' , '<?php echo $row['product_id']; ?>')"> </button></td>
                            <td>
                                <?php echo ucwords($row['item_name']); ?> <?php echo ucwords($row['sizes']); ?></a> <br> 
                                Product #: 00<?php echo $row['prod_id']; ?> <?php echo $color; ?>
                            </td>
                            <!-- <td class="pt-4"><?php echo $row['qty']; ?> <?php echo ucwords($row['units']); ?></td> -->
                            <td class="pt-3"><input type="text" id="qty" name="qty[]" form="edit_form" value="<?php echo $row['qty']; ?>" class="form-control form-control-sm shadow-none" style="width: 100px;"></td>
                            <input type="hidden" name="qty_id[]" form="edit_form" id="qty_id" value="<?php echo $row['qty_id']; ?>" class="form-control">
                            <td class="pt-4"><?php echo $stat; ?></td>
                            <td class="pt-4"><?php echo ucwords($row['fname']); ?></td>                        
                            <td class="pt-4"><?php echo $row['dates']; ?></td>                        
                        </tr>
                    <?php  }   ?>  

                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    function DELETE(qty_id , product_id){
        var proceeds = confirm("This action will delete quantity. Are you sure?");
        if (proceeds) {
            $.ajax({
                url: "delete_function.php",
                type: "POST",
                cache: false,
                data:{
                    id: qty_id,
                },
                success:function(data){   
                    window.location.href = "quantity_history.php?id="+product_id;
                }  
            });
        }
    }
    function UPDATE(){
        $('#edit_form').on("submit", function(event){ 
            $.ajax({  
                url:"update_quantity.php",  
                method:"POST",  
                data:$('#edit_form').serialize(),  
                success:function(data){  

                }  
            });     
        });
    }
    $(document).ready( function () {
        $('#hq_table').DataTable();
    } );
</script>
<?php 
    require_once("../layouts/footer.php");
?>
