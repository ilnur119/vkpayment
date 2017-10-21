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
                    $model->bic, $model->corrInvoice, 222, 1, "2017-11-19T23:59:59+03:00");
                $invoiceId = $response['result']['id'];
                $api->addContactsToInvoice($invoiceId, $model->email, $model->phone);
                foreach ($model->carts as $cart) {
                    $product = $cart->product;
                    $api->addProductToInvoice($invoiceId, $product->title, $product->id, $product->price, 1);
                }
                var_dump($api->sendInvoice($invoiceId));
                \Yii::$app->session->setFlash('success','Счет успешно отправлен');
                //return $this->refresh();
            }
        }

        $products = \Yii::$app->user->identity->application->products;
        return $this->render('index', ['model' => $model, 'products' => $products]);
    }
}