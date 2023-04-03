<?php
error_reporting(0);
session_start();
require 'connect.php';
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
    <aside>
        <?php menu('profile') ?>
    </aside>
    <section>
        <?php profile_form('profile') ?>
    </section>

</body>
<footer>
</footer>

</html>