<?php
include_once 'encrypt_Data.php';

use PHPUnit\Framework\TestCase;

class encrypt_DataTest extends TestCase
{
    public function EncryptDataTest()
    {
        // Arrange
        $inputString = 'Hello, world!';

        // Act
        $encryptedString = encrypt_Data($inputString);

        // Assert
        $this->assertNotEquals($inputString, $encryptedString);
    }
}
