<?php

namespace app\controllers;

use Yii;
use app\models\Message;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\helpers\HtmlPurifier;

/**
 * MessageController implements the CRUD actions for Message model.
 */
class MessageController extends Controller
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
                        'actions' => ['create'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'recieve','ownmessage', 'user-message'],
                        'roles' => ['@'],
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Message models.
     * @return mixed
     */
    public function actionIndex()    {
        
        $dataReceivedProvider = new ActiveDataProvider([
            'query' => Message::find()->received_messages(),
            'sort'=>[
                'defaultOrder'=>['id' => SORT_DESC],
            ],
            'pagination' => [
                'pageSize' => 10
            ]
        ]);

        return $this->render('index', [
            'dataReceivedProvider' => $dataReceivedProvider,
        ]);
    }  
    public function actionOwnmessage()
    {
        $dataOwnProvider = new ActiveDataProvider([
            'query' => Message::find()->own_messages(),
            'sort'=>[
                'defaultOrder'=>['id' => SORT_DESC],
            ],
            'pagination' => [
                'pageSize' => 10
            ]
        ]);
        return $this->render('ownmessage', [
            'dataOwnProvider' => $dataOwnProvider,            
        ]);
    }   

    /**
     * Creates a new Message model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Message();
        //($model);
        if ($model->load(Yii::$app->request->post())) {
            $model->author_id = Yii::$app->user->id;
	        $model->text =  HtmlPurifier::process($model->text);
	        if($model->save()) {
                return $this->redirect(['index', 'id' => $model->id]);
            }

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

	public function actionUserMessage($receiver_id)
	{
		$model = new Message();
		//($model);
		if ($model->load(Yii::$app->request->post())) {
			$model->author_id = Yii::$app->user->id;
			$model->receiver_id = $receiver_id;
			if($model->save()) {
				return $this->redirect(['index', 'id' => $model->id]);
			}

		} else {
			return $this->render('user_message', [
				'model' => $model,
				'receiver_id' => $receiver_id,
			]);
		}
	}

    /**
     * Deletes an existing Message model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionRecieve($id)
    {
        $model = $this->findModel($id);
        $model->recieved_at = time();
        Yii::info($this->id.' - '.$this->action->id.' - id: '.$model->id.' - user: '.\Yii::$app->user->id,'admin');
        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Message model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Message the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Message::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
