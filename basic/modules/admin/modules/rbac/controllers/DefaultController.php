<?php

namespace app\modules\admin\modules\rbac\controllers;

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
                        'allow'   => true,
                        'actions' => [ 'index' ],
                        'roles'   => [ 'admin' ],
                    ]
                ],
            ]
        ];
    }

    public function actionIndex()
    {
        return $this->render( 'index' );
    }
}
