<?php
error_reporting(0);
session_start();
include 'functions.php';
include 'config/template.php';
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
        <?php menu('cart') ?>
    </aside>
    <!--Cart-->
    <section>
        <?php load_Cart() ?>
    </section>
</body>
<footer>
</footer>

</html>