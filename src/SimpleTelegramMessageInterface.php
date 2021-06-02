<?php
declare(strict_types=1);

namespace Jtrw\SimpleTelegram;

use Jtrw\SimpleTelegram\ValueObject\Message;

interface SimpleTelegramMessageInterface
{
    public function sendMessage(int $idUser, string $message): Message;
    public function sendBatch(string $message, array $users): array;
}
