<?php
session_start();
include 'config/template.php';
include 'functions.php';
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
        <?php menu('dash_board') ?>
    </aside>
    <!--Quotes-->
    <section>
        <?php dash_quote() ?>
        <div><a id="button_link" style="display: block; margin: auto;" href="cart.php">Go To Cart</a></div>
    </section>
</body>
<footer>
</footer>

</html>
