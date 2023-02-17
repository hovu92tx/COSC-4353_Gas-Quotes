<?php
session_start();
require('connect.php');
try {
    $userid = $_SESSION['userid'];
    $sql = "SELECT * FROM products";
    $statement = $conn->query($sql);
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    if ($results) {
        foreach ($results as $result) {
            $product_name = $result['product_name'];
            $product_price = $result['product_price'];
            $product_id = $result['product_id'];
            $html = '<section id="quote_form">
            <div>' . $product_name . '</div>
            <div>
                <p>Price: ' . $product_price . '/Galon</p>
            </div>
            <div><button>Add to Cart</button></div></section>';
            echo $html;
        }
    }
} catch (PDOException $error) {
    echo $error;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>ABC Company</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS/dashboard.css">
</head>

</html>