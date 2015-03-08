<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\PredmetMetodychky */

$this->title                   = 'Вказати, до якого предмета відносяться методичні вказівки';
$this->params['breadcrumbs'][] = [ 'label' => 'Предмет-Методичні вказівки', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="predmet-metodychky-create">

    <h1><?= Html::encode( $this->title ) ?></h1>

    <?= $this->render( '_form', [
        'model' => $model,
    ] ) ?>

</div>
