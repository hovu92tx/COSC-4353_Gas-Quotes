<?php
include 'remove_item.php';

use PHPUnit\Framework\TestCase;

class test_remove_item extends TestCase
{
    public function testRemoveItem()
    {
        // Arrange
        $_SESSION['cart'] = array();
        $_SESSION['numberOfOrder'] = 0;
        $_SESSION['cart'][123] = 2;
        $product_id = 123;

        // Act
        remove_Item($product_id);

        // Assert
        $this->assertArrayNotHasKey($product_id, $_SESSION['cart']);
        $this->assertEquals($_SESSION['numberOfOrder'], 0);
    }
}
