<?php

namespace app\controllers;

use Yii;
use app\models\TeacherNews;
use app\models\search\TeacherNewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;

/**
 * TeacherNewsController implements the CRUD actions for TeacherNews model.
 */
class TeacherNewsController extends Controller
{
    public $layout = 'static';
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['admin', 'create', 'update', 'delete'], //only be applied to
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create', 'update',  'delete'],
                        'roles' => ['moderator'],
                    ],                    
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
     * Lists all TeacherNews models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TeacherNewsSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => TeacherNews::find()->where(['active'=>TeacherNews::STATUS_ACTIVE]),
            'pagination' => ['pageSize' => 15],
        ]);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

	/**
	* @throws NotFoundHttpException
	*/
	public function actionView($id)
	{
		$model = $this->findModel($id);
		if ($model->active == TeacherNews::STATUS_ACTIVE) {
			return $this->render('view', [
				'model' => $model,
			]);
		} else {
			throw new NotFoundHttpException('Запис не активний');
		}
	}

    /**
     * Creates a new TeacherNews model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TeacherNews();
        $model->teacher_id = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TeacherNews model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */

	public function actionUpdate($id)
    {
	    if (\Yii::$app->user->can('updateTeacherNews', ['teacherNews_id' => $id])) {
	        $model = $this->findModel($id);

	        if ($model->load(Yii::$app->request->post()) && $model->save()) {
	            return $this->redirect(['index']);
	        } else {
	            return $this->render('update', [
	                'model' => $model,
	            ]);
	        }
	    }
	    else {
		    throw new NotFoundHttpException('Ви не маєте права виконувати цю дію');
	    }
    }

    /**
     * Deletes an existing TeacherNews model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TeacherNews model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TeacherNews the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TeacherNews::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
