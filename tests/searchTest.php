<?php
define("search_utils.php", True);
include_once "search_utils.php";

class search_utilsTest extends PHPUnit_Framework_TestCase {


    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * 
     *
     * 
     */
    public function testGet_City_ID1() {
        $this->assertEquals(
                1, get_city_id('calgary', 'alberta')
        );
    }

    /**
     * 
     *
     * 
     */
    public function testGet_City_ID2() {
        $this->assertEquals(
                2, get_city_id('edmonton', 'alberta')
        );
    }
    
    /**
     * 
     *
     * 
     */
    public function testGet_City_ID3() {
        $this->assertEquals(
                NULL, get_city_id('edmonton', 'ontario')
        );
    }

    /**
     * 
     *
     * 
     */
    public function testParse_Conditions1() {
        $this->assertEquals(
                ' where cityID = 5', parse_conditions(5, NULL, NULL, NULL, NULL, NULL)
        );
    }
    
    /**
     * 
     *
     * 
     */
    public function testParse_Conditions2() {
        $this->assertEquals(
                ' where cityID = 5 and price >= 10 and price <= 15 and num_bdrms = 1 and lower(district) = lower(\'s\') and lower(status) = lower(\'q\')', 
                parse_conditions(5, 10, 15, 1, 's', 'q')
        );
    }
}
