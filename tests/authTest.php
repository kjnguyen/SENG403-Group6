<?php

define("auth.php", true);
include 'admin/auth.php';

class authTest extends PHPUnit_Framework_TestCase
{
	public function testCheckUsername_EmptyInput()
	{
            $testuser = "";
            $result = CheckUsername($testuser);
            $this->assertEquals(0, $result);
	}

	public function testCheckUsername_NullInput()
	{
            $result = CheckUsername(NULL);
            $this->assertEquals(0, $result);
	}
        
        public function testCheckUsername_InvalidChars()
        {
            $testuser = "KABOOM!";
            $result = CheckUsername($testuser);
            $this->assertEquals(0, $result);
        }
        
        public function testCheckUsername_ValidEmail()
        {
            $testuser = "admin@admin.com";
            $result = CheckUsername($testuser);
            $this->assertEquals(1, $result);
        }
        
        public function testCheckUsername_InvalidEmail()
        {
            $testuser = "admin@adm in.com";
            $result = CheckUsername($testuser);
            $this->assertEquals(0, $result);
        }

	public function testCheckUsername_ValidUser()
       	{
            $testuser = "admin";
            $result = CheckUsername($testuser);
            $this->assertEquals(1, $result);
	}

	public function testCompareData_EmptyInput()
	{
            $testuser = "";
            $testpass = "";

            $result = CompareData($testuser, $testpass);
            $this->assertEquals(0, $result);
	}

	public function testCompareData_NullInput()
	{
            $result = CompareData(NULL, NULL);
            $this->assertEquals(0, $result);
	}
        
        public function testCompareData_ValidUser_InvalidPass()
        {
            $testuser = "admin";
            $testpass = "pumpumpum";
            
            $result = CompareData($testuser, $testpass);
            $this->assertEquals(-1, $result);
        }
        
        public function testCompareData_InvalidUser_ValidPass()
        {
            $testuser = "adminn";
            $testpass = "1234567a";
            
            $result = CompareData($testuser, $testpass);
            $this->assertEquals(-1, $result);
        }

	public function testCompareData_ValidCredentials()
	{
            $testuser = "admin";
            $testpass = "1234567a";

            $result = CompareData($testuser, $testpass);
            $this->assertEquals(1, $result);	
	}
}
