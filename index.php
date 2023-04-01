<?php
session_start();
require 'connect.php';
include 'config/template.php';
include 'config/sessions.php';
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
    <!--Login Form-->
    <aside>
        <?php echo $loginForm ?>
    </aside>
    <section>
        <h2 style="background-color: rgb(91, 253, 91); margin: 0em; padding: 0.5em; text-align: center;">Quotes</h2>
        <!--Get quote from database and list them on the screen-->
        <?php include 'index_get_quotes.php'; ?>
    </section>
</body>
<footer>
</footer>

</html>