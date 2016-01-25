<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\customer\models\CustomerOrder */

$this->title                   = 'Редактировать заказ покупателя: ' . ' №' . $model->id;
$this->params['breadcrumbs'][] = [ 'label' => 'Заказы покупателей', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = [ 'label' => '№' . $model->id, 'url' => [ 'view', 'id' => $model->id ] ];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="customer-order-update">

    <h1><?= Html::encode( $this->title ) ?></h1>

    <?= $this->render( '_form', [
        'model' => $model,
    ] ) ?>

    <?php
    if (Yii::$app->request->isAjax) {
       echo Html::button('Закрыть', ['title' => 'Закрыть', 'class' => 'hideModalButton btn btn-success']);
    }?>
</div>
