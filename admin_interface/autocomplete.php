<?php 
require_once("../partials/connection.php");
    if(isset($_POST["query"])){  
        $output = '';  
        $query = "SELECT  
        product_record.prod_id AS prod_id,
        product_record.item_name AS item_name,
        color_tbl.colors AS color,
        size_tbl.sizes AS size
        FROM product_record 
        LEFT JOIN color_tbl
        ON product_record.color = color_tbl.color_id
        LEFT JOIN size_tbl
        ON product_record.size = size_tbl.size_id
        WHERE item_name  LIKE '%".$_POST["query"]."%'
        OR color LIKE '%".$_POST["query"]."%'
        OR size LIKE '%".$_POST["query"]."%'";
        $result = mysqli_query($conn, $query);  
        $output = '<ul class="list-unstyled">';  
        if(mysqli_num_rows($result) > 0){  
            while($row = mysqli_fetch_array($result)){  

                $item_name = $row['item_name'];
                $size = !empty($row["size"])  ? "- ".$row["size"] : "" ;
                $color = !empty($row["color"])  ? "- ".$row["color"] : "" ;

                $prod_id = "'".$row['prod_id']."'";
                $item_names = "'".$row['item_name']."'";
                $colors = "'".$row['color']."'";
                $sizes = "'".$row['size']."'";

                $output .= '<li class="li-output" onclick="addItem('.$prod_id.' , '.$item_names.' , '.$colors.' , '.$sizes.');">'.ucwords($item_name).' '.ucwords($color).' '.ucwords($size).'</li>';  
            }  
        }else{  
              $output .= '<li class="li-output">Product Not Found</li>';  
            }  
        $output .= '</ul>';  
        echo $output;  
    }  
?>
