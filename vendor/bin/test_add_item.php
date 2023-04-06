<?php
include 'add_item.php';

use PHPUnit\Framework\TestCase;

class test_add_item extends TestCase
{
    public function testAddItem()
    {
        // Arrange
        $_SESSION['cart'] = array();
        $_SESSION['numberOfOrder'] = 0;
        $product_id = 123;
        $quantity = 2;

        // Act
        add_item($product_id, $quantity);

        // Assert
        $this->assertEquals($_SESSION['cart'][$product_id], $quantity);
        $this->assertEquals($_SESSION['numberOfOrder'], 1);
        $this->assertEquals($_SESSION['mess'], 'Added to your cart!');
    }
}
