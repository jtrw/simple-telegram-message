<?php
declare(strict_types=1);

namespace Jtrw\SimpleTelegram;

use Jtrw\SimpleTelegram\Exceptions\NotProcessableResponseException;
use Jtrw\SimpleTelegram\Exceptions\NotProcessableStatusTelegramException;
use Jtrw\SimpleTelegram\ValueObject\Message;

/**
 * Class SimpleTelegramMessage
 * @package Jtrw\SimpleTelegram
 */
class SimpleTelegramMessage implements SimpleTelegramMessageInterface
{
    protected const API_URL = "https://api.telegram.org";
    
    protected string $token;
    
    /**
     * SimpleTelegramMessage constructor.
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    } // end __construct
    
    /**
     * @param int $idUser
     * @param string $message
     * @return Message
     * @throws Exceptions\NotFoundResultException
     * @throws Exceptions\RuntimeResponseException
     * @throws NotProcessableResponseException
     * @throws NotProcessableStatusTelegramException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendMessage(int $idUser, string $message): Message
    {
        $url = $this->getSendUrl($idUser, $message);

        $response = $this->request($url);
        
        if (!$response) {
            throw new NotProcessableStatusTelegramException("Empty Telegram Request");
        }
    
        $contentData = $this->getResponseContentData($response);
        
        return new Message($contentData);
    } // end sendMessage
    
    /**
     * @param string $message
     * @param array $users
     * @return Message[]
     * @throws NotProcessableStatusTelegramException
     */
    public function sendBatch(string $message, array $users): array
    {
        $data = [];
        foreach ($users as $user) {
            $data[] = $this->sendMessage($user, $message);
        }
        
        return $data;
    } // end sendBatch
    
    /**
     * @param string $response
     * @return array
     * @throws NotProcessableResponseException
     */
    protected function getResponseContentData(string $response): array
    {
        try {
            $responseData = json_decode($response, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            throw new NotProcessableResponseException("Invalid json response: ".$response);
        }
    
        if (!$responseData) {
            throw new NotProcessableResponseException($response);
        }
        
        return $responseData;
    } // end getResponseContentData
    
    /**
     * @param int $idUser
     * @param string $message
     * @return string
     */
    protected function getSendUrl(int $idUser, string $message): string
    {
        return sprintf(
            "%s/bot%s/sendMessage?chat_id=%s&text=%s",
            static::API_URL,
            $this->token,
            $idUser,
            urlencode($message)
        );
    } // end getSendUrl
    
    protected function request(string $url, string $method = 'GET'): string
    {
        $opts = [
            "http" => [
                "method"        => $method,
                'ignore_errors' => true
            ]
        ];
        
        $context = stream_context_create($opts);
        
        return file_get_contents($url, false, $context);
    } // end request
}
