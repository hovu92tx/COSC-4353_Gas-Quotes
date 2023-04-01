<?php
session_start();
require 'connect.php';
include 'config/template.php';
error_reporting(0);
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
    <aside>
        <div style="text-align:center; padding: 5px;"><label for=" name">
                <h3><b>Welcome:</b>
            </label><?php echo $_SESSION['cus_name'] ?></h3>
        </div>
        <div class="vertical-menu">
            <a href="dashboard.php">Home</a>
            <a href="Cart.php">Cart (<?php echo $_SESSION['numberOfOrder'] ?>)</a>
            <a href="orders.php" class="active">Orders</a>
            <a href="profile.php">Profile</a>
            <a onclick="showConfirm()">Log Out</a>
        </div>
    </aside>
    <section>
        <h2 style="text-align: center;">Order History</h2>
        <div>
            <table>
                <tr>
                    <th id="item_id">Order ID</th>
                    <th id="date">Date</th>
                    <th id="add">Delivery Address</th>
                    <th id="total">Total</th>
                    <th id="action">Actions</th>
                </tr>
            </table>
        </div>
        <?php include 'loading_orders.php' ?>
    </section>
</body>
<footer>
</footer>

</html>