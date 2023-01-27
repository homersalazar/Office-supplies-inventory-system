<?php
    require_once("../partials/session.php");
    require_once("../partials/connection.php");
    if(!empty($_POST)){
        $fname = strtolower($_POST['fname']);
        $mname = strtolower($_POST['mname']);
        $lname = strtolower($_POST['lname']);
        $depart = $_POST['depart'];
        $email = $_POST['email_add'];
        $confirm_email = $_POST['confirm_email'];
        $user_id = $_POST['user_id'];

        if($email == $confirm_email) {
                $query = "SELECT * FROM `user_record` WHERE `email_add` = '$email'";
                $outcome = mysqli_query($conn, $query);
                $count = mysqli_num_rows($outcome);

                if($count == 1){
                    $sql = "UPDATE `user_record` 
                    SET 
                    `fname` = '$fname' , 
                    `mname` = '$mname' , 
                    `lname` = '$lname' , 
                    `email_add` = '$email' ,
                    `depart` = '$depart' 
                    WHERE `user_id` = '$user_id'";
                    $result = mysqli_query($conn, $sql);
                    $_SESSION['success_message'] = "Credentials update successfully.";
                }
        }else{
            $_SESSION['info_message'] = "New email and confirm email do not matched";
        }
    }
?>