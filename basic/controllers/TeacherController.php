<?php

namespace app\controllers;

use Yii;
use app\models\Teacher;
use app\models\search\TeacherSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;

/**
 * TeacherController implements the CRUD actions for Teacher model.
 */
class TeacherController extends Controller
{
    public $layout = 'static';
    /**
     * Lists all Teacher .
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TeacherSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => Teacher::find()->where(['active'=>Teacher::STATUS_ACTIVE])
	            ->where(['teach_or_master'=>Teacher::STATUS_TEACHER]),
            'pagination' => ['pageSize' => 10],
        ]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	/**
	 * Lists all Master .
	 * @return mixed
	 */
	public function actionMaster()
	{
		$searchModel = new TeacherSearch();
		$dataProvider = new ActiveDataProvider([
			'query' => Teacher::find()->where(['active'=>Teacher::STATUS_ACTIVE])
				->where(['teach_or_master'=>Teacher::STATUS_MASTER]),
			'pagination' => ['pageSize' => 10],
		]);
		return $this->render('masters', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

    
    /**
     * Displays a single Teacher model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
	public function actionView($id)
	{
		$model = $this->findModel($id);
		if ($model->active == Teacher::STATUS_ACTIVE) {

			if ($model->teach_or_master == Teacher::STATUS_TEACHER) {
				return $this->render('view', [
					'model' => $model,
				]);
			}
			else {
				return $this->render('viewMaster', [
					'model' => $model,
				]);
			}
		} else {
			throw new NotFoundHttpException('Запис не активний');
		}
	}



    

    /**
     * Finds the Teacher model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Teacher the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Teacher::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
