<?php
include 'filling.php';

use PHPUnit\Framework\TestCase;

class fillingTest extends TestCase
{
    public function testFilling()
    {
        // Arrange
        $_POST['name'] = 'John Doe';
        $_POST['address1'] = '123 Main St';
        $_POST['address2'] = '';
        $_POST['city'] = 'Anytown';
        $_POST['state'] = 'TX';
        $_POST['zipcode'] = '12345';

        // Act
        $result = filling('filling');

        // Assert
        $this->assertTrue($result);
        $this->assertEquals($_SESSION['cus_name'], 'John Doe');
        $this->assertEquals($_SESSION['cus_add1'], '123 Main St');
        $this->assertEquals($_SESSION['cus_add2'], 'N/A');
        $this->assertEquals($_SESSION['cus_city'], 'Anytown');
        $this->assertEquals($_SESSION['cus_state'], 'TX');
        $this->assertEquals($_SESSION['cus_zipcode'], '12345');
    }
}
