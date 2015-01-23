<?php

namespace app\controllers;

use Yii;
use app\models\Metodychky;
use app\models\search\MetodychkySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * MetodychkyController implements the CRUD actions for Metodychky model.
 */
class MetodychkyController extends Controller
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
						'actions' => ['create', 'update'],
						'roles' => ['moderator'],
					],
					[
						'allow' => true,
						'actions' => ['delete'],
						'roles' => ['admin'],
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
     * Lists all Metodychky models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MetodychkySearch();
        $dataProvider = new ActiveDataProvider([
            'query' => Metodychky::find()->where(['active'=>Metodychky::STATUS_ACTIVE])->orderBy('id DESC'),
            'pagination' => ['pageSize' => 10],
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Metodychky model.
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
     * Finds the Metodychky model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Metodychky the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Metodychky::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
