<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\customer\models\Customer */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Покупатели', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-view">

<div class="row">
    <div class="col-md-6">
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
                'name',
                'phone',
                'address',
            ],
        ]) ?>
    </div>
    <div class="col-md-6">
        <h2>Заказы покупателя <?= Html::encode($this->title) ?></h2>
        <ul>
            <?php foreach($model->customerOrders as $order){?>
            <li>
                <b>Заказ №<?= $order->id; ?></b><br/>
                Время заказа: <?= Yii::$app->formatter->asDate($order->posted_at, 'php:d-m-Y H:s'); ?><br/>
                Количество: <?= $order->amount; ?><br/>
                Время оплаты: <?= Yii::$app->formatter->asDate($order->paid_at, 'php:d-m-Y H:s'); ?><br/>
            </li>
            <?php }?>
        </ul>
    </div>
</div>


</div>
