<?php

namespace app\modules\conference\controllers;

use Yii;
use app\modules\conference\models\ConferenceArticle;
use app\modules\conference\models\ConferenceArticleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ConferenceArticleController implements the CRUD actions for ConferenceArticle model.
 */
class ConferenceArticleController extends Controller
{
    /**
     * Lists all ConferenceArticle models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ConferenceArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ConferenceArticle model.
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
     * Finds the ConferenceArticle model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ConferenceArticle the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ConferenceArticle::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
