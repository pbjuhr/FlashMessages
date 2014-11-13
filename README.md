FlashMessages
=============
Php class for generating and displaying flash messages.

How to use
-------------

###1. Download

The easiest way is install using composer.
Add to your composer.json: 

```javascript
"require": {
    "pbjuhr/flashmessages": "dev-master"
},
```
Do not forget to run composer install!

Don't wanna use Composer? Download .zip from this page!

###2. Include in your project
To include FlashMessages in your ANAX-application, add the class in your front
controller:
```php
$di->setShared('FlashMessages', function() use ($di) { 
    $FlashMessages = new \PBjuhr\FlashMessages\FlashMessages($di); 
    return $FlashMessages; 
});
```

Not using ANAX?
Replace FlashMessages.php with FlashMessages_NoANAX.php and include it in your project.
```php
require "FlashMessages.php"
$myFlashMessagesObject = new FlashMessages();
```

###3. Generate messages
Four different types of messages can be generated. Info, Success, Warnings or Errors!
Five functions exist to add messages:
```php
$content = "<strong>Heads up!</strong> This is a flash message.";
$type = "info"; */ "info", "success", "warning" or "error" */

$myFlashMessagesObject->add($type, $content);
$myFlashMessagesObject->addInfo($content);
$myFlashMessagesObject->addSuccess($content);
$myFlashMessagesObject->addWarning($content);
$myFlashMessagesObject->addError($content);
```

Here's an example how to add a message in ANAX:
```php
$content = "<strong>Heads up!</strong> This is a flash message.";
$app->FlashMessages->addSuccess($content);
```

###4. Display messages
To display messages, simply use the function getHtml($class).
$class is optional and sets a class to the div objects. Standard class is "alert".

```php
echo $myFlashMessagesObject->getHtml("myCssClass");
```
Each message gets printed in the following format:
```html
<div class="myCssClass myCssClass-type" role="alert">Content</div>
```
Note! The getHtml sets the messages session to NULL.

License 
------------------
MIT