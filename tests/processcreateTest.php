<?php

include 'admin/process_create.php';

class processcreateTest extends PHPUnit_Framework_TestCase
{
    public function testIsCreateInvalid_EmptyInput()
    {
        $result = is_create_invalid("", "", "", "", "", "", "", "", "", "", "", "", "", "");
        $this->assertNotNull($result);
    }
    
    public function testIsCreateInvalid_NoCompID()
    {
        $result = is_create_invalid("", 250000, 2000, 3, 6, 1980, "House", "Bungalow", "Calgary", "Alberta", 350.00, "Testing", 2, "123 Test Street NW");
        $this->assertNotNull($result);
    }
    
    public function testIsCreateInvalid_NoPrice()
    {
        $result = is_create_invalid(29, "", 2000, 3, 6, 1980, "House", "Bungalow", "Calgary", "Alberta", 350.00, "Testing", 2, "123 Test Street NW");
        $this->assertNotNull($result);
    }
    
    public function testIsCreateInvalid_NoSQFT()
    {
        $result = is_create_invalid(29, 250000, "", 3, 6, 1980, "House", "Bungalow", "Calgary", "Alberta", 350.00, "Testing", 2, "123 Test Street NW");
        $this->assertNotNull($result);
    }
    
    public function testIsCreateInvalid_NoFloors()
    {
        $result = is_create_invalid(29, 250000, 2000, "", 6, 1980, "House", "Bungalow", "Calgary", "Alberta", 350.00, "Testing", 2, "123 Test Street NW");
        $this->assertNotNull($result);
    }
    
    public function testIsCreateInvalid_NoBdRms()
    {
        $result = is_create_invalid(29, 250000, 2000, 3, "", 1980, "House", "Bungalow", "Calgary", "Alberta", 350.00, "Testing", 2, "123 Test Street NW");
        $this->assertNotNull($result);
    }
    
    public function testIsCreateInvalid_NoYear()
    {
        $result = is_create_invalid(29, 250000, 2000, 3, 6, "", "House", "Bungalow", "Calgary", "Alberta", 350.00, "Testing", 2, "123 Test Street NW");
        $this->assertNotNull($result);
    }
    
    public function testIsCreateInvalid_NoPropType()
    {
        $result = is_create_invalid(29, 250000, 2000, 3, 6, 1980, "", "Bungalow", "Calgary", "Alberta", 350.00, "Testing", 2, "123 Test Street NW");
        $this->assertNotNull($result);
    }
    
    public function testIsCreateInvalid_NoBldgType()
    {
        $result = is_create_invalid(29, 250000, 2000, 3, 6, 1980, "House", "", "Calgary", "Alberta", 350.00, "Testing", 2, "123 Test Street NW");
        $this->assertNotNull($result);
    }
    
    public function testIsCreateInvalid_NoCity()
    {
        $result = is_create_invalid(29, 250000, 2000, 3, 6, 1980, "House", "Bungalow", "", "Alberta", 350.00, "Testing", 2, "123 Test Street NW");
        $this->assertNotNull($result);
    }
    
    public function testIsCreateInvalid_NoProvince()
    {
        $result = is_create_invalid(29, 250000, 2000, 3, 6, 1980, "House", "Bungalow", "Calgary", "", 350.00, "Testing", 2, "123 Test Street NW");
        $this->assertNotNull($result);
    }
    
    public function testIsCreateInvalid_NoMainFee()
    {
        $result = is_create_invalid(29, 250000, 2000, 3, 6, 1980, "House", "Bungalow", "Calgary", "Alberta", "", "Testing", 2, "123 Test Street NW");
        $this->assertNotNull($result);
    }
    
    public function testIsCreateInvalid_NoStatus()
    {
        $result = is_create_invalid(29, 250000, 2000, 3, 6, 1980, "House", "Bungalow", "Calgary", "Alberta", 350.00, "", 2, "123 Test Street NW");
        $this->assertNotNull($result);
    }
    
    public function testIsCreateInvalid_NoBaths()
    {
        $result = is_create_invalid(29, 250000, 2000, 3, 6, 1980, "House", "Bungalow", "Calgary", "Alberta", 350.00, "Testing", "", "123 Test Street NW");
        $this->assertNotNull($result);
    }
    
    public function testIsCreateInvalid_NoAddres()
    {
        $result = is_create_invalid(29, 250000, 2000, 3, 6, 1980, "House", "Bungalow", "Calgary", "Alberta", 350.00, "Testing", 2, "");
        $this->assertNotNull($result);
    }
    
    public function testIsCreateInvalid_ValidInput()
    {
        $result = is_create_invalid(22, 250000, 2000, 3, 6, 1980, "House", "Bungalow", "Calgary", "Alberta", 350.00, "Testing", 2, "123 Test Street NW");
        $this->assertNull($result);
    }
}
