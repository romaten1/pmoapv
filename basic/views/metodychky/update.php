<?php

use yii\helpers\Html;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $model app\models\Metodychky */

$this->title                   = $model->title;
$this->params['breadcrumbs'][] = [ 'label' => 'Методичні вказівки', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = [ 'label' => $model->title, 'url' => [ 'view', 'id' => $model->id ] ];
$this->params['breadcrumbs'][] = 'Оновити';
?>
<div class="metodychky-update">

    <h1><?= Icon::show( 'book', [ ], Icon::BSG ) . Html::encode( 'Оновити методичні вказівки: ' . $this->title ) ?></h1>

    <?= $this->render( '_form', [
        'model' => $model,
    ] ) ?>

</div>
