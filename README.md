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

###3. Generate messages

###4. Display messages

###5. Options

License 
------------------
MIT