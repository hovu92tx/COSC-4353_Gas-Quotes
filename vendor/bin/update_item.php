<?php
function update_item($p_id, $p_quantity)
{
    $product_id = $p_id;
    $quantity = $p_quantity;
    $_SESSION['cart'][$product_id] = $quantity;
}