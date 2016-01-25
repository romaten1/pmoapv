<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\customer\models\CustomerOrder */

$this->title                   = 'Создать заказ';
$this->params['breadcrumbs'][] = [ 'label' => 'Заказы покупателей', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-order-create">

    <h1><?= Html::encode( $this->title ) ?></h1>

    <?= $this->render( '_form', [
        'model' => $model,
    ] ) ?>

    <?php
    if (Yii::$app->request->isAjax) {
        echo Html::button( 'Закрыть окно', [ 'title' => 'Закрыть', 'class' => 'hideModalButton btn btn-success' ] );
    }?>

</div>
