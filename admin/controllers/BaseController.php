<?php

namespace admin\controllers;


use admin\components\TinkoffAPI;
use admin\components\VkAPI;
use common\models\Application;
use common\models\Product;
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

        if ($viewer_type < 3) {
            return $this->redirect(['/customer/index']);
        }

        if ($api_settings < 134217728) {
            \Yii::$app->session->setFlash('ask_market_permission');
        }

        return $this->redirect(['/setting/index']);
    }
}

