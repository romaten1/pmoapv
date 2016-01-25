<?php

namespace app\controllers;

use app\models\ChatMessage;
use app\models\Teacher;
use Yii;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\helpers\HtmlPurifier;

class ChatController extends \yii\web\Controller
{
    public $layout = 'moderator';
    
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
                        'roles' => ['moderator'],
                    ]
                ],
            ],
        ];
    }
    
    public function actionIndex()
    {
        $teacher = Teacher::getTeacherByUserId(Yii::$app->user->id);
        $dataChatMessageProvider = new ActiveDataProvider([
            'query' => ChatMessage::find(),
            'sort'=>[
                'defaultOrder'=>['id' => SORT_DESC],
            ],
            'pagination' => [
                'pagesize' => 25,
            ],
        ]);
        $model = new ChatMessage();
        if ($model->load(Yii::$app->request->post())) {
            $model->chat_id = 1;
            $model->user_id = Yii::$app->user->id;
            $model->message =  HtmlPurifier::process($model->message);
            if($model->save()) {
                return $this->redirect(['index']);
            }

        }
        return $this->render('index', [
            'dataChatMessageProvider' => $dataChatMessageProvider,
            'teacher' => $teacher,
            'model' => $model,
        ]);
    }

}
