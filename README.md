# Simple Telegram Message 

[![Phpunit](https://github.com/jtrw/simple-telegram-message/workflows/PHP%20Composer/badge.svg)](https://github.com/jtrw/simple-telegram-message/actions)

[![Coverage Status](https://coveralls.io/repos/github/jtrw/simple-telegram-message/badge.svg?branch=master)](https://coveralls.io/github/jtrw/simple-telegram-message?branch=master)


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

