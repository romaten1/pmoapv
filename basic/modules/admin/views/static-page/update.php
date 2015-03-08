<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StaticPage */

$this->title                   = $model->title;
$this->params['breadcrumbs'][] = [ 'label' => 'Статичні сторінки', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = [ 'label' => $model->title, 'url' => [ 'view', 'id' => $model->id ] ];
$this->params['breadcrumbs'][] = 'Оновити';
?>
<div class="static-page-update">

    <h1><?= Html::encode( 'Оновити статичну сторінку: ' . $this->title ) ?></h1>

    <?= $this->render( '_form', [
        'model' => $model,
    ] ) ?>

</div>
