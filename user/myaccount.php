<?php 
    include_once("../partials/session.php");
    $page = "My account";
    $topbar = "MY ACCOUNT";
    include("../layouts/header.php");
    include_once("../partials/navbar.php");
    include_once("../partials/breadcrumb.php");
    include_once("../partials/topbar.php");
?>
<div class="account-container">
    <div class="row">
        <div class="col-md-12 text-center mt-5">
            <p>Welcome, <?php echo ucwords($_SESSION['UserName']); ?>!</p>
            <p class=" fw-bold">Orders</p>
        </div>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <table class="table center">
                <thead>
                    <tr>
                    <th scope="col">Product #</th>
                    <th scope="col">Product</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">1</th>
                    <td><a href="../user_interface/my_orders.php">bond paper</a></td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    </tr>
                    <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                    </tr>
                    <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                    </tr>
                </tbody>
            </table>
         </div>
    </div>
</div>

<?php 
    include_once("../message/message_box.php");
    include_once("../layouts/footer.php");
?>