<?php
    require_once("../partials/session.php");
    require_once("../partials/connection.php");
?>
<div class="topbar">
    <div class="sticky-top">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <div class="logo-container">
                    <div class="navbar-brand"><img src="../assets/home-logo.png" alt="ghecc logo" width="50" height="50"> <a href="../user_interface/my_orders.php"> Global Heavy Equipment And Construction Corp.</a></div>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class=" justify-content-end">
                    <div class="collapse navbar-collapse" id="navbarText">
                    <?php if($_SESSION['UserType'] == "0"){ ?> <!-- 0 = admin , 1 = user  -->
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="../dashboard/index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../admin_interface/add_product.php">Products</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Contacts</a>
                            </li>
                            <li class="nav-item">
                                <span></span>                    
                            </li>
                            <?php 
                                $sql1 ="SELECT COUNT(cart_id) AS cart FROM transaction_record";
                                $result1 = mysqli_query($conn, $sql1);
                                $row1 = mysqli_fetch_assoc($result1);
                            ?>
                            <li class="nav-item">
                                <a href="../admin_interface/shopping_cart.php" class="btn position-relative shadow-none p-0">
                                    <img src="../assets/home-cart.png" alt="shopping cart" width="30" height="30">
                                    <span class="position-absolute mt-1 pe-3 start-100 translate-middle rounded-pill badge bg-danger" style="height: 20px;"><?php echo $row1['cart']; ?></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="user_details.php"><img src="../assets/home-user.png" alt="home user" width="30" height="30"></a>
                            </li>
                        </ul>
                        <?php }else{ ?>

                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Products</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Contacts</a>
                            </li>
                            <li class="nav-item">
                                <span></span>                    
                            </li>
                            <?php 
                                $sql ="SELECT COUNT(cart_id) AS cart FROM transaction_record WHERE added_by = '".$_SESSION['ID']."' AND stat = '0'";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result);
                            ?>
                            <li class="nav-item">
                                <a href="../user_interface/shopping_cart.php" class="btn position-relative shadow-none p-0">
                                    <img src="../assets/home-cart.png" alt="shopping cart" width="30" height="30">
                                    <span class="position-absolute mt-1 pe-3 start-100 translate-middle rounded-pill badge bg-danger" style="height: 20px;"><?php echo $row['cart']; ?></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="../user/login.php"><img src="../assets/home-user.png" alt="home user" width="30" height="30"></a>
                            </li>
                        </ul>
                       <?php } ?>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>

