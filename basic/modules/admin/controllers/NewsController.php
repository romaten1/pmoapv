<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\News;
use app\modules\admin\models\NewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Image\Box;
use Imagine\Image\Point;
use Imagine\Imagick\Imagine;
use Imagine\Image\ImageInterface;
use app\helpers\TransliterateHelper;
use yii\filters\AccessControl;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
{
    public function behaviors()
    {
        'access' => [
                'class' => AccessControl::className(),
                //'only' => ['admin', 'create', 'update', 'delete'], //only be applied to
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index','create', 'update', 'view', 'delete'],
                        'roles' => ['moderator'],
                    ]
                ],
            ],
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
            $model->image = UploadedFile::getInstance($model, 'image');
            if ($model->validate()) {                
                $image_name = Yii::$app->getSecurity()->generateRandomString(5)
                    .'_'.substr(TransliterateHelper::cyrillicToLatin($model->title), 0, 7);
                $image_full_name = $image_name . '.' . $model->image->extension;
                $model->image->saveAs(Yii::getAlias('@webroot/uploads/news/' . $image_full_name));
                $model->image = $image_full_name;
                //Make a thumbnails
                $path_from = Yii::getAlias('@webroot/uploads/news/' . $image_full_name);
                $path_to = Yii::getAlias('@webroot/uploads/news/thumbs/thumb_') . $image_full_name;
                $this->makeImage($path_from, $path_to, $desired_width = 120);
                //Make an image
                $path_from = Yii::getAlias('@webroot/uploads/news/' . $image_full_name);
                $path_to = Yii::getAlias('@webroot/uploads/news/') . $image_full_name;
                $this->makeImage($path_from, $path_to, $desired_width = 500);
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
                    $image_name = Yii::$app->getSecurity()->generateRandomString(5)
                        .'_'.substr(TransliterateHelper::cyrillicToLatin($model->title), 0, 7);
                    $image_full_name = $image_name . '.' . $model->image->extension;
                    $model->image->saveAs('uploads/news/' . $image_full_name);
                    $model->image = $image_full_name;
                    //Make a thumbnails
                    $path_from = Yii::getAlias('@webroot/uploads/news/' . $image_full_name);
                    $path_to = Yii::getAlias('@webroot/uploads/news/thumbs/thumb_') . $image_full_name;
                    $this->makeImage($path_from, $path_to, $desired_width = 120);
                    //Make an image
                    $path_from = Yii::getAlias('@webroot/uploads/news/' . $image_full_name);
                    $path_to = Yii::getAlias('@webroot/uploads/news/') . $image_full_name;
                    $this->makeImage($path_from, $path_to, $desired_width = 500);
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
        $model = $this->findModel($id);
        $model->active = News::STATUS_PASSIVE;
        $model->save();

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
    protected function makeImage($path_from, $path_to, $desired_width)
    {
        $imagine = new Imagine();
        $image = $imagine->open($path_from);
        $image_size = $image->getSize();
        $image_height = $image_size->getHeight();
        $image_width = $image_size->getWidth();
        $ratio = $image_width / $desired_width;
        $resizedHeight = $image_height / $ratio;
        $resizedWidth = $image_width / $ratio;
        $resized_image = $image->resize(new Box($resizedWidth, $resizedHeight));
        $options = array(
            'resolution-units' => ImageInterface::RESOLUTION_PIXELSPERINCH,
            'resolution-x' => 100,
            'resolution-y' => 200,
            'flatten' => false
        );
        $resized_image->save($path_to, $options);
    }
}
