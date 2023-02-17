<?php
session_start();
$_SESSION['login_status'] = '0';
$_SESSION['username'] = '';
$_SESSION['user_id'] = '';
?>
<!DOCTYPE html>
<html>

<head>
    <title>ABC Company</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS/profile_filling_page.css">
</head>

<body>
    <header id="company_name">
        ABC Company
    </header>
    <div id="body">
        <div id="leftside_box"></div>
        <div id="center_box">
            <h2>Welcome to ABC Company</h2>
            <h4>Please complete your profile!</h4>
            <form id="form_box" action="profile_filling_action.php" method="POST">
                <label for="name">Full Name:</label><input id="input_field" name="name" type="text" required><br>
                <label for="address1">Address #1</label><input id="input_field" name="address1" type="text"
                    required><br>
                <label for="address2">Address #2</label><input id="input_field" name="address2" type="text"><br>
                <label for="city">City</label><input id="input_field" name="city" type="text" style="width: 120px;"
                    required>
                <label for="state">State</label><input id="input_field" name="state" style="width: 80px;" type="text"
                    required>
                <label for="zipcode">Zipcode</label><input id="input_field" name="zipcode" style="width: 80px;"
                    maxlength="5" type="number" required>
                <div><button type="submit" name="pf_submit_button">Submit</button></div>
            </form>
        </div>
        <div id="rightside_box"></div>
    </div>
</body>
<footer>
</footer>

</html>