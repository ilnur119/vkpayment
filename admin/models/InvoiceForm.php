<?php

namespace admin\models;

use admin\components\TinkoffAPI;
use common\models\ApplicationCustomer;
use common\models\Cart;
use common\models\Customer;
use common\models\Invoice;
use common\models\Order;

class InvoiceForm extends \yii\base\Model
{
    public $name;
    public $email;
    public $phone;
    public $inn;
    public $linkVk;
    public $isLinkVk;
    public $name_bank;
    public $address_bank;
    public $bic;
    public $corrInvoice;
    public $customerAddress;

    public $product = [];

    public $carts = [];

    public function rules()
    {
        return [
            [['name', 'phone', 'inn', 'linkVk', 'customerAddress'], 'string'],
            [['name', 'phone', 'inn', 'customerAddress'], 'required'],
            [['name_bank', 'address_bank', 'bic', 'corrInvoice'], 'string'],
            [['name_bank', 'address_bank', 'bic', 'corrInvoice'], 'required'],
            ['product', 'safe'],
            [['email'], 'email'],
        ];
    }

    public function sendInvoice()
    {
        $model =  $this;
        $app = \Yii::$app->user->identity->application;
        $api = new TinkoffAPI(\Yii::$app->params['tinkoff.accessToken'], $app->bank->inn);

        $response = $api->createInvoice(
            $app->bank->account,
            $model->name,
            $model->inn,
            $model->name_bank,
            $model->address_bank,
            $model->bic,
            $model->corrInvoice,
            222,
            1,
            "2017-11-19T23:59:59+03:00"
        );

        if (!isset($response['result'])) {
            return false;
        }

        $invoiceId = $response['result']['id'];

        if (!$api->addContactsToInvoice($invoiceId, $model->email, $model->phone)) {
            return false;
        }

        foreach ($model->carts as $cart) {
            $product = $cart->product;
            if (!$api->addProductToInvoice(
                $invoiceId,
                $product->title,
                $product->id,
                $product->price,
                1
            )) {
                return false;
            };
        }
        if (!$api->sendInvoice($invoiceId)) {
            return false;
        }

        return true;
    }

    public function saveForm()
    {
        $vkId = null;
        if ($this->linkVk) {
            $vkId = $this->prepareVkLink($this->linkVk);
        }
        $customer = Customer::findByVkId($vkId);
        if (!$customer) {
            $customer = new Customer();
            $customer->vk_user_id = $vkId;
            $customer->name = $this->name;
            $customer->email = $this->email;
            $customer->phone = $this->phone;
            $customer->inn = $this->inn;
            $customer->save();

            $applicationCustomer = new ApplicationCustomer();
            $applicationCustomer->application_id = \Yii::$app->user->identity->application->id;
            $applicationCustomer->customer_id = $customer->id;
            $applicationCustomer->save();
        } else {
            $customer->name = $this->name;
            $customer->email = $this->email;
            $customer->phone = $this->phone;
            $customer->inn = $this->inn;
            $customer->save();
        }


        $order = new Order();
        $order->application_id = \Yii::$app->user->identity->application->id;
        $order->address = $this->customerAddress;
        $order->customer_id = $customer->id;
        $order->quantity = 1;
        $order->status = 'Дефолтное';
        $order->save();

        foreach ($this->product as $ind => $product) {
           if (!$product) {
               continue;
            }
            $cart = new Cart();
            $cart->order_id = $order->id;
            $cart->product_id = $ind;
            $cart->save();
            $this->carts[] = $cart;
        }

        $invoice = new Invoice();
        $invoice->bank_address = $this->address_bank;
        $invoice->order_id = $order->id;
        $invoice->bank_address = $this->address_bank;
        $invoice->bic = $this->bic;
        $invoice->bank_name  = $this->name_bank;
        $invoice->corr_invoice = $this->corrInvoice;
        $invoice->save();

        return true;
    }

    private function prepareVkLink($vkLink)
    {
        $id = "";
        for ($i = strlen($vkLink) - 1; $i != 0 ; $i--) {
            if ($vkLink[$i] == '/') {
                break;
            }
            $id .= $vkLink[$i];
        }
        return strrev($id);
    }
}