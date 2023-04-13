<?php
include 'deencrypt_Data.php';
include_once 'encrypt_Data.php';

use PHPUnit\Framework\TestCase;

class Deencrypt_DataTest extends TestCase
{
    public function testDecryptData()
    {
        // Arrange
        $inputString = 'Hello, world!';
        $encryptedString = encrypt_Data($inputString);

        // Act
        $decryptedString = deencrypt_Data($encryptedString);

        // Assert
        $this->assertEquals($inputString, $decryptedString);
    }
}
