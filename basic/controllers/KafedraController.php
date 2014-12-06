<?php

namespace app\controllers;


class KafedraController extends \yii\web\Controller
{
    public function actions()
    {
        return [
            'page' => [
                'class' => 'yii\web\ViewAction',
            ],
        ];
    }

    public function actionContact()
    {
        return $this->render('contact');
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

}
