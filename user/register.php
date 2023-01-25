<?php 
    $page = "Register";
    include_once("../partials/session.php");
    include_once("../partials/connection.php");
    include("../layouts/header.php");
    include_once("../partials/login_navbar.php");
    include_once("../partials/breadcrumb.php");

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $access = "1"; //0 = admin, 1 = users, 2 = viewing only
        $stats = "0"; // 0 = active, 1 = deactivated
        $fname = strtolower($_POST["fname"]);
        $lname = strtolower($_POST["lname"]);
        $mname = strtolower($_POST["mname"]);
        $depart = $_POST["depart"];
        $email = mysqli_real_escape_string($conn, $_POST["email_add"]);
        $confirm_email = mysqli_real_escape_string($conn, $_POST["confirm_email"]);
        $password = mysqli_real_escape_string($conn, $_POST["password"]);
        $confirm_password = mysqli_real_escape_string($conn, $_POST["confirm_password"]);

        $sql = "SELECT * FROM user_record WHERE email_add = '$email'  LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);     

        if ($row) { // if user exists
            if ($row['email_add'] === $email) {
                $_SESSION['danger_message'] = "Email already exists.";
            }
            }else if($email != $confirm_email && $password != $confirm_password){
                $_SESSION['warning_message'] = "Email or Password not match!";
        }else{
            $sql = "INSERT INTO user_record (fname , lname , mname,  depart , email_add ,  pass_word , user_type , stats) 
            VALUES ('$fname' , '$lname' , '$mname' , '$depart' , '$email' , '" . md5($password) . "', '$access' , '$stats')";
            $result = mysqli_query($conn, $sql);

            if($result) {
                $_SESSION['success_message'] = "You are registered successfully.";
            }else {
                $_SESSION['fail_message'] = "Password update failed.";

            }
        }
    }
?>
<div class="register-container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>Register</h2>
            <p>Register for an account at the Global Heavy Equipment and Construction Corp online store below.</p>
        </div>
    </div>
    <div class="container">    
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="row mt-2">
                <div class="col-md-4">
                    <label for="">First Name</label>
                </div>
                <div class="col-md-4">
                    <label for="">Middle Initial *</label>
                </div>
                <div class="col-md-4">
                    <label for="">Last Name *</label>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-4">
                    <input type="text" name="fname" id="fname" class="form-control" autocomplete="off" autofocus required>
                </div>
                <div class="col-md-4">
                    <input type="text" name="mname" id="mname" maxlength="2" class="form-control" autocomplete="off" required>
                </div>
                <div class="col-md-4">
                    <input type="text" name="lname" id="" class="form-control" autocomplete="off" required>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-4">
                    <label for="">Department *</label>
                </div>
                <div class="col-md-4">
                    <label for="">Email Address *</label>
                </div>
                <div class="col-md-4">
                    <label for="">Confirm Email Address *</label>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-4">
                    <select class="form-select" aria-label="Default select example" name="depart" id="depart" required>
                        <option selected>Open this select department</option>
                        <?php $query ="SELECT * FROM department_tbl";
                        $result = mysqli_query($conn, $query); 
                        while($row = mysqli_fetch_array($result)){ ?>
                        <option value="<?php echo $row['dept_id']; ?>"><?php echo ucwords($row['department']); ?> Department</option>
                        <?php } ?>
                    </select> 
                </div>
                <div class="col-md-4">
                    <input type="email" name="email_add" id="email_add" class="form-control" autocomplete="off" required>
                </div>
                <div class="col-md-4">
                    <input type="email" name="confirm_email" id="confirm_email" class="form-control" autocomplete="off" required>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <label for="">Password *</label>
                </div>
                <div class="col-md-4">
                    <label for="">Confirm Password *</label>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <input type="password" name="password" id="password" class="form-control" autocomplete="off" required>
                </div>
                <div class="col-md-6">
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" autocomplete="off" required>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-2">
                    <button type="submit" name="submit" id="submit" class="btn btn-primary btn-block button shadow-none">REGISTER</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php 
    include_once("../message/message_box.php");
    include_once("../layouts/footer.php");
?>