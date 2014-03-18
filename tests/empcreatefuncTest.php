<?php

include 'admin/empcreatefunc.php';

/* ...EmptyInput() and ...ValidInput() fail 
 * Because the function create_emp_secure(...) in empcreatefunc.php
 * returns false no matter what. Nothing is added to database after function call
 * Function is broken.
 */

class empcreatefuncTest extends PHPUnit_Framework_TestCase
{
	public function testCreateEmployee_EmptyInput()
	{
            $result = create_emp_secure(0, "", "", "", "", "");
            $this->assertTrue($result);
	}
	
	public function testCreateEmployee_NullInput()
	{
            $result = create_emp_secure(0, NULL, NULL, NULL, NULL, NULL);
            $this->assertFalse($result);
	}

	public function testCreateEmployee_ValidInput()
	{
            $result = create_emp_secure(0, "Joanne Tester", "403-555-8378", "joannetest@testing.com", "joannetest", "testing");
            $this->assertTrue($result);
	}
}
