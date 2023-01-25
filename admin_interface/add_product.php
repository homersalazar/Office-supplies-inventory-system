<?php 
    include_once("../partials/session.php");
    include("../layouts/header.php");
    include_once("../partials/connection.php");
    include_once("../partials/navbar.php");
    include_once("../message/message_box.php");
    include_once("../partials/productbar.php");
    require("../admin_interface/modal.php");

?>
<div class="product-container">
    <form id="add_form" method = "POST"> 
        <div class="container mt-2">
            <div class="row justify-content-md-center">
                <div class="row text-center">
                    <div class="col-2"></div>
                    <div class="col-lg-8">
                        <div class="mt-4">
                            <p class="fw-bold">Add Product</p>
                        </div>
                    </div>
                </div>
                <div class="col col-lg-4 ms-5 mt-1">
                    <div>
                        <div class="row">
                            <div class="col-4">
                                <label for="">Product Name *</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <input type="text" name="product_name" id="product_name" class="form-control" autofocus required>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="row">
                            <div class="col-5 mt-3">
                                <label for="">Product Attributes *</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <input type="text" name="attr" id="attr" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="row">
                            <div class="col-4 mt-3">
                                <label for="">Product Size</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-11">
                                <select class="form-select" aria-label="Default select example" name="size_id" id="size_id">
                                    <option selected disabled>Open this select size</option>
                                    <?php $sql1 ="SELECT * FROM size_tbl";
                                    $result1 = mysqli_query($conn, $sql1); 
                                    while($row1 = mysqli_fetch_array($result1)){ ?>
                                    <option value="<?php echo $row1['size_id']; ?>"><?php echo ucwords($row1['sizes']); ?></option>
                                    <?php } ?>
                                </select>                    
                            </div>
                            <div class="col-1 ps-0 ms-0 mt-1">
                                <button type="button" class="btn btn-outline-success btn-sm buttons fa fa-plus" onclick="MySize()"></button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 mt-3">
                            <label for="">Product Color</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-11">
                            <select class="form-select" aria-label="Default select example" name="color_id" id="color_id">
                                <option selected disabled>Open this select color</option>
                                <?php $sql2 ="SELECT * FROM color_tbl";
                                $result2 = mysqli_query($conn, $sql2); 
                                while($row2 = mysqli_fetch_array($result2)){ ?>
                                <option value="<?php echo $row2['color_id']; ?>"><?php echo ucwords($row2['colors']); ?></option>
                                <?php } ?>
                            </select>                      
                        </div>
                        <div class="col-1 ps-0 ms-0 mt-1">
                                <button type="button" class="btn btn-outline-success btn-sm buttons fa fa-plus" onclick="MyColor()"></button>
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-4 mt-3">
                            <label for="">Unit</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-11">
                            <select class="form-select" aria-label="Default select example" name="unit_id" id="unit_id">
                                <option selected disabled>Open this select unit</option>
                                <?php $sql3 ="SELECT * FROM unit_tbl";
                                    $result3 = mysqli_query($conn, $sql3); 
                                    while($row3 = mysqli_fetch_array($result3)){ ?>
                                <option value="<?php echo $row3['unit_id']; ?>"><?php echo ucwords($row3['units']); ?></option>
                                <?php } ?>
                            </select>                       
                        </div>
                        <div class="col-1 ps-0 ms-0 mt-1">
                            <button type="button" class="btn btn-outline-success btn-sm buttons fa fa-plus" onclick="MyUnit()"></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 mt-3">
                            <button type="submit" name="submit" class="btn btn-primary btn-block button1 shadow-none mt-2">SUBMIT</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    function MySize(){
        $('#MySize').modal('show');
        $('#sizes').on('shown.bs.modal', function () {
            $('#sizes').focus();
        })
        $('#size_form').on("submit", function(event){ 
            $.ajax({  
                url:"size_function.php",  
                method:"POST",  
                data:$('#size_form').serialize(),  
                success:function(data){  
                    $('#size_form')[0].reset();  
                    $('#sizes').modal('hide');   
                }  
            });                  
        });
    }

    function MyColor(){
        $('#MyColor').modal('show');
        $('#colors').on('shown.bs.modal', function () {
            $('#colors').focus();
        })
        $('#color_form').on("submit", function(event){ 
            $.ajax({  
                url:"color_function.php",  
                method:"POST",  
                data:$('#color_form').serialize(),  
                success:function(data){  
                    $('#color_form')[0].reset();  
                    $('#colors').modal('hide');   
                }  
            });                  
        });
    }

    function MyUnit(){
        $('#MyUnit').modal('show');
        $('#units').on('shown.bs.modal', function () {
            $('#unit').focus();
        })
        $('#unit_form').on("submit", function(event){ 
            $.ajax({  
                url:"unit_function.php",  
                method:"POST",  
                data:$('#unit_form').serialize(),  
                success:function(data){  
                    $('#unit_form')[0].reset();  
                    $('#units').modal('hide');   
                }  
            });                  
        });
    }
    $(document).ready(function() {
        $('#add_form').submit(function(e) {
            $.ajax({
                type: "POST",
                url: 'product_function.php',
                data:$('#add_form').serialize(),  
                success: function(data){

                }
            });
        });
    });
</script>
<?php 
    require_once("../layouts/footer.php");
?>
