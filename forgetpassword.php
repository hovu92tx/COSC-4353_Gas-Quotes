<?php
session_start();
require('connect.php');
$_SESSION['login_status'] = '';
$_SESSION['location'] = '';
$_SESSION['username'] = '';
$_SESSION['userid'] = '';
?>
<!DOCTYPE html>
<html>

<head>
    <title>ABC Company</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS/index.css">
</head>

<body>
    <header id="company_name">
        ABC Company
    </header>
    <section id="section1">
        <div id="left_box">
            <form action="login_check.php" method="POST">
                <p id="login_text">Login</p>
                <div style="text-align: right; margin-right: 70px ;">
                    <label for="username" style="margin-right: 10px;"><b>User name</b></label><input id="login_input"
                        type="text" placeholder="User Name" name="username" maxlength="50" require>
                    <br>
                    <label for="password" style="margin-right: 10px;"><b>Password</b></label><input id="login_input"
                        type="password" placeholder="Password" name="password" maxlength="50" required>
                </div>

                <div id="login_button"><button type="submit" name=" login_button">Submit</button></div>
                <a href="forgetpassword.php">For get password?</a>
            </form>

        </div>
        <div id="right_box">
            <h2 style="text-align: center;">Recover Password!</h2>

        </div>
    </section>
</body>
<footer>
</footer>

</html>