<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\conference\models\ConferenceArticle;
use app\modules\conference\models\ConferenceArticleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\helpers\TransliterateHelper;
use yii\filters\AccessControl;

/**
 * ConferenceArticleController implements the CRUD actions for ConferenceArticle model.
 */
class ConferenceArticleController extends Controller
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
				        'actions' => ['index', 'create', 'view', 'delete', 'update'],
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
     * Creates a new ConferenceArticle model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionCreate()
    {
	    $model = new ConferenceArticle();
	    $statusArray = ConferenceArticle::getStatusArray();
	    if ($model->load(Yii::$app->request->post())) {

		    // Получаем массив данных по загружамых файлах
		    if (isset($model->file)) {
			    $model->file = UploadedFile::getInstance($model, 'file');
		    }
		    if (isset($model->file)) {
			    $file_name = Yii::$app->getSecurity()->generateRandomString(5)
			                 . '_' . substr(TransliterateHelper::cyrillicToLatin($model->title), 0, 7);
			    $file_full_name = $file_name . '.' . $model->file->extension;
			    //$model->size = $model->file->size;
			    $model->file->saveAs('uploads/conference/' . $file_full_name);
			    $model->file = $file_full_name;
		    }
		    else {
			    $model->file = '0';
			    //$model->size = '0';
		    }
		    if ($model->validate() && $model->save()) {
			    Yii::info($this->id . ' - ' . $this->action->id . ' - id: ' . $model->id . ' - user: ' . \Yii::$app->user->id, 'admin');
			    return $this->redirect(['view', 'id' => $model->id]);
		    } else {
			    throw new NotFoundHttpException('Не удалось загрузить данные');
		    }
	    } else {
		    return $this->render('create', [
			    'model' => $model,
			    'statusArray' => $statusArray,
		    ]);
	    }
    }

    /**
     * Updates an existing ConferenceArticle model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);
		$statusArray = ConferenceArticle::getStatusArray();
		$old_file = $model->file;
		//$old_size = $model->size;
		if ($model->load(Yii::$app->request->post())) {
			if (isset($model->file)) {
				$model->file = UploadedFile::getInstance($model, 'file');
			}
			if (isset($model->file)) {
				$file_name = Yii::$app->getSecurity()->generateRandomString(5)
				             . '_' . substr(TransliterateHelper::cyrillicToLatin($model->title), 0, 7);
				$file_full_name = $file_name . '.' . $model->file->extension;
				//$model->size = $model->file->size;
				$model->file->saveAs('uploads/conference/' . $file_full_name);
				$model->file = $file_full_name;
			}
			else {
				$model->file = $old_file;
				//$model->size = $old_size;
			}
			if ($model->validate() && $model->save()) {
				Yii::info($this->id . ' - ' . $this->action->id . ' - id: ' . $model->id . ' - user: ' . \Yii::$app->user->id, 'admin');
				return $this->redirect(['view', 'id' => $model->id]);
			} else {
				throw new NotFoundHttpException('Не удалось загрузить данные');
			}
		} else {
			return $this->render('update', [
				'model' => $model,
				'statusArray' => $statusArray,
			]);
		}
	}

    /**
     * Deletes an existing ConferenceArticle model.
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
