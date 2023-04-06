<?php
include 'update_item.php';

use PHPUnit\Framework\TestCase;

class test_update_item extends TestCase
{
    public function testUpdateItem()
    {
        // Arrange
        $_SESSION['cart'] = array();
        $_SESSION['numberOfOrder'] = 0;
        $_SESSION['cart'][123] = 2;
        $product_id = 123;
        $quantity = 3;

        // Act
        update_item($product_id, $quantity);

        // Assert
        $this->assertEquals($_SESSION['cart'][$product_id], $quantity);
    }
}
