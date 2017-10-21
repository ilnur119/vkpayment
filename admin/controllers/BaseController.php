<?php

namespace admin\controllers;


use admin\components\TinkoffAPI;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class BaseController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return parent::behaviors();
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionTest()
    {
        $authToken = '4FX6SB6Gem7hExCqNalHXb0nwMjF8SbgbBmn8i7YOVf4aNKaaoqsdp748WqmM9r4L1u-PFASDsUA9Sm3NtuYjQ';
        $api = new TinkoffAPI($authToken, 1239537766);
        var_dump($api->getInvoices());
    }

}