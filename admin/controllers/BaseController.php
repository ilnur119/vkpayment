<?php

namespace admin\controllers;


use admin\components\TinkoffAPI;
use common\models\Application;
use common\models\User;
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

    public function actionAuth($group_id, $access_token, $viewer_id, $viewer_type, $auth_key, $is_app_user, $api_settings)
    {
        $ourAuthKey = md5(\Yii::$app->params['vk.appId'] . '_' . $viewer_id . '_' . \Yii::$app->params['vk.secretKey']);

        if ($ourAuthKey != $auth_key) {
            throw new ForbiddenHttpException('Отказано в доступе');
        }

        $app = Application::findByGroupId($group_id);
        if (!$app) {
            $app = new Application();
            $app->vk_group_id = $group_id;
            $app->access_token = $access_token;
            $app->save();
        }

        $user = User::findByVkId($viewer_id);
        if (!$user) {
            $user = new User();
            $user->setAttributes([
                'application_id' => $app->id,
                'vk_user_id' => $viewer_id,
                'role' => $viewer_type,
            ]);
            $user->generateAuthKey();
            $user->save();
        }
        \Yii::$app->user->login($user);
        return $this->redirect(['/setting/index']);
    }

    public function actionTest()
    {
        $authToken = '4FX6SB6Gem7hExCqNalHXb0nwMjF8SbgbBmn8i7YOVf4aNKaaoqsdp748WqmM9r4L1u-PFASDsUA9Sm3NtuYjQ';
        $api = new TinkoffAPI($authToken, 1239537766);
        var_dump($api->getInvoices());
    }

}