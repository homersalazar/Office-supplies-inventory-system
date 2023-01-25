<?php 
    include_once("../partials/session.php");
    include_once("../partials/connection.php");
    include("../layouts/header.php");
    include_once("../partials/login_navbar.php");

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email    = mysqli_real_escape_string($conn, $_POST["email"]);
        $password = mysqli_real_escape_string($conn, $_POST["password"]);

        $sql = "SELECT * FROM user_record WHERE stats = '0' AND email_add = '$email' AND pass_word = '" . md5($password) . "'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $user = mysqli_num_rows($result);

        if($user > 0){
            $_SESSION['UserName'] = $row['fname'];
            $_SESSION['UserEmail'] = $row['email'];
            $_SESSION['UserType'] = $row['user_type'];
            $_SESSION['ID'] = $row['user_id'];
            
            if($_SESSION['UserType'] == "1"){ // 0 = admin , 1 = user
                header("Location: ../user_interface/my_orders.php");
            }else {
                header("Location: ../admin_interface/index.php");
            }
        }else{
            $_SESSION['danger_message'] = "User not found!";
        }
    }

?>
<div class="login-container">
    <div class="row mt-5">
        <div class="col-md-12 text-center">
            <h2>My Account</h2>
            <h5>Login</h5>
            <p>Please login to access your account below.</p>
            <p>Not yet a registered customer, please <a href="register.php"> register.</a></p>
        </div>
    </div>
    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="row text-center">
                <div class="col-md-4">
                    <label for="">Email Address *</label>
                </div>
                <div class="col-md-4">
                    <label for="">Password *</label>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-4">
                    <input type="email" name="email" id="email" class="form-control" autofocus required>
                </div>
                <div class="col-md-4">
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <button type="submit" name="submit" class="btn btn-primary btn-block button1 shadow-none">LOGIN</button>
                    <!-- <a type="button" class="btn btn-primary btn-block button1 shadow-none" href="../user/myaccount.php">REGISTER</a> -->
                </div>
            </div>
        </form>
    </div>
</div>

<?php 
    include_once("../message/message_box.php");
    include("../layouts/footer.php");
?>