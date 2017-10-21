<?php
/**
 * Created by IntelliJ IDEA.
 * User: ilnur
 * Date: 20.10.17
 * Time: 11:21
 */

namespace admin\controllers;

use admin\models\CreateInvoiceForm;


class InvoiceController extends BaseController
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
                \Yii::$app->session->setFlash('success','Success okay');
                return $this->refresh();
            }
        }
        return $this->render('index', ['model' => $model]);
    }
}