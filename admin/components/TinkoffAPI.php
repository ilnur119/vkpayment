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
            ->post('invoice/outgoing', $data)
            ->setFormat(Client::FORMAT_JSON)
            ->addHeaders(['Authorization' => "Bearer {$this->accessToken}"])
            ->send();

        if ($response->getIsOk()) {
            return $response->data;
        } else {
            return $response;
        }
    }

    public function addContactsToInvoice($invoice_id, $email, $phone) {
        $data = [$email, $phone];
        $response = $this->client
            ->post("invoice"."/$invoice_id"."/contacts", $data)
            ->setFormat(Client::FORMAT_JSON)
            ->addHeaders(['Authorization' => "Bearer {$this->accessToken}"])
            ->send();

        if ($response->getIsOk()) {
            return $response->data;
        } else {
            return $response;
        }
    }

    public function addProductToInvoice($invoice_id, $name, $prdouct_id, $price, $count) {
        $data = [
            'name' => $name,
            'price' => $price,
            'unit' => 'шт',
            'sku' => $prdouct_id,
            'vat' => "0",
            'amount' => $count
        ];

        $response = $this->client
            ->put("invoice/outgoing"."/$invoice_id"."/item"."/$prdouct_id", $data)
            ->setFormat(Client::FORMAT_JSON)
            ->addHeaders(['Authorization' => "Bearer {$this->accessToken}"])
            ->send();

        if ($response->getIsOk()) {
            return $response->data;
        } else {
            return $response;
        }
    }

    public function sendInvoice($invoice_id) {
        $response = $this->client
            ->post("invoice/outgoing"."/$invoice_id"."/send")
            ->setFormat(Client::FORMAT_JSON)
            ->addHeaders(['Authorization' => "Bearer {$this->accessToken}"])
            ->send();

        if ($response->getIsOk()) {
            return $response->data;
        } else {
            return $response;
        }
    }
}