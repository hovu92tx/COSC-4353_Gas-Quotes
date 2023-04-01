<?php
$head = '<title>ABC Company</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="sj/clock.js"></script>
<script src="sj/confirm.js"></script>
<link rel="stylesheet" href="CSS/frame.css">';

$loginForm = '<form id="login_form" action="login_check.php" method="POST">
<h2 id="login_h2">Login</h2>
<label id="login_label" for="userName"><b>User Name:</b></label>
<input id="login_input" type="text" name="username" required><br>
<label id="login_label" for="password"><b>Password:</b></label>
<input id="login_input" type="password" name="password" required><br>
<button id="login_button" type="submit" name="loginButton"><b>Login</b></button><br>
<a id="login_a" href="forgetpassword.php">Forget password?</a>
</form>';
