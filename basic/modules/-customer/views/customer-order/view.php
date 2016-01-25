<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\customer\models\CustomerOrder */

$this->title = 'Заказ №' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы покупателей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверенны, что хотите удалить этого покупателя?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'customer_id',
                'format'    => 'html',
                'value'     => Html::a( $model->customer->name, [ '/customer/customer/view/', 'id' => $model->customer->id ] )
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
        ],
    ]) ?>

</div>
