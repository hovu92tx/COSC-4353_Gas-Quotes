<?php
session_start();
error_reporting(0);

// Check if the "cart" array exists in the session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Check if the user clicked the "Add to Cart" button
if (isset($_POST['add_to_cart'])) {
    // Get the product ID and quantity from the form
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // If the product is already in the cart, update the quantity
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $quantity;
    } else {
        // Otherwise, add the product to the cart
        $_SESSION['cart'][$product_id] = $quantity;
    }
    $_SESSION['numberOfOrder'] = count($_SESSION['cart']);
    header('location:dashboard.php');
}
// Check if the user clicked the "Remove" button
if (isset($_POST['remove'])) {
    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);
    $_SESSION['numberOfOrder'] = count($_SESSION['cart']);
    header('location:cart.php');
}
if (isset($_POST['update'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $_SESSION['cart'][$product_id] = $quantity;
    header('location:cart.php');
}
