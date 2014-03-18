<?php

include 'admin/add_utils.php';

class addUtilsTest extends PHPUnit_Framework_TestCase
{
	public function testAddCompanySecure_EmptyInput()
        {
	       $result = add_company_secure("", "", "", "", "", "", "", "");
	       $this->assertTrue($result);
	}
        
        public function testAddCompanySecure_NullInput()
        {
            $result = add_company_secure(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
            $this->assertFalse($result);
        }
        
        public function testAddCompanySecure_ValidInput()
        {
            $result = add_company_secure("MessStates", "123 Sesame St. SE", "Testing", "Testen McDonald", "403-555-1234", "testing@testing.com", "testtest", "testingtester");
            $this->assertTrue($result);
        }
        
        public function testEmailUnique_EmailExists()
        {
            $testuser = "4jestates@4jestates.com";
            $result = email_unique($testuser);
            $this->assertFalse($result);
        }
        
        public function testEmailUnique_Email_DNE()
        {
            $testuser = "jackjackjack@joejoejoe.com";
            $result = email_unique($testuser);
            $this->assertTrue($result);
        }
        
        public function testUsernameUnique_UsernameExists()
        {
            $testuser = "admin";
            $result = username_unique($testuser);
            $this->assertFalse($result);
        }
        
        public function testUsernameUnique_Username_DNE()
        {
            $testuser = "WaterBottle";
            $result = username_unique($testuser);
            $this->assertTrue($result);
        }
}
