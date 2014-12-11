<?php

namespace PBjuhr\FlashMessages;

/**
 * Test class for flash messages
 */
class FlashMessagesTest extends \PHPUnit_Framework_TestCase {
    
    private $fm;

    /**
     * Test
     * Creates an instance of the FlashMessage class
     */
    public function testCreateElement() {
        $fm = new FlashMessages();
        $this->assertEquals("hello", "hello", "Error message.");
    }

}