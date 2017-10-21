<?php

namespace admin\controllers;


use admin\components\TinkoffAPI;
use admin\components\VkAPI;
use common\models\Application;
use common\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;

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

    public function actionAuth($access_token, $viewer_id, $viewer_type, $auth_key, $group_id = null, $is_app_user, $api_settings)
    {
        $ourAuthKey = md5(\Yii::$app->params['vk.appId'] . '_' . $viewer_id . '_' . \Yii::$app->params['vk.secretKey']);

        if ($ourAuthKey != $auth_key) {
            throw new ForbiddenHttpException('Отказано в доступе');
        }

        if ($group_id === null) {
            throw new BadRequestHttpException('Необходимо запустить приложение через сообщество');
        }

        $app = Application::findByGroupId($group_id);
        if (!$app) {
            $app = new Application();
            $app->vk_group_id = $group_id;
        }
        $app->access_token = $access_token;
        $app->save();

        $user = User::findByVkId($viewer_id);
        if (!$user) {
            $user = new User();
            $user->application_id = $app->id;
            $user->vk_user_id = $viewer_id;
            $user->generateAuthKey();
        }
        $user->role = $viewer_type;
        $user->save();

        \Yii::$app->user->login($user);

        if ($api_settings < 134217728) {
            \Yii::$app->session->setFlash('ask_market_permission');
        }

        return $this->redirect(['/setting/index']);
    }

    public function actionTest()
    {
        // $authToken = 'MY8f8-Jkt2eVM1A3bCus2WKvLdDjc2nwvMhnTlfWRbFZa36DMh8B4_ybJ_D3Plqc5WcWukVMDj7lbOdSou9uMQ';
        // $api = new TinkoffAPI($authToken, 1239537766);
        // var_dump($api->getInvoices());
        //$account, $buyer_name, $inn, $bank_name, $bank_location, $bic, $corr_account, $number, $priority, $payment_day
        // var_dump($api->createInvoice("40101810900000000974", "Hahaja", "770000000082", "Tinkoff bank", "Moscow street 1", "044525974", "30101810145250000974", 222, 1, "2017-11-19T23:59:59+03:00"));
        // var_dump($api->addProductToInvoice("82ef9efc-e63d-4cef-8d6c-ff4e9d6ec48b", "Банан", "16373746", "29", 2));
        // var_dump($api->addContactsToInvoice("82ef9efc-e63d-4cef-8d6c-ff4e9d6ec48b", "test2@mail.ru", "+79999933876"));
        // var_dump($api->sendInvoice("82ef9efc-e63d-4cef-8d6c-ff4e9d6ec48b"));
        $vk_auth_token = '9ff371d680c435f407a563bf9b4efeadfbf467f250e51045f467368ba5602bd493a6a397f4c481fb7b3bc';
        $vk_api = new VkAPI($vk_auth_token, 155258217);
        var_dump($vk_api->getProducts());
        // var_dump($vk_api->getLastDialogs(50));
    }

}

