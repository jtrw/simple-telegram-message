# Simple Telegram Message 

[![Phpunit](https://github.com/jtrw/simple-telegram-message/workflows/PHP%20Composer/badge.svg)](https://github.com/jtrw/simple-telegram-message/actions)
[![codecov](https://codecov.io/gh/jtrw/simple-telegram-message/branch/master/graph/badge.svg?token=UADT3RAW2A)](https://codecov.io/gh/jtrw/simple-telegram-message)
[![Latest Stable Version](http://poser.pugx.org/jtrw/simple-telegram-message/v)](https://packagist.org/packages/jtrw/simple-telegram-message) [![Total Downloads](http://poser.pugx.org/jtrw/simple-telegram-message/downloads)](https://packagist.org/packages/jtrw/simple-telegram-message) [![Latest Unstable Version](http://poser.pugx.org/jtrw/simple-telegram-message/v/unstable)](https://packagist.org/packages/jtrw/simple-telegram-message) [![License](http://poser.pugx.org/jtrw/simple-telegram-message/license)](https://packagist.org/packages/jtrw/simple-telegram-message) [![PHP Version Require](http://poser.pugx.org/jtrw/simple-telegram-message/require/php)](https://packagist.org/packages/jtrw/simple-telegram-message)


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

