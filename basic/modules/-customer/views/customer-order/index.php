<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы покупателей';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать заказ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            [
                'attribute' => 'customer_id',
                'format'    => 'html',
                'value'     => function ( $model ) {
                    return Html::a( $model->customer->name, [ '/customer/customer/view/', 'id' => $model->customer->id ] );
                },
            ],
            [
                'attribute' => 'posted_at',
                'format'    => [ 'date', 'php:jS F Y H:s' ]
            ],
            'amount',
            [
                'attribute' => 'paid_at',
                'format'    => [ 'date', 'php:jS F Y H:s' ]
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
