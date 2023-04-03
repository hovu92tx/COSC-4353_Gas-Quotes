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
        <?php dash_quote() ?>
        <div><a id="button_link" style="display: block; margin: auto;" href="cart.php">Go To Cart</a></div>
    </section>
</body>
<footer>
</footer>

</html>