<?php

namespace app\controllers;

use Yii;
use app\models\Metodychky;
use app\models\MetodychkySearch;
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

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAdmin()
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
            $file = UploadedFile::getInstance($model, 'file');
            if(isset($file)){
                $filename = $file->name;
                $ext = end((explode(".", $file->name)));
                // Генерируем уникальное имя файла
                $model->file = Yii::$app->getSecurity()->generateRandomString(). '.' .$ext;
                // Путь к папке где будет хранится файл
                $path = Yii::$app->basePath . 'web/uploads/metod/' . $model->file;
                
            }
            
            if($model->save()){
                if(isset($file)){
                    // Сохраняем рисунок
                    $file->saveAs($path);
                }
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
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
