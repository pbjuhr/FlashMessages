<?php

namespace PBjuhr\FlashMessages;
 
/**
 * Class for generating and displaying flash messages.
 * @author Peter Bjuhr (www.pbjuhr.se, bjuhr.peter@gmail.com)
 */
class FlashMessages {

    private $sessionKey;



    /**
     * Contructor, sets session key.
     */
    public function __construct($sessionKey = "FLashMessages") {
		$this->sessionKey = $sessionKey;
	}




	/**
	 * Sets a new session key, copy the old values & cleans the old session key
	 * @param [string] $newKey [The new session key]
	 */
	public function replaceSessionKey($newKey) {
		$messages = $this->findAll();
		
		/* if no messages exist */
		if(count($messages) < 1) {
			$_SESSION[$newKey] = $messages;
		}

		$this->clean();
		$this->sessionKey = $newKey;
	}




	/**
	 * Gets the session key
	 * @return [String] [The session key]
	 */
	public function getSessionKey() {
		return $this->sessionKey;
	}




    /**
     * Finds all Flashmessages from session
     * @return all messages
     */
    public function findAll(){
    	if(isset($_SESSION[$this->sessionKey])) {
    		return $_SESSION[$this->sessionKey];
    	}
		return [];
	}




	/**
	 * Adds a flash message to the session
	 *
	 * @param type (required), the type of message "info", "warning", "success" or "error".
	 * @param content (required), the message (can contain html)
	 *
	 * @return void
	 */
	public function add($type, $content) {

		if($type !== "warning" && $type !== "success"  && $type !== "error") {
			$type = "info";
		}

		$messages = $this->findAll();

		$messages[] = [
			"type" => $type, 
			"content" => $content,
		];

		$_SESSION[$this->sessionKey] = $messages;

	}



	/**
	 * Adds an info message using the add method.
	 * @param $content (required), the message
	 * @return void
	 */
	public function addInfo($content) {
		$this->add("info", $content);
	}




	/**
	 * Adds a success message using the add method.
	 * @param $content (required), the message
	 * @return void
	 */
	public function addSuccess($content) {
		$this->add("success", $content);
	}




	/**
	 * Adds a warning message using the add method.
	 * @param $content (required), the message
	 * @return void
	 */
	public function addWarning($content) {
		$this->add("warning", $content);
	}




	/**
	 * Adds an error message using the add method.
	 * @param $content (required), the message
	 * @return void
	 */
	public function addError($content) {
		$this->add("error", $content);
	}




	/**
	 * [getHtml description]
	 * @param  $class (optional), sets a class to the div objects
	 * @return $html, all messages formatted in html, or null if no messages exist
	 */
	public function getHtml($class = "alert") {

        $messages = $this->findAll();
		
		/* if no messages exist */
		if(count($messages) < 1) {
			return NULL;
		}

		$html = '';

		foreach ($messages as $message){
			if($message["type"] == "error") {
				$message["type"] = "danger"; 
			}
			$html .= '<div class="'. $class . ' '. $class . '-' .$message["type"].'" role="alert">'.$message["content"].'</div>';
		}

		$this->clean();

		return $html;
	}




	/**
	 * Resets the flash message session
	 * @return void
	 */
	public function clean() {
		$_SESSION[$this->sessionKey] = NULL;
	}

}