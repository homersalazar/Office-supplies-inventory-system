<?php 
    $page = "Change Password";
    $topbar = "CHANGE PASSWORD";
    include_once("../partials/session.php");
    include("../layouts/header.php");
    include_once("../partials/connection.php");
    include_once("../partials/navbar.php");
    include_once("../partials/breadcrumb.php");
    include_once("../partials/topbar.php");

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $user_id = $_SESSION['ID'];
        $old_password = md5(mysqli_real_escape_string($conn, $_POST['old_password']));
        $confirm_password = md5(mysqli_real_escape_string($conn, $_POST['confirm_password']));
        $new_password = md5(mysqli_real_escape_string($conn, $_POST['new_password']));
        $retype_password = md5(mysqli_real_escape_string($conn, $_POST['retype_password']));

        if($new_password == $retype_password){
            if($new_password != $old_password) {

                $sql = "SELECT * FROM `user_record` WHERE `user_id` = '$user_id' AND `pass_word` = '$old_password'";
                $result = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($result);

                if($count == 1){
                    $sql = "UPDATE `user_record` SET `pass_word` = '$new_password' WHERE `user_id` = '$user_id'";
                    $result = mysqli_query($conn, $sql);
                    $old_password=''; $password =''; $confirm_pwd = '';
                    $_SESSION['success_message'] = "Your new password update successfully.";
                }else{
                    $_SESSION['danger_message'] = "The password you gave is incorrect.";
                }
            }else{
                $_SESSION['warning_message'] = "Old password new password same Please try again.";
            }
        }else{
            $_SESSION['info_message'] = "New password and confirm password do not matched";
        }
    }
?>
<div class="change-password-container">
    <div class="row mt-5">
        <div class="col-12 mt-3 text-center">
            <h3 class="fw-bold">Change Password</h3>
            <p>To change your password, please use the form below. In the interest of security please make sure to specify a strong password.</p>
            <p>Required fields are marked with (*).</p>
        </div>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <hr>
        </div>
    </div>
    <div class="container">    
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="row mt-2 ms-5">
                <div class="col-1 ms-5"></div>
                <div class="col-md-4"> 
                    <label for="">Current Password *</label>
                </div>
                <div class="col-md-4">
                    <label for="">Confirm Current Password *</label>
                </div>
            </div>
            <div class="row mt-2 ms-5">
                <div class="col-1 ms-5"></div>
                <div class="col-md-4">
                    <input type="password" name="old_password" id="old_password" class="form-control" autocomplete="off">
                </div>
                <div class="col-md-4">
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" autocomplete="off">
                </div>
            </div>
            <div class="row mt-4 ms-5">
                <div class="col-1 ms-5"></div>
                <div class="col-md-4">
                    <label for="">New Password *</label>
                </div>
                <div class="col-md-4">
                    <label for="">Confirm New Password *</label>
                </div>
            </div>
            <div class="row mt-2 ms-5">
                <div class="col-1 ms-5"></div>
                <div class="col-md-4">
                    <input type="password" name="new_password" id="new_password" class="form-control" autocomplete="off">
                </div>
                <div class="col-md-4">
                    <input type="password" name="retype_password" id="retype_password" class="form-control" autocomplete="off">
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-5"></div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-block button">CHANGE PASSWORD</button>
                </div>
            </div>
        </form>
    </div>
<?php 
    include_once("../message/message_box.php");
    include("../layouts/footer.php");
?>
