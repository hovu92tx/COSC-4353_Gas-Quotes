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
    $usertype = 'login.php';
} else {
    $log = 'logout.php';
    $username = $_SESSION['username'];
    $usertype = $_SESSION['usertype'];
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
    <section id="section1">
        <div id="left_box"></div>
        <div id="center_box">
            <form action="login_check.php" id="login_form" method="POST">
                <p id="login_text">Login</p>
                <div style="text-align: right; margin-right: 70px ;">
                    <label for="username" style="margin-right: 10px;"><b>User name</b></label><input id="login_input"
                        type="text" placeholder="User Name" name="username" maxlength="50" require>
                    <br>
                    <label for="password" style="margin-right: 10px;"><b>Password</b></label><input id="login_input"
                        type="password" placeholder="Password" name="password" maxlength="50" required>
                </div>

                <div id="login_button"><button type="submit" name=" login_button">Submit</button></div>
                <p>Forget Password?</p>
            </form>
        </div>
        <div id="right_box"></div>
    </section>

</body>
<footer>
</footer>

</html>