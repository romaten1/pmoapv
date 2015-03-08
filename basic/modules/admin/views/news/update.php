<?php

use yii\helpers\Html;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $model app\models\News */

$this->title                   = $model->title;
$this->params['breadcrumbs'][] = [ 'label' => 'Новини', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = [ 'label' => $model->title, 'url' => [ 'view', 'id' => $model->id ] ];
$this->params['breadcrumbs'][] = 'Оновити';
?>
<div class="news-update">

    <h1><?= Icon::show( 'folder-open', [ ], Icon::BSG ) . Html::encode( 'Оновити новину: ' . $this->title ) ?></h1>

    <?= $this->render( '_form', [
        'model' => $model,
    ] ) ?>

</div>
