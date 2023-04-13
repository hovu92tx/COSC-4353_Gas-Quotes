<?php
function add_item($p_id, $p_quantity)
{
    $product_id = $p_id;
    $quantity = $p_quantity;
    // If the product is already in the cart, update the quantity
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += $quantity;
        $_SESSION['mess'] = 'Added to your cart!';
    } else {
        // Otherwise, add the product to the cart
        $_SESSION['cart'][$product_id] = $quantity;
        $_SESSION['mess'] = 'Added to your cart!';
    }
    $_SESSION['numberOfOrder'] = count($_SESSION['cart']);
}
