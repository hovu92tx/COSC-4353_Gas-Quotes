<?php
session_start();
$_SESSION['login_status'] = '0';
$_SESSION['username'] = '';
$_SESSION['user_id'] = '';
error_reporting(0);
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
    <section>
        <div id="center_box">
            <h4>Please create your profile before using our service!</h4>
            <form action="profile_filling_action.php" method="POST">
                <label for="name">Full Name:</label><input id="input_field" name="name" type="text" required><br>
                <label for="address1">Address #1</label><input id="input_field" name="address1" type="text" required><br>
                <label for="address2">Address #2</label><input id="input_field" name="address2" type="text"><br>
    
