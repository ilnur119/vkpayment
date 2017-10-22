<?php


namespace admin\controllers;

use admin\components\TinkoffAPI;
use admin\models\InvoiceForm;
use common\models\Application;


class InvoiceController extends BaseController
{
    public function actionIndex()
    {

        $model = new InvoiceForm();

        if ($model->load(\Yii::$app->request->post())) {
            if ($model->saveForm() && $model->sendInvoice()) {
                /* @var $app Application */
                \Yii::$app->session->setFlash('success','Счет успешно отправлен');
                return $this->refresh();
            } else {
                \Yii::$app->session->setFlash('error','При оформлении счета возникла ошибка');
            }
        }

        $products = \Yii::$app->user->identity->application->products;
        return $this->render('index', ['model' => $model, 'products' => $products]);
    }
}