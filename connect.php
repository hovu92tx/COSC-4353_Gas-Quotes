<?php
$servername = "127.0.0.1";
$username = "hovu92dk";
$password = "nhithieugia";


try {
  $conn = new PDO("mysql:host=$servername;dbname=abc database", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
define('PRODUCT_IMG_URL', 'assets/product-images/');