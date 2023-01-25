<?php 
    include("../layouts/header.php");
?>
<div class="main">
    <div class="home-section">
        <div class="sticky-top">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <div class="logo-container">
                        <div class="navbar-brand"><img src="../assets/home-logo.png" alt="ghecc logo" width="50" height="50"> Global Heavy Equipment And Construction Corp.</div>
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class=" justify-content-end">
                        <div class="collapse navbar-collapse" id="navbarText">
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
                                <li class="nav-item">
                                    <a href=""><img src="../assets/home-cart.png" alt="shopping cart" width="30" height="30"></a>
                                </li>
                                <li class="nav-item">
                                    <a href="../user/login.php"><img src="../assets/home-user.png" alt="home user" width="30" height="30"></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <div class="product-section">

    </div>
</div>

<?php 
    include("../layouts/footer.php");
?>