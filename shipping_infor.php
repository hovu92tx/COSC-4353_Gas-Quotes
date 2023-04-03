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
            </label><?php echo $name ?></h3>
        </div>

        <div class="vertical-menu">
            <a href="dashboard.php">Home</a>
            <a href="Cart.php" class="active">Cart (<?php echo $_SESSION['numberOfOrder'] ?>)</a>
            <a href="orders.php">Orders</a>
            <a href="profile.php">Profile</a>
            <a onclick="showConfirm()">Log Out</a>
        </div>
    </aside>
    <section>
    <?php profile_form('ship_infor') ?>
    </section>
</body>
<footer>
</footer>

</html>