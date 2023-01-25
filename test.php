<?php 
    require_once("../layouts/header.php");
    require_once("../partials/navbar.php");
?>
<div class="product-container">
    <div class="container mt-5">
        <div class="row justify-content-md-center">
            <div class="col col-lg-4 text-center">
                <!-- <img src="../product/1.png" alt="bond paper a4" width="300" height="300"> -->
                <div class="card mt-5">
                    <img src="../product/1.png" class="card-img-top" alt="bond paper a4">
                </div>
            </div>
            <div class="col col-lg-4 ms-5 mt-5">
                <div class="row">
                    <div class="col-5">
                        <h4 class=fw-bold>BOND PAPER</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <h4 class=fw-bold>A4 - color</h4>                    
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <p>Product #:</p>
                    </div>
                    <div class="col-6">
                        <p>Current stock:</p>
                    </div>
                </div>
                <hr>
                <div class="row mt-5">
                    <div class="col-4">
                        <label class="fw-bold fs-6">ORDER NOW</label>
                    </div>
                </div>
                <form action="" method="post">
                    <div class="row mb-5 mt-3">
                        <div class="col-md-5">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-primary btn-sm fa fa-minus buttons"></button>
                                <input type="text" name="" id="" class="form-control form-control-sm text-center shadow-none">
                                <button type="button" class="btn btn-primary btn-sm fa fa-plus buttons"> </button>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <button type="submit" id="submit" class="btn btn-primary btn-sm buttons">ADD TO CART</button>
                        </div>
                    </div>
                </form>
                <hr> 
                <div class="row">
                    <div class="col-12">
                        <ul style="list-style-type:unset">
                            <li>Attr: 70 gsm, Sub-20</li>
                            <li>Size: A4</li>
                            <li>Color: White</li>
                            <li>Packaging Size: 500 pcs per ream</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
    require_once("../layouts/header.php");
?>