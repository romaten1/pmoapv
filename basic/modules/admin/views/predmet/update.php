<?php

use yii\helpers\Html;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $model app\models\Predmet */

$this->title                   = $model->title;
$this->params['breadcrumbs'][] = [ 'label' => 'Предмет', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = [ 'label' => $model->title, 'url' => [ 'view', 'id' => $model->id ] ];
$this->params['breadcrumbs'][] = 'Оновити';
?>
<div class="predmet-update">

    <h1><?= Icon::show( 'briefcase', [ ], Icon::BSG ) . Html::encode( 'Оновити: ' . $this->title ) ?></h1>

    <?= $this->render( '_form', [
        'model' => $model,
    ] ) ?>

</div>
