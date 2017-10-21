<?php

namespace admin\models;

use common\models\Invoice;

class CreateInvoiceForm extends \yii\base\Model
{
    public $name_bank;
    public $address_bank;
    public $bic;
    public $corr_invoice;

    private $invoice;

    public function __construct(Invoice $invoice = null, array $config = [])
    {
        if ($invoice !== null) {
            $this->name_bank = $invoice->bank_name;
            $this->address_bank = $invoice->bank_address;
            $this->bic = $invoice->bic;
            $this->corr_invoice = $invoice->corr_invoice;
            $this->invoice = $invoice;
        }

        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['name_bank', 'address_bank', 'bic', 'corr_invoice'], 'string'],
        ];
    }

    public function saveSetting()
    {
        $invoice = ($this->invoice != null) ? $this->invoice : new Invoice();
        $invoice->application_id = \Yii::$app->user->identity->application->id;
        $invoice->bank_name = $this->name_bank;
        $invoice->address_bank = $this->address_bank;
        $invoice->bic = $this->bic;
        $invoice->corr_invoice = $this->corr_invoice;


        return $invoice->save();
    }
}