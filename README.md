# Simple Telegram Message


Utils for send a simple message to telegram

## Install

Via Composer

``` bash
$ composer require jtrw/simple-telegram-message
```

## Usage SimpleTelegramMessage

```php
use Jtrw\SimpleTelegram\SimpleTelegramMessage;

$telegram = new SimpleTelegramMessage($token);

$telegram->sendMessage($idUser, $message);

```

## Testing

``` bash
$ composer test
```

