<?php 
    include_once("../partials/session.php");
    include("../layouts/header.php");
    include_once("../partials/connection.php");
    include_once("../partials/navbar.php");
    include_once("../message/message_box.php");
    include_once("../partials/productbar.php");
    require("../admin_interface/modal.php");
    $id = $_GET['id'];
    $query = "SELECT prod_id , item_name , attr , colors , units , sizes , size_id , color_id , unit_id , img_name
    FROM product_record
    LEFT JOIN color_tbl 
    ON product_record.color = color_tbl.color_id
    LEFT JOIN size_tbl 
    ON product_record.size = size_tbl.size_id
    LEFT JOIN unit_tbl 
    ON product_record.unit = unit_tbl.unit_id
    WHERE prod_id = '$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    $img = $row['img_name'];

?>
<div class="product-container">
    <form action="update_function.php?id=<?php echo $row['prod_id'];  ?>" method = "POST" enctype = "multipart/form-data"> 
        <div class="container mt-2">
            <div class="row justify-content-md-center">
                <div class="col-lg-4 text-center">
                    <div class="card mt-5">
                        <?php if($img == ""){   ?>
                            <p class="pt-3"><img src="../product/not-available.png" id="output" width="300" height="400"/></p> 
                            <input type="file" name="file" value="<?php echo $row['img_name']; ?>" id="file" class="form-control" accept="image/*" onchange="loadFile(event)">
                        <?php }else{ ?>
                            <p class="pt-3"><img src="../product/<?php echo $row['img_name']; ?>" id="output" width="300" height="400"/></p> 
                            <input type="file" name="file" id="file" value="<?php echo $row['img_name']; ?>" class="form-control" accept="image/*" onchange="loadFile(event)">
                        <?php } ?>
                    </div>
                </div>
                <div class="col col-lg-4 ms-5 mt-5">
                    <div>
                        <div class="row">
                            <div class="col-4">
                                <label for="">Product Name</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <input type="text" name="product_name" id="product_name" value="<?php echo ucwords($row['item_name']); ?>" class="form-control" required autofocus>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="row">
                            <div class="col-4 mt-3">
                                <label for="">Product Attributes</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <input type="text" name="attr" id="attr" class="form-control" value="<?php echo ucwords($row['attr']); ?>" required>
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
                            <div class="col-12">
                                <select class="form-select" aria-label="Default select example" name="size_id" id="size_id">
                                    <?php $sql1 ="SELECT * FROM size_tbl";
                                    $result1 = mysqli_query($conn, $sql1); 
                                    while($row1 = mysqli_fetch_array($result1)){ ?>
                                    <option <?php if($row['size_id'] == $row1['size_id']) echo "selected"; ?> value="<?php echo $row1['size_id']; ?>"><?php echo ucwords($row1['sizes']); ?></option>
                                    <?php } ?>
                                </select>                    
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 mt-3">
                            <label for="">Product Color</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <select class="form-select" aria-label="Default select example" name="color_id" id="color_id">
                                <?php $sql2 ="SELECT * FROM color_tbl";
                                $result2 = mysqli_query($conn, $sql2); 
                                while($row2 = mysqli_fetch_array($result2)){ ?>
                                <option <?php if($row['color_id'] == $row2['color_id']) echo "selected"; ?> value="<?php echo $row2['color_id']; ?>"><?php echo ucwords($row2['colors']); ?></option>
                                <?php } ?>
                            </select>                      
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 mt-3">
                            <label for="">Unit</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <select class="form-select" aria-label="Default select example" name="unit_id" id="unit_id">
                                <?php $sql3 ="SELECT * FROM unit_tbl ";
                                    $result3 = mysqli_query($conn, $sql3); 
                                    while($row3 = mysqli_fetch_array($result3)){ ?>
                                <option <?php if($row['unit_id'] == $row3['unit_id']) echo "selected"; ?> value="<?php echo $row3['unit_id']; ?>"><?php echo ucwords($row3['units']); ?></option>
                                <?php } ?>
                            </select>                       
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 mt-4">
                            <button type="submit" name="submit" class="btn btn-primary btn-block button1 shadow-none">SUBMIT</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    const loadFile = function(event) {
        const image = document.getElementById('output');
        image.src=URL.createObjectURL(event.target.files[0]);
    };
</script>
<?php 
    require_once("../layouts/footer.php");
?>
