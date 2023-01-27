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
    $query = "SELECT * , department
    FROM user_record
    LEFT JOIN department_tbl
    ON user_record.depart = department_tbl.dept_id
    ";
    $result = mysqli_query($conn , $query);
?>
<div class="account-container">
    <div class="row">
        <div class="col-md-12 text-center mt-4">
            <p class=" fw-bold">Users</p>
        </div>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <table id="product_table" class="table">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">User type</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  while($row = mysqli_fetch_array($result)){ 
                        $user = $row['user_type'];
                        $hidden = "";

                        if($user == 0){
                            $type = "Admin";
                            $hidden = 'style="display: none;"';
                        }else{
                            $type = "User";
                        }
                        $stat = $row['stats'];
                        if($stat == 0){
                            $status = "Active";
                            $color = 'class ="text-success"';
                        }else{
                            $status = "Deactivated";
                            $color = 'class = "text-danger"';
                        }
                        ?>
                        <tr>
                            <td>
                                <div class="dropdown" <?php echo $hidden; ?>>
                                    <button class="btn dropdown-toggle fa fa-cog" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="edit_user.php?id=<?php echo $row['user_id']; ?>">Edit</a></li>
                                        <li><a class="dropdown-item" href="#">Change user type</a></li>
                                        <li><a class="dropdown-item" href="#">Deactivate</a></li>
                                    </ul>
                                </div>
                            </td>
                            <td><?php echo ucwords($row['fname']) ?> <?php echo ucwords($row['mname']) ?>. <?php echo ucwords($row['lname']) ?></td>
                            <td class="text-primary" style="text-decoration: underline;"><?php echo $row['email_add'] ?></td>
                            <td><?php echo $type; ?></td>
                            <td <?php echo $color; ?>><?php echo $status; ?></td>
                        </tr>
                    <?php  }   ?>  
                </tbody>
            </table>
         </div>
    </div>
</div>
<script>
</script>
<?php 
    include_once("../layouts/footer.php");
?>
