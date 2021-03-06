<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\StaticPage */

$this->title                   = 'Створити статичну сторінку';
$this->params['breadcrumbs'][] = [ 'label' => 'Статичні сторінки', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="static-page-create">

    <h1><?= Html::encode( $this->title ) ?></h1>

    <?= $this->render( '_form', [
        'model' => $model,
    ] ) ?>

</div>
