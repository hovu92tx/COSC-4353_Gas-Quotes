<?php
session_start();
require 'functions.php';
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
        <?php menu('order') ?>
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
        <?php orders() ?>
    </section>
</body>
<footer>
</footer>

</html>