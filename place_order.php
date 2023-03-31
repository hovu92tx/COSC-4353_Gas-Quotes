<?php
session_start();
require 'connect.php';
/**write order data into database */
error_reporting(0);
try {
    /**Get information of order */
    $userid = $_SESSION['userid'];
    $order_total = $_SESSION['order_total'];
    $date = date("Y-m-d h:i:s");

    /**Insert data into order table */
    $sql = "INSERT INTO orders (user_id,order_total,order_date) VALUES ($userid,$order_total,'$date')";
    $conn->query($sql);

    /**Get current order ID */
    $sql1 = "SELECT order_id FROM orders WHERE order_date='$date'";
    $statement1 = $conn->query($sql1);
    $results1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
    foreach ($results1 as $result1) {
        $order_id = $result1['order_id'];
    }

    /**Insert data into order_detail table */
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        $sql2 = "SELECT * FROM products WHERE product_id LIKE $product_id";
        $statement2 = $conn->query($sql2);
        $results2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
        if ($results2) {
            foreach ($results2 as $result2) {
                $product_name = $result2['product_name'];
                $product_price = $result2['product_price'];
                $total = $quantity * $product_price;
            }
        }
        $delivery_date = $_SESSION['delivery_date'];
        $sql3 = "INSERT INTO order_detail (order_id,product_id,order_detail_unit_price, order_detail_quantity,order_detail_total,order_detail_delivery_date) VALUES ($order_id,$product_id,$product_price,$quantity,$total,'$delivery_date')";
        $conn->query($sql3);
    }
} catch (PDOException $error) {
}
unset($_SESSION['cart']);
$_SESSION['numberOfOrder'] = 0;
header('location:thank_you.php');
