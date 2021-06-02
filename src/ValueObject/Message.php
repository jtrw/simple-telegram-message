<?php
declare(strict_types=1);

namespace Jtrw\SimpleTelegram\ValueObject;

use Jtrw\SimpleTelegram\Exceptions\NotFoundResultException;
use Jtrw\SimpleTelegram\Exceptions\RuntimeResponseException;

/**
 * Class Message
 * @package Jtrw\SimpleTelegram\ValueObject
 */
class Message
{
    protected array $values;
    protected int $messageID;
    protected string $text;
    protected int $date;
    
    /**
     * Message constructor.
     * @param array $values
     * @throws NotFoundResultException
     * @throws RuntimeResponseException
     */
    public function __construct(array $values)
    {
        if (empty($values['ok']) || !$values['ok']) {
            throw new RuntimeResponseException();
        }
        
        if (empty($values['result'])) {
            throw new NotFoundResultException();
        }
    
        $this->values = $values;
        
        if (!empty($values['result']['message_id'])) {
            $this->messageID = $values['result']['message_id'];
        }
        
        if (!empty($values['result']['text'])) {
            $this->text = $values['result']['text'];
        }
    
        if (!empty($values['result']['date'])) {
            $this->date = $values['result']['date'];
        }
    } // end __construct
    
    /**
     * @return int
     */
    public function getMessageID(): int
    {
        return $this->messageID;
    } // end getMessageID
    
    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    } // end getText
    
    /**
     * @return int
     */
    public function getDate(): int
    {
        return $this->date;
    } // end getDate
    
    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->values;
    } // end toArray
}
