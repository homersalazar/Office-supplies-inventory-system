<?php 
    include_once("../partials/session.php");
    $page = "User Information";
    $topbar = "USER INFORMATION";
    include("../layouts/header.php");
    include_once("../partials/connection.php");
    include_once("../partials/navbar.php");
    include_once("../message/message_box.php");
    include_once("../partials/productbar.php");
    require("../admin_interface/modal.php");
    $id = $_GET['id'];
    $query = "SELECT * , department 
    FROM user_record
    LEFT JOIN department_tbl
    ON user_record.depart = department_tbl.dept_id
    WHERE user_id = '$id'
    ";
    $result = mysqli_query($conn , $query);
    $row = mysqli_fetch_assoc($result);
?>
<div class="user_container">
    <div class="row">
        <div class="col-md-12 text-center mt-4">
            <p class=" fw-bold">Edit Users</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center mt-4">
            <button type="button" class="btn btn-primary button1 shadow-none btn-sm" onclick="MyDept()">ADD DEPARTMENT</button>
        </div>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <hr>
        </div>
    </div>
    <div class="container">    
        <form id="update_form" method="POST">
            <div class="row mt-2 ms-5">
                <div class="col-1"></div>
                <div class="col-md-3">
                    <label for="">First Name</label>
                </div>
                <div class="col-md-3">
                    <label for="">Middle Initial *</label>
                </div>
                <div class="col-md-3">
                    <label for="">Last Name *</label>
                </div>
            </div>
            <div class="row mt-2 ms-5">
                <div class="col-1"></div>
                <div class="col-md-3">
                    <input type="text" name="fname" id="fname" value="<?php echo $row['fname']; ?>" class="form-control" require autocomplete="off" autofocus>
                </div>
                <div class="col-md-3">
                    <input type="text" name="mname" id="mname" value="<?php echo $row['mname']; ?>" class="form-control" require autocomplete="off">
                </div>
                <div class="col-md-3">
                    <input type="text" name="lname" id="lname" value="<?php echo $row['lname']; ?>" class="form-control" require autocomplete="off">
                </div>
            </div>
            <div class="row mt-4 ms-5">
                <div class="col-1"></div>
                <div class="col-md-3">
                    <label for="">Department *</label>
                </div>
                <div class="col-md-3">
                    <label for="">Email Address *</label>
                </div>
                <div class="col-md-3">
                    <label for="">Confirm Email Address *</label>
                </div>
            </div>
            <div class="row mt-2 ms-5">
                <div class="col-1"></div>
                <div class="col-md-3">
                    <select class="form-select" aria-label="Default select example" name="depart" id="depart">
                        <?php $query ="SELECT * FROM department_tbl";
                        $dbresult = mysqli_query($conn, $query); 
                        while($dbrow = mysqli_fetch_array($dbresult)){ ?>
                        <option <?php if($row['dept_id'] == $dbrow['dept_id']) echo "selected"; ?> value="<?php echo $dbrow['dept_id']; ?>"><?php echo ucwords($dbrow['department']); ?> Department</option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="email" name="email_add" id="email_add" value="<?php echo $row['email_add']; ?>" class="form-control" require autocomplete="off">
                </div>
                <div class="col-md-3">
                    <input type="email" name="confirm_email" id="confirm_email" value="<?php echo $row['email_add']; ?>" class="form-control" require autocomplete="off">
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-5"></div>
                <div class="col-md-2 text-center">
                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $row['user_id']; ?>">
                    <button type="submit" id="submit" class="btn btn-primary btn-block button shadow-none">UPDATE USER</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    function MyDept(){
        $('#MyDept').modal('show');
        $('#depart').on('shown.bs.modal', function () {
            $('#depart').focus();
        })
        $('#department_form').on("submit", function(event){ 
            $.ajax({  
                url:"department_function.php",  
                method:"POST",  
                data:$('#department_form').serialize(),  
                success:function(data){  
                    $('#department_form')[0].reset();  
                    $('#depart').modal('hide');   
                }  
            });                  
        });
    }

    $(document).ready(function() {
        $('#update_form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'update_user.php',
                data: $(this).serialize(),
                success: function(response)
                {
                    var jsonData = JSON.parse(response);
                }
            });
        });
    });
</script>
<?php 
    include_once("../layouts/footer.php");
?>
