<?php


namespace admin\components;


use yii\base\Component;
use yii\httpclient\Client;

class VkAPI extends Component
{
    const BASE_URL = 'https://api.vk.com/method';

    private $accessToken;
    private $client;
    private $group_id;
    private $version = 5.68;

    public function __construct($accessToken, $group_id, array $config = [])
    {
        $this->group_id = $group_id;
        $this->accessToken = $accessToken;
        $this->client = new Client(['baseUrl' => self::BASE_URL]);
        parent::__construct($config);
    }

    public function getProducts() {
        $album_id = 0;
        $count = 200;
        $response = $this->client
            ->get('market.get',['v'=>$this->version, 'access_token' => $this->accessToken, 'owner_id' => "-$this->group_id", 'album_id' => $album_id, 'count' => $count])
            ->send();

        if ($response->getIsOk()) {
            return $response->data;
        }
        return null;
    }

    public function getLastDialogs($count) {
        $response = $this->client
            ->get('messages.getDialogs',['v'=>$this->version, 'access_token' => $this->accessToken, 'count' => $count])
            ->send();

        if ($response->getIsOk()) {
            return $response->data;
        }
        return null;
    }

    public function sendMessage($chat_id, $massage) {
        $response = $this->client
            ->post('messages.getDialogs',['v'=>$this->version, 'access_token' => $this->accessToken, 'chat_id' => $chat_id, 'message' => $message])
            ->send();

        if ($response->getIsOk()) {
            return $response->data;
        }
        return null;
    }

}