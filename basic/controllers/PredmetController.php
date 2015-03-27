<?php

namespace app\controllers;

use Yii;
use app\models\Predmet;
use app\models\search\PredmetSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;

/**
 * PredmetController implements the CRUD actions for Predmet model.
 */
class PredmetController extends Controller
{
    public $layout = 'static';
    /**
     * Lists all Predmet models.
     * @return mixed
     */
    public function actionIndex()
    {
        
        $searchModel = new PredmetSearch();
        $dataProvider = $searchModel->searchActive(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Predmet model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
	public function actionView($id)
	{
		$model = $this->findModel($id);
		if ($model->active == Predmet::STATUS_ACTIVE) {
			return $this->render('view', [
				'model' => $model,
			]);
		} else {
			throw new NotFoundHttpException('Запис не активний');
		}
	}

    
    /**
     * Finds the Predmet model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Predmet the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Predmet::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
