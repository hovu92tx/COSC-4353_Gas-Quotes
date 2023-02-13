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
            <div id="input_box">
                <input id="input_field" name=" fname" type="text" style="width: 150px;"> Last Name: <input
                    id=" input_field" name="lname" type="text" style="width: 150px;"><br><br>
                <input id="input_field" name="DOB" type="date" style="width: 100px;"><br><br>
                <input id="input_field" name="address" type="text"><br><br>
                <input id="input_field" name="city" type="text" style="width: 100px;"> Zipcode: <input id="input_field"
                    name="zipcode" style="width: 80px;" maxlength="5" type="number">
            </div>
            <div id="label_box">
                <p>First Name:</p><br>
                <p>Date of Birth:</p><br>
                <p>Address:</p><br>
                <p>City:</p><br>

            </div>

            <div id="submit_button">
                <button>Submit</button>
            </div>

        </div>
        <div id="rightside_box"></div>
    </div>
</body>
<footer>
</footer>

</html>