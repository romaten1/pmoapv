<?php

namespace app\modules\customer\controllers;

use Yii;
use app\modules\customer\models\CustomerOrder;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CustomerOrderController implements the CRUD actions for CustomerOrder model.
 */
class CustomerOrderController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => [ 'post' ],
                ],
            ],
        ];
    }

    /**
     * Lists all CustomerOrder models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider( [
            'query' => CustomerOrder::find(),
        ] );

        return $this->render( 'index', [
            'dataProvider' => $dataProvider,
        ] );
    }

    /**
     * Displays a single CustomerOrder model.
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
     * Creates a new CustomerOrder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CustomerOrder();

        if ($model->load( Yii::$app->request->post() ) && $model->save()) {
            return $this->redirect( [ '/customer/customer/update', 'id' => $model->customer->id ] );
        } else {
            $customer_id = Yii::$app->request->get( 'customer_id', null );
            if ( ! empty( $customer_id )) {
                $model->customer_id = $customer_id;
            }
            if (Yii::$app->request->isAjax) {
                return $this->renderAjax( 'create', [
                    'model' => $model
                ] );
            } else {
                return $this->render( 'create', [
                    'model' => $model,
                ] );
            }
        }
    }

    /**
     * Updates an existing CustomerOrder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionUpdate( $id )
    {
        $model = $this->findModel( $id );

        if ($model->load( Yii::$app->request->post() ) && $model->save()) {
            return $this->redirect( [ '/customer/customer/update', 'id' => $model->customer->id ] );
        } else {
            if (Yii::$app->request->isAjax) {
                return $this->renderAjax( 'update', [
                    'model' => $model
                ] );
            } else {
                return $this->render( 'update', [
                    'model' => $model,
                ] );
            }
        }
    }

    /**
     * Deletes an existing CustomerOrder model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     *
     * @return mixed
     */
    public function actionDelete( $id )
    {
        $model = $this->findModel( $id );
        $customer_id = $model->customer->id;
        $model->delete();
        return $this->redirect( [ '/customer/customer/update', 'id' => $customer_id ] );
    }

    /**
     * Finds the CustomerOrder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return CustomerOrder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel( $id )
    {
        if (( $model = CustomerOrder::findOne( $id ) ) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException( 'The requested page does not exist.' );
        }
    }
}
