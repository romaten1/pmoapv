<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\News;
use app\models\search\NewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Imagine\Image\Box;
use Imagine\Image\Point;
use Imagine\Gd\Imagine;
use Imagine\Image\ImageInterface;
use app\helpers\TransliterateHelper;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
{
    public function behaviors()
    {

        return [
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['admin', 'create', 'update', 'delete'], //only be applied to
                'rules' => [
                    [
                        'allow'   => true,
                        'actions' => [ 'index', 'create', 'update', 'view', 'delete' ],
                        'roles'   => [ 'admin' ],
                    ]
                ],
            ],
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => [ 'post' ],
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

        $searchModel  = new NewsSearch();
        $dataProvider = new ActiveDataProvider( [
            'query'      => News::find()->orderBy( 'updated_at DESC' ),
            'pagination' => [ 'pageSize' => 15 ],
        ] );

        return $this->render( 'admin', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ] );
    }

    /**
     * Displays a single News model.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionView( $id )
    {
        return $this->render( 'viewAdmin', [
            'model' => $this->findModel( $id ),
        ] );
    }

    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionCreate()
    {
        $model = new News();
        // Получаем массив данных по загружамых файлах
        if ($model->load( Yii::$app->request->post() )) {
            if (isset( $model->image )) {
                $model->image = UploadedFile::getInstance( $model, 'image' );
            }
            if (isset( $model->image )) {
                $image_name      = Yii::$app->getSecurity()->generateRandomString( 5 )
                                   . '_' . substr( TransliterateHelper::cyrillicToLatin( $model->title ), 0, 7 );
                $image_full_name = $image_name . '.' . $model->image->extension;
                $model->image->saveAs( Yii::getAlias( '@webroot/uploads/news/' . $image_full_name ) );
                $model->image = $image_full_name;
                //Make a thumbnails
                $path_from = Yii::getAlias( '@webroot/uploads/news/' . $image_full_name );
                $path_to   = Yii::getAlias( '@webroot/uploads/news/thumbs/thumb_' ) . $image_full_name;
                $this->makeImage( $path_from, $path_to, $desired_width = 120 );
                //Make an image
                $path_from = Yii::getAlias( '@webroot/uploads/news/' . $image_full_name );
                $path_to   = Yii::getAlias( '@webroot/uploads/news/' ) . $image_full_name;
                $this->makeImage( $path_from, $path_to, $desired_width = 500 );
            } else {
                $model->image = false;
            }
            if ($model->validate() && $model->save()) {
                Yii::info( $this->id . ' - ' . $this->action->id . ' - id: ' . $model->id . ' - user: ' . \Yii::$app->user->id,
                    'admin' );
                return $this->redirect( [ 'view', 'id' => $model->id ] );
            } else {
                throw new NotFoundHttpException( 'Не удалось загрузить данные' );
            }
        } else {
            return $this->render( 'create', [
                'model' => $model,
            ] );
        }
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param $id
     *
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate( $id )
    {
        $model     = $this->findModel( $id );
        $old_image = $model->image;
        if ($model->load( Yii::$app->request->post() )) {
            if (isset( $model->image )) {
                $model->image = UploadedFile::getInstance( $model, 'image' );
            }

            if (isset( $model->image )) {
                $image_name      = Yii::$app->getSecurity()->generateRandomString( 5 )
                                   . '_' . substr( TransliterateHelper::cyrillicToLatin( $model->title ), 0, 7 );
                $image_full_name = $image_name . '.' . $model->image->extension;
                $model->image->saveAs( 'uploads/news/' . $image_full_name );
                $model->image = $image_full_name;
                //Make a thumbnails
                $path_from = Yii::getAlias( '@webroot/uploads/news/' . $image_full_name );
                $path_to   = Yii::getAlias( '@webroot/uploads/news/thumbs/thumb_' ) . $image_full_name;
                $this->makeImage( $path_from, $path_to, $desired_width = 120 );
                //Make an image
                $path_from = Yii::getAlias( '@webroot/uploads/news/' . $image_full_name );
                $path_to   = Yii::getAlias( '@webroot/uploads/news/' ) . $image_full_name;
                $this->makeImage( $path_from, $path_to, $desired_width = 500 );
            } else {
                $model->image = $old_image;
            }


            if ($model->validate() && $model->save()) {
                Yii::info( $this->id . ' - ' . $this->action->id . ' - id: ' . $model->id . ' - user: ' . \Yii::$app->user->id,
                    'admin' );
                return $this->redirect( [ 'view', 'id' => $model->id ] );
            } else {
                throw new NotFoundHttpException( 'Не удалось загрузить данные' );
            }
        } else {
            return $this->render( 'update', [
                'model' => $model,
            ] );
        }
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionDelete( $id )
    {
        $model         = $this->findModel( $id );
        $model->active = News::STATUS_PASSIVE;
        Yii::info( $this->id . ' - ' . $this->action->id . ' - id: ' . $id . ' - user: ' . \Yii::$app->user->id,
            'admin' );
        $model->save();

        return $this->redirect( [ 'index' ] );
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel( $id )
    {
        if (( $model = News::findOne( $id ) ) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException( 'The requested page does not exist.' );
        }
    }

    protected function makeImage( $path_from, $path_to, $desired_width )
    {
        $imagine       = new Imagine();
        $image         = $imagine->open( $path_from );
        $image_size    = $image->getSize();
        $image_height  = $image_size->getHeight();
        $image_width   = $image_size->getWidth();
        $ratio         = $image_width / $desired_width;
        $resizedHeight = $image_height / $ratio;
        $resizedWidth  = $image_width / $ratio;
        $resized_image = $image->resize( new Box( $resizedWidth, $resizedHeight ) );
        $options       = array(
            'resolution-units' => ImageInterface::RESOLUTION_PIXELSPERINCH,
            'resolution-x'     => 100,
            'resolution-y'     => 200,
            'flatten'          => false
        );
        $resized_image->save( $path_to, $options );
    }
}


