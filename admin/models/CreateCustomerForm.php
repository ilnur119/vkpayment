<?php

namespace admin\models;

use common\models\Customer;

class CreateCustomerForm extends \yii\base\Model
{
    public $name_bank;
    public $address_bank;
    public $bic;
    public $corr_invoice;

    private $customer;

    public function __construct(Customer $customer = null, array $config = [])
    {
        if ($customer !== null) {
            $this->name = $customer->name;
            $this->email = $customer->email;
            $this->phone = $customer->phone;
            $this->inn = $customer->inn;

            $this->customer = $customer;

            if ($this->is_link_vk) {
                $this->link_vk = $customer->vk_user_id;
            }
        }

        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['name', 'email', 'phone', 'inn'], 'string'],
            [['link_vk'], 'integer'],
        ];
    }

    public function saveSetting()
    {
        $customer = ($this->customer != null) ? $this->customer : new Customer();
        $customer->application_id = \Yii::$app->user->identity->application->id;
        if ($this->is_link_vk) {
            $customer->vk_user_id = $this->link_vk;
        }
        $customer->name = $this->name;
        $customer->email = $this->email;
        $customer->phone = $this->phone;
        $customer->inn = $this->inn;


        return $customer->save();
    }
}