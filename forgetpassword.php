<?php
session_start();
require('connect.php');
include 'config/template.php';
$_SESSION['login_status'] = '';
$_SESSION['username'] = '';
$_SESSION['userid'] = '';
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
        <?php echo $loginForm ?>
    </aside>
    <section>
        <h2 style="text-align: center;">Recover Password!</h2>
        <p>Please contact admin to make a request!</p>
        <p>Contact: Group 56 - COSC 4353</p>
    </section>
</body>
<footer>
</footer>

</html>