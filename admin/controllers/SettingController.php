<?php


namespace admin\controllers;


use yii\web\Controller;

class SettingController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}