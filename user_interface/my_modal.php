<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
</style>
<!-- The Modal -->
<div class="modal fade" id="MyOrders"  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="staticBackdropLabel">PRODUCT DETAILS</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="Add_to_cart" method="POST">
                <div class="modal-body">
                    <div class="product-container">
                        <div class="container">
                            <div class="row justify-content-md-center">
                                <div class="col col-lg-4 text-center">
                                    <div class="card mt-2">
                                        <!-- <img src="../product/1.png" class="card-img-top" alt="bond paper a4"> -->
                                        <img id="image" />                            
                                    </div>
                                </div>
                                <div class="col col-lg-5 ms-5 mt-2">
                                    <div class="row">
                                        <div class="col-5">
                                            <h4 class=fw-bold><span id="product_name" style="text-transform:capitalize;"></span></h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <h4 class=fw-bold><span id="res"></span></span></h4>                    
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <p>Product #: 00<span id="prod_id"></span></p>
                                        </div>
                                        <div class="col-6">
                                            <p>Current stock: <span id="qty"></span></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mt-5">
                                        <div class="col-4">
                                            <label class="fw-bold fs-6">ORDER NOW</label>
                                        </div>
                                    </div>
                                    <!-- <form action="" method="post"> -->
                                        <div class="row mb-5 mt-3">
                                            <div class="col-md-5">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button type="button" id="minus" class="btn btn-primary btn-sm fa fa-minus buttons"></button>
                                                    <input type="text" name="input" value="1" id="input" class="form-control form-control-sm text-center shadow-none bg-light" style="background-color: white !important;" readonly>
                                                    <button type="button"  id="plus" class="btn btn-primary btn-sm fa fa-plus buttons"> </button>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <button type="submit" id="myBtn"  class="btn btn-primary btn-sm button1 shadow-none">ADD TO CART</button>
                                            </div>
                                        </div>
                                    <!-- </form> -->
                                    <hr> 
                                    <div class="row">
                                        <div class="col-12">
                                            <ul style="list-style-type:unset">
                                                <li>Attr:  <span id="attr" style="text-transform:capitalize;"></li>
                                                <li>Size: <span id="sizes" style="text-transform:capitalize;"></span></li>
                                                <li>Color:  <span id="colors" style="text-transform:capitalize;"></li>
                                                <li>Unit:  <span id="units" style="text-transform:capitalize;"></li>
                                                <input type="hidden" name="pro_id" id="pro_id">
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger button1 shadow-none" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
