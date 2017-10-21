<?php

namespace admin\models;
use common\models\Bank;

class SettingForm extends \yii\base\Model
{
    public $inn;
    public $account;
    private $bank;

    public function __construct(Bank $bank = null, array $config = [])
    {
        if ($bank !== null) {
            $this->inn = $bank->inn;
            $this->account = $bank->account;
            $this->bank = $bank;
        }

        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['inn', 'account'], 'string']
        ];
    }

    public function saveSetting()
    {
        $bank = ($this->bank != null) ? $this->bank : new Bank();
        $bank->application_id = \Yii::$app->user->identity->application->id;
        $bank->inn = $this->inn;
        $bank->account = $this->account;

        return $bank->save();
    }
}