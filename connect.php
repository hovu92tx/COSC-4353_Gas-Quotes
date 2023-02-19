<?php
$servername = "127.0.0.1";
$username = "hovu92dk";
$password = "nhithieugia";


try {
  $conn = new PDO("mysql:host=$servername;dbname=abc database", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
} catch (PDOException $e) {
  echo '<div style="background-color: red;height: 20px; text-align:center;" > Server Connection Fail!</div>';
}
