<?php
include 'userName_Check.php';

use PHPUnit\Framework\TestCase;

class test_userName_Check extends TestCase
{
    public function testUserNameCheck()
    {
        // Test a valid username
        $this->assertTrue(userName_Check('john_doe123'));

        // Test an invalid username that's too short
        $this->assertFalse(userName_Check('joe'));

        // Test an invalid username with special characters
        $this->assertFalse(userName_Check('joe!@#'));

        // Test an invalid username with only digits
        $this->assertFalse(userName_Check('12345'));

        // Test an invalid username with only special characters
        $this->assertFalse(userName_Check('!@#$%'));
    }
}
