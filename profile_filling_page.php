<?php
session_start();
include 'config/template.php';
$_SESSION['login_status'] = '0';
$_SESSION['username'] = '';
$_SESSION['user_id'] = '';
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
    <aside style="width: 10%; border: none;"></aside>
    <section>
        <?php profile_form('filling') ?>
    </section>
</body>
<footer>
</footer>

</html>