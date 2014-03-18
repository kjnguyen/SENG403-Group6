<?php

include 'admin/postlistingfunc.php';

class postlistingTest extends PHPUnit_Framework_TestCase
{
	public function testPostListingSecure_EmptyStrings()
	{
            $result = postlisting_secure(0, 0.0, 0.0, 0, 0, 0, "", "", "", "", "", 0.0, "", 0, "", "");
            $this->assertFalse($result);
	}
        
        public function testPostListingSecure_NullInput()
        {
            $result = postlisting_secure(0, 0.0, 0.0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 0.0, NULL, 0, NULL, NULL);
            $this->assertFalse($result);
        }
        
        public function testPostlistingSecure_ValidInput()
        {
            $result = postlisting_secure(22, 350000.00, 1800.00, 4, 4, 1998, "4-Level Split", "House", "SE", "Calgary", "Alberta", 350.00, "Test", 3, "123 Testamee St. SE", "This is created by a test function.");
            $this->assertTrue($result);
        }
        
        public function testCheckPermission_NULL()
        {
            $result = check_createListing_permission(NULL);
            $this->assertEquals(0, $result);
        }
        
        public function testCheckPermission_AdminID()
        {
            $result = check_createListing_permission(11);
            $this->assertEquals(1, $result);
        }
        
        public function testCheckPermission_CompanyID()
        {
            $result = check_createListing_permission(22);
            $this->assertEquals(1, $result);
        }
        
        public function testCheckPermission_EmployeeID()
        {
            $result = check_createListing_permission(35);
            $this->assertEquals(1, $result);
        }
        
        public function testCheckPermission_InvalidID()
        {
            $result = check_createListing_permission(999);
            $this->assertEquals(0, $result);
        }
        
        public function testCheckPermission_NotLoggedIn()
        {
            $result = check_createListing_permission(12);
            $this->assertEquals(0, $result);
        }
}
