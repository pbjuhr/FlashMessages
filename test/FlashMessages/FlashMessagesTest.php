<?php

namespace PBjuhr\FlashMessages;

/**
 * Test class for flash messages
 */
class FlashMessagesTest extends \PHPUnit_Framework_TestCase {
    
    protected $fm;




    /**
     * Creates an instance of the FlashMessage class
     */
    public static function setUpBeforeClass() {
        $this->$fm = new FlashMessages();
    }




    /**
     * Tests getSessionKey method
     */
    public function testgetSessionKey() {
        $this->assertEquals($fm->getSessionKey(), "FlashMessages", "Wrong session key.");
    }

}