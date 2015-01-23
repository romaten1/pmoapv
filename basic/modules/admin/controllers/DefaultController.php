<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use Yii;

class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['admin', 'create', 'update', 'delete'], //only be applied to
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['admin'],
                    ]
                ],
            ]
        ];
    }

    public function actionIndex()
    {
        Yii::info($this->id . ' - ' . $this->action->id . ' - id: admin\Index - user: ' . \Yii::$app->user->id, 'admin');
        return $this->render('index');
    }
}
