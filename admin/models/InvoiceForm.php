<?php

namespace admin\models;

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
    public $name_bank;
    public $address_bank;
    public $bic;
    public $corrInvoice;

    public $customerAddress;

    public $product = [];

    public function rules()
    {
        return [
            [['name', 'email', 'phone', 'inn', 'link_vk'], 'string'],
            [['name_bank', 'address_bank', 'bic', 'corr_invoice'], 'string'],
        ];
    }

    public function saveForm()
    {
        $vkId = $this->prepareVkLink($this->linkVk);
        $customer = Customer::findByVkId($vkId);
        if (!$customer) {
            $customer = new Customer();
            $customer->vk_user_id = $vkId;
        }
        $customer->name = $this->name;
        $customer->email = $this->email;
        $customer->phone = $this->phone;
        $customer->inn = $this->inn;
        $customer->save();

        $order = new Order();
        $order->address = $this->customerAddress;
        $order->customer_id = $customer->id;
        $order->quantity = 1;
        $order->status = 'Дефолтное';
        $order->save();

        for ($i = 0; $i < 4; $i++) {
            $cart = new Cart();
            $cart->order_id = $order->save();
            $cart->product_id = $i;
            $cart->save();
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