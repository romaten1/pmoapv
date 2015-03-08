<?php

use yii\helpers\Html;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $model app\models\Predmet */

$this->title                   = 'Створити предмет';
$this->params['breadcrumbs'][] = [ 'label' => 'Предмети', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="predmet-create">

    <h1><?= Icon::show( 'briefcase', [ ], Icon::BSG ) . Html::encode( $this->title ) ?></h1>

    <?= $this->render( '_form', [
        'model' => $model,
    ] ) ?>

</div>
