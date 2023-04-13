<?php
function remove_Item($p_id)
{
    $product_id = $p_id;
    unset($_SESSION['cart'][$product_id]);
    $_SESSION['numberOfOrder'] = count($_SESSION['cart']);
}