<?php

namespace admin\components;

use yii\base\Component;
use yii\httpclient\Client;

class TinkoffAPI extends Component
{

    const BASE_URL = 'https://openapi.tinkoff.ru/invoicing/api/v1/partner/company';

    private $accessToken;
    private $client;
    private $inn;

    public function __construct($accessToken, $inn, array $config = [])
    {
        $this->inn = $inn;
        $this->accessToken = $accessToken;
        $this->client = new Client(['baseUrl' => self::BASE_URL."/$inn"]);
        parent::__construct($config);
    }

    public function getInvoices()
    {
        $response = $this->client
            ->get('invoice/outgoing')
            ->addHeaders(['Authorization' => "Bearer {$this->accessToken}"])
            ->send();

        if ($response->getIsOk()) {
            return $response->data;
        }
        return null;
     }

     public function createInvoice($account, $buyer_name, $inn, $bank_name, $bank_location, $bic, $corr_account, $number, $priority, $payment_day) {
        $data = [
            'seller' => ['account' => $account, 'bank' => []],
            'buyer' => [
                'name' => $buyer_name,
                'inn' => $inn,
                'bank' => [
                    'name' => $bank_name,
                    'location' => $bank_location,
                    'bic' => $bic,
                    'corrAccount' => $corr_account
                ]
            ],
            'number' => $number,
            'priority' => $priority,
            'categories' => [],
            'payment' => ['dueDate'  => $payment_day]
        ];

        $response = $this->client
            ->post('invoice/outgoing',['body' => json_encode($data)])
            ->addHeaders(['Authorization' => "Bearer {$this->accessToken}"])
            ->send();

        if ($response->getIsOk()) {
            return $response->data;
        }
        return null;
     }
}