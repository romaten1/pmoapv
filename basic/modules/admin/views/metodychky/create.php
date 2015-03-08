<?php

use yii\helpers\Html;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $model app\models\Metodychky */

$this->title                   = 'Створити методичні вказівки';
$this->params['breadcrumbs'][] = [ 'label' => 'Методичні вказівки', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="metodychky-create">

    <h1><?= Icon::show( 'book', [ ], Icon::BSG ) . Html::encode( $this->title ) ?></h1>

    <?= $this->render( '_form', [
        'model' => $model,
    ] ) ?>

</div>
