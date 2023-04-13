<?php
include 'pass_Check.php';

use PHPUnit\Framework\TestCase;

class pass_CheckTest extends TestCase
{
    public function test_pass_Check()
    {
        // Test a valid password
        $this->assertTrue(pass_Check('SecurePassword123!'));

        // Test an invalid password with only lowercase letters
        $this->assertFalse(pass_Check('weakpassword'));

        // Test an invalid password with only uppercase letters
        $this->assertFalse(pass_Check('WEAKPASSWORD'));

        // Test an invalid password with only numbers
        $this->assertFalse(pass_Check('12345678'));

        // Test an invalid password with only special characters
        $this->assertFalse(pass_Check('!@#$%^&*'));

        // Test an invalid password that's too short
        $this->assertFalse(pass_Check('shortpw'));
    }
}
