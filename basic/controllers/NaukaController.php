<?php

namespace app\controllers;

class NaukaController extends \yii\web\Controller
{
    public function actions()
    {
        return [
            'page' => [
                'class' => 'yii\web\ViewAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

}
