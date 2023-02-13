<?php
if ($_SESSION['login_status'] === '') {
    $log = 'login.php';
    $username = "Login";
    $home = 'home.php';
    $service = 'login.php';
} else {
    $log = 'logout.php';
    $username = $_SESSION['username'];
    $service = $_SESSION['service'];
    $home = 'home.php';
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>ABC Company</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS/home.css">
</head>

<body>
    <header id="company_name">
        ABC Company
    </header>
    <div id="body">
        <div id="leftside_box"></div>
        <div id="center_box">

        </div>
        <div id="rightside_box"></div>
    </div>
</body>
<footer>
</footer>

</html>