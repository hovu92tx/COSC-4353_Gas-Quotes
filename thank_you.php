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
        <?php menu('dash_board'); ?>
    </aside>
    <section>
        <h2 style="text-align: center;">Thank you for your order!</h2>
        <div style="width:90%; margin: auto;">
            <a id="button_link" href="dashboard.php">Continue Shopping</a>
        </div>
    </section>
</body>
<footer>
</footer>

</html>