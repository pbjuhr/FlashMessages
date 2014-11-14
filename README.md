FlashMessages
=============
Php class for generating and displaying flash messages.

How to use
-------------

###1. Download

The easiest way is to install using composer.
Add to your composer.json: 

```javascript
"require": {
    "pbjuhr/flashmessages": "dev-master"
},
```
Do not forget to run composer update!

Don't wanna use Composer? Download .zip from this page!

###2. Include in your project
Session must be started before using FlashMessages.  
To include FlashMessages in your ANAX-application, add the class in your front
controller:
```php
$di->setShared('FlashMessages', function() use ($di) { 
    $FlashMessages = new \PBjuhr\FlashMessages\FlashMessages($di); 
    return $FlashMessages; 
});
```

__Not using ANAX?__
Replace FlashMessages.php with FlashMessages_NoANAX.php and include it in your project.
```php
require "FlashMessages.php"
$myFlashMessagesObject = new FlashMessages();
```

###3. Generate messages
Four different types of messages can be generated. Info, Success, Warnings or Errors!
Add a message using one of the following functions:
```php
$content = "<strong>Heads up!</strong> This is a flash message.";
$type = "info"; /* Must be: "info", "success", "warning" or "error" */

$myFlashMessagesObject->add($type, $content);
$myFlashMessagesObject->addInfo($content);
$myFlashMessagesObject->addSuccess($content);
$myFlashMessagesObject->addWarning($content);
$myFlashMessagesObject->addError($content);
```

Here's an example how to add a message in ANAX:
```php
$app->FlashMessages->addSuccess($content);
```

###4. Display messages
To display messages, simply call the function getHtml($class).
$class is an optional parameter that sets a css-class to the div objects. Standard css-class is "alert" for bootstrap users!

```php
echo $myFlashMessagesObject->getHtml("myCssClass");
```
Each message gets printed in the following format:
```html
<div class="myCssClass myCssClass-type" role="alert">Content</div>
```
Where "type" is either "success", "info", "warning" or "danger". (Bootstrap standard)
Note! The getHtml sets the messages session to NULL before returning.

License 
------------------
MIT