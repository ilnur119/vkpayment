<?php


namespace admin\controllers;


use yii\web\Controller;

class CustomerController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}