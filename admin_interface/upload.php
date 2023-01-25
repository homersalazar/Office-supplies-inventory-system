<?php 
    if(isset($_POST['submit'])){
        $target_dir = "../product/";
        $target_file = $target_dir . basename($_FILES['file']['name']);

        $kb_size = $size / 1024;
        $format_size = number_format($kb_size, 2);
        return $format_size;

        $size = $_FILES['file']['size'];
        if($size < 4.0){

            if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
          
                $_SESSION['success_message'] =  " Added successfully !";
            }
        }
    }
    
?>
