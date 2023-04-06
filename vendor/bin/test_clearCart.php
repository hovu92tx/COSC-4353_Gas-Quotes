<?php
include 'clearCart.php';

use PHPUnit\Framework\TestCase;

class test_clearCart extends TestCase
{
    public function testClearCart()
    {
        // Arrange
        $_SESSION['cart'] = array(123 => 2, 456 => 3);
        $_SESSION['numberOfOrder'] = 2;

        // Act
        clearCart();

        // Assert
        $this->assertEmpty($_SESSION['cart']);
        $this->assertEquals($_SESSION['numberOfOrder'], 0);
    }
}
