<?php
include 'encrypt_Data.php';

use PHPUnit\Framework\TestCase;

class test_encrypt_Data extends TestCase
{
    public function testEncryptData()
    {
        // Arrange
        $inputString = 'Hello, world!';

        // Act
        $encryptedString = encrypt_Data($inputString);

        // Assert
        $this->assertNotEquals($inputString, $encryptedString);
    }
}
