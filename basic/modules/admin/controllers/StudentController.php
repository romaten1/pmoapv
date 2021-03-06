<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Student;
use app\models\search\StudentSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Imagine\Image\Box;
use Imagine\Image\Point;
use Imagine\Gd\Imagine;
use Imagine\Image\ImageInterface;

/**
 * StudentController implements the CRUD actions for Student model.
 */
class StudentController extends Controller
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
     * Lists all Student models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StudentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Student model.
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
     * Creates a new Student model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @throws NotFoundHttpException
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Student();
        // Получаем массив данных по загружамых файлах
        if ($model->load( Yii::$app->request->post() )) {
            if (isset( $model->image )) {
                $model->image = UploadedFile::getInstance( $model, 'image' );
            }

            if (isset( $model->image )) {

                $image_name      = Yii::$app->getSecurity()->generateRandomString();
                $image_full_name = $image_name . '.' . $model->image->extension;
                $model->image->saveAs( 'uploads/student/' . $image_full_name );
                $model->image = $image_full_name;
                //Make a thumbnails
                $path_from = Yii::getAlias( '@webroot/uploads/student/' . $image_full_name );
                $path_to   = Yii::getAlias( '@webroot/uploads/student/thumbs/thumb_' ) . $image_full_name;
                $this->makeImage( $path_from, $path_to, $desired_width = 60 );
                //Make an image
                $path_from = Yii::getAlias( '@webroot/uploads/student/' . $image_full_name );
                $path_to   = Yii::getAlias( '@webroot/uploads/student/' ) . $image_full_name;
                $this->makeImage( $path_from, $path_to, $desired_width = 500 );
            } else {
                $model->image = 'teacher.png';
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
     * Updates an existing Student model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     *
     * @throws NotFoundHttpException
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model     = $this->findModel( $id );
        $old_image = $model->image;
        if ($model->load( Yii::$app->request->post() )) {
            if (isset( $model->image )) {
                $model->image = UploadedFile::getInstance( $model, 'image' );
            }

            if (isset( $model->image )) {
                $image_name      = Yii::$app->getSecurity()->generateRandomString();
                $image_full_name = $image_name . '.' . $model->image->extension;
                $model->image->saveAs( 'uploads/student/' . $image_full_name );
                $model->image = $image_full_name;
                //Make a thumbnails
                $path_from = Yii::getAlias( '@webroot/uploads/student/' . $image_full_name );
                $path_to   = Yii::getAlias( '@webroot/uploads/student/thumbs/thumb_' ) . $image_full_name;
                $this->makeImage( $path_from, $path_to, $desired_width = 60 );
                //Make an image
                $path_from = Yii::getAlias( '@webroot/uploads/student/' . $image_full_name );
                $path_to   = Yii::getAlias( '@webroot/uploads/student/' ) . $image_full_name;
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
     * Deletes an existing Student model.
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
     * Finds the Student model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Student the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Student::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
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
