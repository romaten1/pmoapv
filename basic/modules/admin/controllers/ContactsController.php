<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Contacts;
use app\models\search\SearchContacts;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ContactsController implements the CRUD actions for Contacts model.
 */
class ContactsController extends Controller
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
                        'actions' => [ 'index', 'create', 'update', 'view', 'review', 'delete', 'unreview' ],
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
     * Lists all Contacts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new SearchContacts();
        $dataProvider = $searchModel->search( Yii::$app->request->queryParams );

        return $this->render( 'index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ] );
    }

    /**
     * Displays a single Contacts model.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionView( $id )
    {
        return $this->render( 'view', [
            'model' => $this->findModel( $id ),
        ] );
    }

    /**
     * Deletes an existing Contacts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionReview( $id )
    {
        $model         = $this->findModel( $id );
        $model->active = Contacts::STATUS_REVIEWED;
        Yii::info( $this->id . ' - ' . $this->action->id . ' - id: ' . $model->id . ' - user: ' . \Yii::$app->user->id,
            'admin' );
        $model->save();

        return $this->redirect( [ 'index' ] );
    }

    public function actionUnreview( $id )
    {
        $model         = $this->findModel( $id );
        $model->active = Contacts::STATUS_ACTIVE;
        Yii::info( $this->id . ' - ' . $this->action->id . ' - id: ' . $model->id . ' - user: ' . \Yii::$app->user->id,
            'admin' );
        $model->save();

        return $this->redirect( [ 'index' ] );
    }

    public function actionDelete( $id )
    {
        $this->findModel( $id )->delete();
        Yii::info( $this->id . ' - ' . $this->action->id . ' - id: ' . $id . ' - user: ' . \Yii::$app->user->id,
            'admin' );
        return $this->redirect( [ 'index' ] );
    }

    /**
     * Finds the Contacts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return Contacts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel( $id )
    {
        if (( $model = Contacts::findOne( $id ) ) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException( 'The requested page does not exist.' );
        }
    }
}
