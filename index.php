<?php
error_reporting(0);
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
    <!--Login Form-->
    <aside>
        <?php echo $loginForm ?>
    </aside>
    <section>
        <!--Get quote from database and list them on the screen-->
        <?php index_Quote() ?>
    </section>
</body>
<footer>
</footer>

</html>