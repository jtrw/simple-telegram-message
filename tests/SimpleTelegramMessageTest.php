<?php declare(strict_types=1);

namespace Jtrw\SimpleTelegram\Test;

use Jtrw\SimpleTelegram\Exceptions\NotFoundResultException;
use Jtrw\SimpleTelegram\Exceptions\RuntimeResponseException;
use Jtrw\SimpleTelegram\SimpleTelegramMessage;
use Jtrw\SimpleTelegram\ValueObject\Message;

class SimpleTelegramMessageTest extends \PHPUnit\Framework\TestCase
{
    private $messageId = 1;
    
    /**
     * Test that true does in fact equal true
     */
    public function testSendMessageSuccess()
    {
        $mock = $this->getMockBuilder(SimpleTelegramMessage::class)
            ->setConstructorArgs(array("123"))
            ->onlyMethods(['request'])->getMock();
        
        $response = file_get_contents(__DIR__.'/Resources/response-ok.json');
        
        $mock->method('request')->will($this->returnValue($response));
        
        $result = $mock->sendMessage(123, "test");
        $this->assertInstanceOf(Message::class, $result);
        
        $this->assertEquals($this->messageId, $result->getMessageID());
    } // end testSendMessageSuccess
    
    public function testSendMessageError()
    {
        $mock = $this->getMockBuilder(SimpleTelegramMessage::class)
            ->setConstructorArgs(array("123"))
            ->onlyMethods(['request'])->getMock();
        
        $response = file_get_contents(__DIR__.'/Resources/response-error.json');
        
        $mock->method('request')->will($this->returnValue($response));
        
        try {
            $mock->sendMessage(123, "test");
            $this->fail("Test must be fail");
        } catch (\Exception $exp) {
            $this->assertInstanceOf(RuntimeResponseException::class, $exp);
        }
    } // end testSendMessageError
    
    public function testSendMessageEmptyBody()
    {
        $mock = $this->getMockBuilder(SimpleTelegramMessage::class)
            ->setConstructorArgs(array("123"))
            ->onlyMethods(['request'])->getMock();
        
        $response = file_get_contents(__DIR__.'/Resources/response-empty.json');
        
        $mock->method('request')->will($this->returnValue($response));
        
        try {
            $mock->sendMessage(123, "test");
            $this->fail("Test must be fail");
        } catch (\Exception $exp) {
            $this->assertInstanceOf(NotFoundResultException::class, $exp);
        }
    } // end testSendMessageError
    
    public function testSendMessageSuccessBatch()
    {
        $mock = $this->getMockBuilder(SimpleTelegramMessage::class)
            ->setConstructorArgs(array("123"))
            ->onlyMethods(['request'])->getMock();
        
        $response = file_get_contents(__DIR__.'/Resources/response-ok.json');
        
        $mock->method('request')->will($this->returnValue($response));
        
        $result = $mock->sendBatch("test", [1,2]);
        
        $this->assertIsArray($result);
        
        foreach ($result as $message) {
            $this->assertInstanceOf(Message::class, $message);
            $this->assertEquals($this->messageId, $message->getMessageID());
        }
    } // end testSendMessageSuccess
}
