<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\News;
use app\modules\admin\models\NewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('admin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single News model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('viewAdmin', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new News();

        if ($model->load(Yii::$app->request->post())) {
        
        // Получаем массив данных по загружамых файлах
            
            if (isset($model->file)) {
                $model->image = UploadedFile::getInstance($model, 'image');
            }
            if ($model->validate()) {                
                if (isset($model->file)) {
                    $image_name = Yii::$app->getSecurity()->generateRandomString() ;
                    $image_full_name = $image_name . '.' . $model->image->extension;
                    $model->image->saveAs('uploads/news/' . $image_full_name);
                    $model->image = $image_full_name;
                } 
                else {
                    $model->image = '0';
                }    
            }
            if($model->save()){
                return $this->redirect(['view', 'id'=>$model->id]);
            } else {
                throw new NotFoundHttpException('Не удалось загрузить данные');
            }      
        } else {
            return $this->render('create', [
                'model' => $model,
                ]);
        }   
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $old_image = $model->image;
        if ($model->load(Yii::$app->request->post())) {
            if (isset($model->image)) {
                $model->image = UploadedFile::getInstance($model, 'image');
            }
            if ($model->validate()) {                
                if (isset($model->image)) {
                    $image_name = Yii::$app->getSecurity()->generateRandomString() ;
                    $image_full_name = $image_name . '.' . $model->image->extension;
                    $model->image->saveAs('uploads/news/' . $image_full_name);
                    $model->image = $image_full_name;
                }
                else{ 
                   $model->image = $old_image;
                }

            }
            if($model->save()){
                return $this->redirect(['view', 'id'=>$model->id]);
            } else {
                throw new NotFoundHttpException('Не удалось загрузить данные');
            }      
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing News model.
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
