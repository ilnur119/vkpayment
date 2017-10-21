<?php


namespace admin\controllers;

use admin\models\InvoiceForm;


class InvoiceController extends BaseController
{
    public function actionIndex()
    {

        $model = new InvoiceForm();

        if ($model->load(\Yii::$app->request->post())) {
            if ($model->saveForm()) {
                \Yii::$app->session->setFlash('success','Счет успешно отправлен');
                return $this->refresh();
            }
        }
        return $this->render('index', ['model' => $model]);
    }
}