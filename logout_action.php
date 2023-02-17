<?php
session_start();
$_SESSION['login_status'] = '';
$_SESSION['username'] = '';
$_SESSION['userid'] = '';
header('location: index.php');
