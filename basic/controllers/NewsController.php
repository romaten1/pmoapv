<?php

namespace app\controllers;

use Yii;
use app\models\News;
use app\models\search\NewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
{
    public $layout = 'static';
    /**
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {
	    $searchModel = new NewsSearch();
	    $dataProvider = $searchModel->searchActive(Yii::$app->request->queryParams);

	    return $this->render('index', [
		    'searchModel' => $searchModel,
		    'dataProvider' => $dataProvider,
	    ]);
    }

    /**
     * Displays a single News model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
	public function actionView($id)
	{
		$model = $this->findModel($id);
		if ($model->active == News::STATUS_ACTIVE) {
			return $this->render('view', [
				'model' => $model,
			]);
		} else {
			throw new NotFoundHttpException('Запис не активний');
		}
	}

    
    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
