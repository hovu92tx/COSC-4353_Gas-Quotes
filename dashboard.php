<?php
session_start();
/**connect to database*/
require 'connect.php';
include 'config/template.php';
error_reporting(0);
/**set time zone for clock */
date_default_timezone_set('America/Chicago');
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
    <!--Menu Bar-->
    <aside>
        <div style="text-align:center; padding: 5px;"><label for="name">
                <h3><b>Welcome:</b>
            </label><?php echo $_SESSION['cus_name'] ?></h3>
        </div>
        <div class=" vertical-menu">
            <a href="dashboard.php" class="active">Home</a>
            <a href="cart.php">Cart (<?php echo $_SESSION['numberOfOrder'] ?>)</a>
            <a href="orders.php">Orders</a>
            <a href="profile.php">Profile</a>
            <a onclick="showConfirm()">Log Out</a>
        </div>
    </aside>
    <!--Quotes-->
    <section>
        <h2 style="background-color: rgb(91, 253, 91); margin: 0em; padding: 0.5em; text-align: center;">Prices of gas in <?php echo $_SESSION['cus_city'] ?></h2>
        <div style=" text-align: center; margin: 10px;">
            <span id='ct7'></span>
        </div>
        <div style="margin: auto; width: 98%;  background-color: lightgreen; text-align: center;">
            <?php
            echo $_SESSION['mess'];
            $_SESSION['mess'] = '';
            ?>
        </div>
        <?php include 'dashboard_get_quotes.php' ?>
        <div><a id="button_link" style="display: block; margin: auto;" href="cart.php">Go To Cart</a></div>
    </section>
</body>
<footer>
</footer>

</html>