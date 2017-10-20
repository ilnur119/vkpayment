<?php


namespace admin\controllers;


use yii\web\Controller;

class OrderController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}