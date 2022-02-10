# Simple Telegram Message [![Phpunit](https://github.com/jtrw/simple-telegram-message/workflows/PHP%20Composer/badge.svg)](https://github.com/jtrw/simple-telegram-message/actions)


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

