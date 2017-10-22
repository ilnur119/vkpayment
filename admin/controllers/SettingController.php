<?php


namespace admin\controllers;


use admin\models\SettingForm;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class SettingController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

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