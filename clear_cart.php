<?php
session_start();
unset($_SESSION['cart']);
$_SESSION['numberOfOrder'] = 0;
header('location:cart.php');
