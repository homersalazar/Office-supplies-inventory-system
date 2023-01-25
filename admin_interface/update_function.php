 <?php 
    include_once('../partials/session.php');
    include_once('../partials/connection.php');

    $id = $_GET['id'];
    if(isset($_POST['submit'])){

        $target_file =  $_FILES['file']['name'];
        $tmp           = explode('.', $target_file);
        $extension = end($tmp);

        $product = strtolower($_POST['product_name']);
        $attr = $_POST['attr'];
        $size = $_POST['size_id'];
        $color = $_POST['color_id'];
        $unit = $_POST['unit_id'];

        $sql = "UPDATE  product_record 
        SET item_name = '$product', attr = '$attr', unit = '$unit', size = '$size', color = '$color'
        WHERE prod_id = '$id'";
        $result = mysqli_query($conn, $sql);
            $new_name = $id.'.'.$extension;
            move_uploaded_file($_FILES['file']['tmp_name'], "../product/" .$new_name);
            $query = "UPDATE  product_record SET img_name = '$new_name' WHERE prod_id = '$id'";
            $result2 = mysqli_query($conn, $query);
            $_SESSION['success_message'] = "Update  successfully !";
            header('Location: edit_product.php');
        }
    
?>