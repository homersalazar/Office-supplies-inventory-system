<?php 
    include_once("../partials/session.php");
    include("../layouts/header.php");
    include_once("../partials/connection.php");
    include_once("../partials/navbar.php");
    include_once("../message/message_box.php");
    include_once("../partials/productbar.php");
    require("../admin_interface/modal.php");


?>  
<div class="add_quantity-container">
    <div class="row text-center mt-3">
        <div class="col-2"></div>
        <div class="col-lg-8">
            <div class="mt-3">
                <p class="fw-bold">Add Quantity</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8 mt-2">
            <form method="POST" id="add_quantity">
                <table class="table mb-0">
                    <tr class="table-striped">
                        <th class="headers">Item Name</th>
                        <th class="headers">Color</th>
                        <th class="headers">Size</th>
                        <th class="headers">Quantity *</th>
                    </tr>
                    <tbody id="tbody"></tbody>
                </table>
                <tr>
                <td>
                    <div class="input-group pt-0" style="width: 380px;">
                        <input type="text" name="part_list[]" id="part_list" class="form-control form-control-sm shadow-none part" placeholder="Search for Item name or sku" autocomplete="off" autofocus>
                        <button  type="submit" name="addQuantity" class="btn btn-outline-secondary btn-sm part" type="button">Submit</button>
                    </div>
                </td>
                <td> 
                    <div id="itemLists" class="li-search"></div>  
                </td>
                </tr>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).mouseup(function(e){
        var container = $("#itemLists");
        if (!container.is(e.target) && container.has(e.target).length === 0){
            container.hide();
            $("#part_list").val('');
        }
    });

    $(document).ready(function(){  
        $('#part_list').keyup(function(){  
            var query = $(this).val();  
            if(query != ''){  
                $.ajax({  
                    url:"autocomplete.php",  
                    method:"POST",  
                    data:{query:query},  
                    success:function(data){  
                        $('#itemLists').fadeIn();  
                        $('#itemLists').html(data);  
                    }  
                });  
            }  
        });   

        $('#add_quantity').on("submit", function(event){ 
            $.ajax({  
                url:"add_quantity_function.php",  
                method:"POST",  
                data:$('#add_quantity').serialize(),  
                success:function(data){  
                }  
            });     
        });
    });

    var items = 0;
    function addItem(prod_id , item_name , sizes , colors) {
        items++;
        $("#part_list").val('');
        $('#itemLists').fadeOut();  
        var html = "<tr>";
            html += "<td><input type='text' class='form-control form-control-sm shadow-none dynamic-row border-0' value='"+item_name+"' name='item_name[]' readonly></td>";
            html += "<td><input type='text' class='form-control form-control-sm shadow-none dynamic-row border-0' value='"+sizes+"' name='size[]' readonly></td>";
            html += "<td><input type='text' class='form-control form-control-sm shadow-none dynamic-row border-0' value='"+colors+"' name='color[]' readonly></td>";
            html += "<td><input type='number' class='form-control form-control-sm shadow-none dynamic-row' id='quantity' name='quantity[]' required autofocus></td>";
            html += "<td><button type='button' class='btn btn-sm btn-outline-danger fa fa-times border-0' onclick='deleteRow(this);'></button></td>"
            html += "<td><input type='hidden' class='form-control form-control-sm shadow-none dynamic-row' value='"+prod_id+"'+items name='prod_id[]' readonly></td>";
            html += "</tr>";
 
        var row = document.getElementById("tbody").insertRow();
        row.innerHTML = html;

    }
 
    function deleteRow(button) {
        items--
        button.parentElement.parentElement.remove();
        // first parentElement will be td and second will be tr.
    }

</script>
<?php 
    include("../layouts/footer.php");
?>