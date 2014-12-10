<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Metodychky;
use app\modules\admin\models\MetodychkySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * MetodychkyController implements the CRUD actions for Metodychky model.
 */
class MetodychkyController extends Controller
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
     * Lists all Metodychky models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MetodychkySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('admin', [
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
        return $this->render('viewAdmin', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Metodychky model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Metodychky();

        if ($model->load(Yii::$app->request->post())) {
        
        // Получаем массив данных по загружамых файлах
            if (isset($model->file)) {
                $model->file = UploadedFile::getInstance($model, 'file');
            }

            if ($model->validate()) {                
                if (isset($model->file)) {
                    $file_name = Yii::$app->getSecurity()->generateRandomString() ;
                    $file_full_name = $file_name . '.' . $model->file->extension;
                    $model->file->saveAs('uploads/metodychky/' . $file_full_name);
                    $model->file = $file_full_name;
                } 
                else {
                    $model->file = '0';
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
     * Updates an existing Metodychky model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $old_file = $model->file;
        if ($model->load(Yii::$app->request->post())) {
            if (isset($model->file)) {
                $model->file = UploadedFile::getInstance($model, 'file');
            }
            if ($model->validate()) {                
                if (isset($model->file)) {
                    $file_name = Yii::$app->getSecurity()->generateRandomString() ;
                    $file_full_name = $image_name . '.' . $model->file->extension;
                    $model->file->saveAs('uploads/metodychky/' . $file_full_name);
                    $model->file = $file_full_name;
                }
                else{
                   $model->file = $old_file;
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
     * Deletes an existing Metodychky model.
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
