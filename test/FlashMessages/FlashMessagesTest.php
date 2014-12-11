<?php

namespace PBjuhr\FlashMessages;

/**
 * Test class for flash messages
 */
class FlashMessagesTest extends \PHPUnit_Framework_TestCase {
    
    protected $fm;




    /**
     * Creates an instance of the FlashMessage class before every test
     */
    protected function setUp() {
        $this->fm = new FlashMessages();
    }



    /**
     * Resets the session
     */
    protected function tearDown() {
        $_SESSION = null;
    }




    /**
     * Tests getSessionKey method
     */
    public function testGetSessionKey() {
        $this->assertEquals($this->fm->getSessionKey(), "FlashMessages", "Wrong session key.");
    }



    /**
     * Testing to add som messages
     */
    public function testAdd() {
        $msg = "message";
        $type = "invalid message type";
        $msg2 = "message2";
        $type2 = "warning";
        $this->fm->add($msg, $type);
        $this->fm->add($msg2, $type2);
        $messages = $_SESSION[$this->fm->getSessionKey()];
        $this->assertTrue(count($messages) === 2);
        $this->assertEquals("info", $messages[0]["type"], "Wrong message type");
        $this->assertEquals($msg, $messages[0]["content"], "Wrong message content");
        $this->assertEquals($type2, $messages[1]["type"], "Wrong message2 type");
        $this->assertEquals($msg2, $messages[1]["content"], "Wrong message2 content");
    }




    /**
     * Tests clean method
     * @depends testAdd
     */
    public function testClean() {
        $this->fm->add("message", "error");
    }




    /**
     * Testing to find all messages
     */
    public function testFindAll() {
        $messages = $_SESSION[$this->fm->getSessionKey()];
        $this->assertEquals([], $messages);
        
        $msg = "message";
        $type = "invalid message type";
        $msg2 = "message2";
        $type2 = "warning";
        $this->fm->add($msg, $type);
        $this->fm->add($msg2, $type2);
        $messages = $_SESSION[$this->fm->getSessionKey()];
        $this->assertTrue(count($messages) === 2);
        $this->assertEquals("info", $messages[0]["type"], "Wrong message type");
        $this->assertEquals($msg, $messages[0]["content"], "Wrong message content");
        $this->assertEquals($type2, $messages[1]["type"], "Wrong message2 type");
        $this->assertEquals($msg2, $messages[1]["content"], "Wrong message2 content");
    }
    




    /**
     * Tests addError method
     * @depends testAdd
     */
    public function testAddError() {
        $msg = "message";
        $this->fm->addError($msg);
        $messages = $this->fm->findAll();
        $this->assertTrue(count($messages) === 1);
        $this->assertEquals("error", $messages[0]["type"], "Wrong message type");
        $this->assertEquals($msg, $messages[0]["content"], "Wrong message content");
    }




    /**
     * Tests changeSessionKey method
     */
    public function testChangeSessionKey() {
        $newKey = "testkey";
        $this->fm->changeSessionKey($newKey);
        $this->assertEquals($this->fm->getSessionKey(), $newKey, "Wrong session key.");
    }

}