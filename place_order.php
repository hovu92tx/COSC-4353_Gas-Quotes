<?php
session_start();
/**write order data into database */
unset($_SESSION['cart']);
$_SESSION['numberOfOrder'] = 0;
header('location:thank_you.php');
