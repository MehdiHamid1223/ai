# Free Ai API
### This is a free ai library for developers.

## Requirements
Ai API depends on PHP 8.0+.

## **Installation**
Add ```mehdihamid/ai``` as a require dependency in your ```composer.json``` file:

    composer require mehdihamid/ai

## **Usage**
## ChatGPT API
Use ChatGPT API
```php
use Ai\ChatGPT;

$api = new ChatGPT();
```

Send New Message
```php
echo $api->send("hello");
```

Send New Message With History
```php
$result = $api->send("hello");
$response = json_decode($result);
echo $api->send("What was my previous message?", $response->result->history);
```


<br/>

If this project is helpful to you, you may wish to give it a🌟
- TRX : ```TZ7zUPVnVTRnatn1JZtRQVAzfFfJ9xmjjQ```