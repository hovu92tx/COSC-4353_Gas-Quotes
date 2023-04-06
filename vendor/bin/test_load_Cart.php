<?php
include 'load_Cart.php';

use PHPUnit\Framework\TestCase;

class test_load_Cart extends TestCase
{
    public function testLoadCartWithItems()
    {
        // Set up a mock session with a cart containing two items
        $session = [
            'cart' => [
                1 => 2,
                2 => 1
            ]
        ];
        $_SESSION = $session;

        // Set up a mock PDO statement with product data for the two items in the cart
        $statement = $this->getMockBuilder(PDOStatement::class)
            ->getMock();
        $statement->expects($this->exactly(2))
            ->method('fetchAll')
            ->will($this->returnValue([
                [
                    'product_id' => 1,
                    'product_name' => 'Product 1',
                    'product_price' => 10.00
                ],
                [
                    'product_id' => 2,
                    'product_name' => 'Product 2',
                    'product_price' => 5.00
                ]
            ]));

        // Set up a mock PDO connection with a query method that returns the mock statement
        $conn = $this->getMockBuilder(PDO::class)
            ->disableOriginalConstructor()
            ->getMock();
        $conn->expects($this->exactly(2))
            ->method('query')
            ->will($this->returnValue($statement));

        // Set up an output buffer to capture the HTML output
        ob_start();

        // Call the function with the mock dependencies
        load_Cart($conn);

        // Get the captured HTML output and clear the buffer
        $output = ob_get_clean();
        // Assert that the output contains the correct product data and order total
        $this->assertStringContainsString('Product 1', $output);
        $this->assertStringContainsString('$10.00', $output);
        $this->assertStringContainsString('2', $output);
        $this->assertStringContainsString('$20.00', $output);
        $this->assertStringContainsString('Product 2', $output);
        $this->assertStringContainsString('$5.00', $output);
        $this->assertStringContainsString('1', $output);
        $this->assertStringContainsString('$5.00', $output);
        $this->assertStringContainsString('$25.00', $output);
        $this->assertStringContainsString('Order Total: $25.00', $output);
    }
}
