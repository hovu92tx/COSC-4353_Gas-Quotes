<?php
session_start();
$_SESSION['username'] = '';
$_SESSION['userid'] = '';
header('location: index.php');
