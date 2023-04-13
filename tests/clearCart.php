<?php
function clearCart()
{
    unset($_SESSION['cart']);
    $_SESSION['numberOfOrder'] = 0;
}