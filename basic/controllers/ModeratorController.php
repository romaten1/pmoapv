<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use app\models\Message;
use app\models\Teacher;

class ModeratorController extends \yii\web\Controller
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
        $dataReceivedProvider = new ActiveDataProvider([
            'query' => Message::find()->limit('2')->received_messages(),
            'sort'=>[
                'defaultOrder'=>['id' => SORT_DESC],
            ],            
        ]);
        $dataOwnProvider = new ActiveDataProvider([
            'query' => Message::find()->limit('2')->own_messages(),
            'sort'=>[
                'defaultOrder'=>['id' => SORT_DESC],
            ],            
        ]);
        $teacher = Teacher::getTeacherByUserId(Yii::$app->user->id);
        $metodychky = $teacher->metodychky;        
        $predmet = $teacher->predmet;
        $news = $teacher->news;
        
        return $this->render('index', [
            'dataReceivedProvider' => $dataReceivedProvider,
            'dataOwnProvider' => $dataOwnProvider,
            'metodychky' => $metodychky,
            'predmet' => $predmet,
            'news' => $news,
            'teacher' => $teacher,
        ]);
    }

}
