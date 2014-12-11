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
        $this->fm->add("message", "info");
        $this->fm->clean();
        $this->assertEquals(NULL, $_SESSION[$this->fm->getSessionKey()], "Session was not reset");
    }

    /**
     * Testing to find all messages after something gets added
     * @depends testAdd
     */
    public function testFindAll() {
        $expected = [];
        $messages = $this->fm->findAll();
        $this->assertEquals($expected, $messages);

        $this->fm->add("message", "info");
        $messages = $this->fm->findAll();
        $expected = $_SESSION[$this->fm->getSessionKey()];
        $this->assertEquals($expected, $messages, "Did not found right messages");
    }

    /**
     * Tests addError method
     * @depends testAdd
     * @depends testFindAll
     */
    public function testAddError() {
        $msg = "error message";
        $this->fm->addError($msg);
        $messages = $this->fm->findAll();
        $this->assertTrue(count($messages) === 1, "Not exactly 1 message in session");
        $this->assertEquals("error", $messages[0]["type"], "Wrong message type");
        $this->assertEquals($msg, $messages[0]["content"], "Wrong message content");
    }

    /**
     * Tests addSuccess method
     * @depends testAdd
     * @depends testFindAll
     */
    public function testAddSuccess() {
        $msg = "success message";
        $this->fm->addSuccess($msg);
        $messages = $this->fm->findAll();
        $this->assertTrue(count($messages) === 1, "Not exactly 1 message in session");
        $this->assertEquals("success", $messages[0]["type"], "Wrong message type");
        $this->assertEquals($msg, $messages[0]["content"], "Wrong message content");
    }

    /**
     * Tests addWarning method
     * @depends testAdd
     * @depends testFindAll
     */
    public function testAddWarning() {
        $msg = "warning message";
        $this->fm->addWarning($msg);
        $messages = $this->fm->findAll();
        $this->assertTrue(count($messages) === 1, "Not exactly 1 message in session");
        $this->assertEquals("warning", $messages[0]["type"], "Wrong message type");
        $this->assertEquals($msg, $messages[0]["content"], "Wrong message content");
    }

    /**
     * Tests addInfo method
     * @depends testAdd
     * @depends testFindAll
     */
    public function testAddInfo() {
        $msg = "info message";
        $this->fm->addInfo($msg);
        $messages = $this->fm->findAll();
        $this->assertTrue(count($messages) === 1, "Not exactly 1 message in session");
        $this->assertEquals("info", $messages[0]["type"], "Wrong message type");
        $this->assertEquals($msg, $messages[0]["content"], "Wrong message content");
    }

    /**
     * Tests GetHtml method
     * @depends testAddInfo
     * @depends testAddError
     */
    public function testGetHtml() {
        $this->assertEquals('', $this->fm->getHtml(), "Html not empty");

        $successmessage = "This is success";
        $this->fm->addSuccess($successmessage);
        $expectedHtml = '<div class="alert alert-success" role="alert">'.$successmessage.'</div>';
        $this->assertEquals($expectedHtml, $this->fm->getHtml(), "Html did not match (1st message)");  

        $class = "myCssClass";

        $errormessage = "This is an error";
        $this->fm->addError($errormessage);
        $expectedHtml = '<div class="'. $class . ' '. $class . '-danger" role="alert">'.$errormessage.'</div>';

        $infomessage = "This is some info";        
        $this->fm->addInfo($infomessage);
        $expectedHtml .= '<div class="'. $class . ' '. $class . '-info" role="alert">'.$infomessage.'</div>';

        $this->assertEquals($expectedHtml, $this->fm->getHtml($class), "Html did not match (2nd message)");        
    }

    /**
     * Tests changeSessionKey method
     * @depends testGetSessionKey
     * @depends testFindAll
     * @depends testAdd
     */
    public function testChangeSessionKey() {
        $message = "testkey message";
        $this->fm->add($message, "info");

        $oldKey = $this->fm->getSessionKey();
        $newKey = "testkey";
        $this->fm->changeSessionKey($newKey);
        $this->assertEquals($this->fm->getSessionKey(), $newKey, "Did not set new session key.");
        $this->assertEquals(NULL, $_SESSION[$oldKey], "Did not clean the session with old key");

        $messages = $this->fm->findAll();
        $this->assertEquals($message, $messages[0]["content"], "Messages were not transfered");
    }

}