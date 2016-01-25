<?php

namespace app\modules\books\controllers;

use Yii;
use app\modules\books\models\Books;
use app\modules\books\models\BooksSearch;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\modules\books\helpers\ImageHelper;

/**
 * BooksController implements the CRUD actions for Books model.
 */
class BooksController extends Controller
{
    public function behaviors()
    {
        return [

            // Доступ к странице только для авторизированных пользователей.
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow'   => true,
                        'actions' => [ 'index', 'view', 'delete', 'update' ],
                        'roles'   => [ '@' ],
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
     * Lists all Books models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new BooksSearch();
        $dataProvider = $searchModel->search( Yii::$app->request->queryParams );
        // Запоминаем путь с учетом фильтров
        Url::remember();
        return $this->render( 'index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ] );
    }

    /**
     * Displays a single Books model.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionView( $id )
    {
        $model = $this->findModel( $id );
        // запрос только аяксом
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax( 'view', [
                'model' => $model
            ] );
        } else {
            return $this->redirect(  Url::previous()  );
        }
    }

    /**
     * Updates an existing Books model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     *
     * @throws NotFoundHttpException
     * @return mixed
     */
    public function actionUpdate( $id )
    {
        $model     = $this->findModel( $id );
        // Сохраняем ссылку на рисунок, если он уже существует
        $old_image = $model->preview;
        if ($model->load( Yii::$app->request->post() )) {
            if (isset( $model->preview )) {
                $model->preview = UploadedFile::getInstance( $model, 'preview' );
            }
            if (isset( $model->preview )) {
                $image_name      = Yii::$app->getSecurity()->generateRandomString();
                $image_full_name = $image_name . '.' . $model->preview->extension;
                $model->preview->saveAs( 'img/books/' . $image_full_name );
                $model->preview = $image_full_name;
                //Создаем thumbs
                $path_from = Yii::getAlias( '@webroot/img/books/' . $image_full_name );
                $path_to   = Yii::getAlias( '@webroot/img/books/thumbs/thumb_' ) . $image_full_name;
                ImageHelper::makeImage( $path_from, $path_to, $desired_width = 60 );
                //Создаем картинку
                $path_from = Yii::getAlias( '@webroot/img/books/' . $image_full_name );
                $path_to   = Yii::getAlias( '@webroot/img/books/' ) . $image_full_name;
                ImageHelper::makeImage( $path_from, $path_to, $desired_width = 700 );
            } else {
                $model->preview = $old_image;
            }
            if ($model->validate() && $model->save()) {
                // Переадресация на запомненую страницу
                return $this->redirect( Url::previous() );
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
     * Deletes an existing Books model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionDelete( $id )
    {
        $this->findModel( $id )->delete();

        return $this->redirect( Url::previous() );
    }

    /**
     * Finds the Books model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return Books the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel( $id )
    {
        if (( $model = Books::findOne( $id ) ) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException( 'The requested page does not exist.' );
        }
    }
}
