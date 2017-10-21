<?php


namespace admin\components;


use yii\base\Component;
use yii\httpclient\Client;

class VkAPI extends Component
{
    const BASE_URL = 'https://api.vk.com/method';

    private $accessToken;
    private $client;

    public function __construct($accessToken, $inn, array $config = [])
    {
        $this->inn = $inn;
        $this->accessToken = $accessToken;
        $this->client = new Client(['baseUrl' => self::BASE_URL]);
        parent::__construct($config);
    }

}