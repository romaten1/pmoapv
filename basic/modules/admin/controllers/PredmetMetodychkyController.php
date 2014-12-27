<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\PredmetMetodychky;
use app\modules\admin\models\PredmetMetodychkySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * PredmetMetodychkyController implements the CRUD actions for PredmetMetodychky model.
 */
class PredmetMetodychkyController extends Controller
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
                        'actions' => ['index', 'create', 'update', 'view', 'delete'],
                        'roles' => ['moderator'],
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
     * Lists all PredmetMetodychky models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PredmetMetodychkySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PredmetMetodychky model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PredmetMetodychky model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PredmetMetodychky();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::info($this->id.' - '.$this->action->id.' - id: '.$model->id.' - user: '.\Yii::$app->user->id,'admin');
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PredmetMetodychky model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::info($this->id.' - '.$this->action->id.' - id: '.$model->id.' - user: '.\Yii::$app->user->id,'admin');
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PredmetMetodychky model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::info($this->id.' - '.$this->action->id.' - id: '.$model->id.' - user: '.\Yii::$app->user->id,'admin');
        return $this->redirect(['index']);
    }

    /**
     * Finds the PredmetMetodychky model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PredmetMetodychky the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PredmetMetodychky::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
