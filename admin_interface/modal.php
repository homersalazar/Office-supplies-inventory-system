<!--Modal Size-->
<div class="modal fade" id="MySize" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Size</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="size_form" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-2">
                            <label class="fs-5">Size:</label>
                        </div>
                        <div class="col-10">
                            <input type="text" name="sizes" id="sizes" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-primary btn-sm button1 shadow-none">SAVE</button>
                    <button type="button" class="btn btn-secondary btn-sm button1" data-bs-dismiss="modal">CLOSE</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Modal Color-->
<div class="modal fade" id="MyColor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Color</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="color_form" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-2">
                            <label class="fs-5">Color:</label>
                        </div>
                        <div class="col-10">
                            <input type="text" name="colors" id="colors" class="form-control" required>
                        </div>
                    </div>                
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-primary btn-sm button1 shadow-none">SAVE</button>
                    <button type="button" class="btn btn-secondary btn-sm button1" data-bs-dismiss="modal">CLOSE</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Modal Unit-->
<div class="modal fade" id="MyUnit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Unit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="unit_form" method="post">
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-2">
                                <label class="fs-5">Unit:</label>
                            </div>
                            <div class="col-10">
                                <input type="text" name="units" id="units" class="form-control">
                            </div>
                        </div>                
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-primary btn-sm button1 shadow-none">SAVE</button>
                    <button type="button" class="btn btn-secondary btn-sm button1" data-bs-dismiss="modal">CLOSE</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Modal Department-->
<div class="modal fade" id="MyDept" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="department_form" method="post">
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-3">
                                <label class="fs-6">Department:</label>
                            </div>
                            <div class="col-8">
                                <input type="text" name="depart" id="depart" class="form-control">
                            </div>
                        </div>                
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-primary btn-sm button1 shadow-none">SAVE</button>
                    <button type="button" class="btn btn-secondary btn-sm button1" data-bs-dismiss="modal">CLOSE</button>
                </div>
            </form>
        </div>
    </div>
</div>
