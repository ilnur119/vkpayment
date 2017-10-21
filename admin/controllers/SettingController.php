<?php


namespace admin\controllers;


use admin\models\SettingForm;
use common\models\Bank;
use yii\web\Controller;

class SettingController extends BaseController
{
    public function actionIndex()
    {
        if ($bank = \Yii::$app->user->identity->application->bank) {
            $model = new SettingForm($bank);
        } else {
            $model = new SettingForm();
        }
        if ($model->load(\Yii::$app->request->post())) {
            if ($model->saveSetting()) {
                \Yii::$app->session->setFlash('success','Настройки успешно сохраены');
                return $this->refresh();
            }
        }
        return $this->render('index', ['model' => $model]);
    }
}