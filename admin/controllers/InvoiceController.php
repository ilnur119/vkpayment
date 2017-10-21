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

            if ($model->saveForm()) {

                /* @var $app Application */
                $app = \Yii::$app->user->identity->application;
                $api = new TinkoffAPI(\Yii::$app->params['tinkoff.accessToken'], $app->bank->inn);

                $response = $api->createInvoice($app->bank->account, $model->name, $model->inn, $model->name_bank, $model->address_bank,
                    $model->bic, $model->corrInvoice, 222, 1, date('Y-m-d H:i:sP', time() + 2592000));

                var_dump($response);

                \Yii::$app->session->setFlash('success','Счет успешно отправлен');
                //return $this->refresh();
            }
        }

        $products = \Yii::$app->user->identity->application->products;
        return $this->render('index', ['model' => $model, 'products' => $products]);
    }
}