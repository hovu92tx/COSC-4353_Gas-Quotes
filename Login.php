<?php
session_start();
$_SESSION['login_status'] = '';
$_SESSION['username'] = '';
$_SESSION['user_id'] = '';
$_SESSION['usertype'] = '';
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
    <link rel="stylesheet" href="CSS/login_page.css">
</head>

<body>
    <header id="company_name">
        ABC Company
    </header>
    <div id="body">
        <div id="leftside_box"></div>
        <div id="login_box">
            <p id="login_text">Login</p>
            <div style="float: left; width: 28%; height: 75px; text-align: right;">
                <h3>User name:</h3>
                <h3>Password:</h3>
            </div>
            <div style="float: right; width: 70%; height: 75px; text-align: left;">
                <input id="login_input" type="text">
                <input id="login_input" type="text">
            </div>
            <div style="float: left; width: 100%;">
                <button id="login_button">Submit</button>
            </div>
        </div>
        <div id="rightside_box"></div>
    </div>
</body>
<footer>
</footer>

</html>