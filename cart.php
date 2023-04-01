<?php
session_start();
require 'connect.php';
include 'config/template.php';
error_reporting(0);
$order_total = 0;
?>
<!DOCTYPE html>
<html>

<head>
    <?php echo $head ?>
</head>

<body>
    <header>
        ABC Company
    </header>
    <!--Menu bar-->
    <aside>
        <form style="text-align: left;" action="logout_action.php" method="POST">
            <div style="text-align:center; padding: 5px;"><label for=" name">
                    <h3><b>Welcome:</b>
                </label><?php echo $_SESSION['cus_name'] ?></h3>
            </div>
            <div class="vertical-menu">
                <a href="dashboard.php">Home</a>
                <a href="cart.php" class="active">Cart (<?php echo $_SESSION['numberOfOrder'] ?>)</a>
                <a href="orders.php">Orders</a>
                <a href="profile.php">Profile</a>
                <a onclick="showConfirm()">Log Out</a>
            </div>
        </form>
    </aside>
    <!--Cart-->
    <section>
        <h2 style="text-align: center;">Cart</h2>
        <div>
            <table>
                <tr>
                    <th id="item_id">Product ID</th>
                    <th id="name">Product Name</th>
                    <th id="price">Price/Gallon</th>
                    <th id="quantity">Gallon</th>
                    <th id="total">Total</th>
                    <th>Actions</th>
                </tr>
            </table>
        </div>
        <div id="list">
            <?php include 'loading_cart.php' ?>
        </div>
    </section>
</body>
<footer>
</footer>

</html>