<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\customer\models\Customer */

$this->title                   = 'Редактирование покупателя: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = [ 'label' => 'Покупатели', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = [ 'label' => $model->name, 'url' => [ 'view', 'id' => $model->id ] ];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="customer-update">
    <div class="row">
        <div class="col-md-6">
            <h1><?= Html::encode( $this->title ) ?></h1>

            <?= $this->render( '_form', [
                'model' => $model,
            ] ) ?>
        </div>
        <div class="col-md-6">
            <h2>Заказы покупателя <?= Html::encode( $model->name ) ?></h2>
            <?= Html::button( 'Создать заказ',
                [
                    'value' => Url::to( [ '/customer/customer-order/create', 'customer_id' => $model->id ] ),
                    'title' => 'Создать заказ',
                    'class' => 'showModalButton btn btn-info'
                ] ) ?>
            <ul>
                <?php foreach ($model->customerOrders as $order) { ?>
                    <li>
                        <div class="row">
                            <div class="col-md-8">
                                <b>Заказ №<?= $order->id; ?></b><br/>
                                Время заказа: <?= Yii::$app->formatter->asDate( $order->posted_at, 'php:d-m-Y H:s' ); ?>
                                <br/>
                                Количество: <?= $order->amount; ?><br/>
                                Время оплаты: <?= Yii::$app->formatter->asDate( $order->paid_at, 'php:d-m-Y H:s' ); ?>
                                <br/>
                            </div>
                            <div class="col-md-4">
                                <?= Html::button( 'Редактировать заказ',
                                    [
                                        'value' => Url::to( [ '/customer/customer-order/update', 'id' => $order->id ] ),
                                        'title' => 'Редактировать заказ',
                                        'class' => 'showModalButton btn btn-sm btn-default'
                                    ] ) ?>
                                <br/> <br/>
                                <?= Html::a( 'Удалить заказ', [ '/customer/customer-order/delete', 'id' => $order->id ],
                                    [
                                        'class' => 'btn  btn-sm btn-danger',
                                        'data'  => [
                                            'confirm' => 'Вы уверенны, что хотите удалить эту запись?',
                                            'method'  => 'post',
                                        ],
                                    ] ) ?>

                            </div>
                        </div>

                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>

</div>
