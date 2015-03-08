<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\conference\models\Conference */

$this->title                   = 'Створити науковий захід';
$this->params['breadcrumbs'][] = [ 'label' => 'Наукові заходи', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conference-create">

    <h1><?= Html::encode( $this->title ) ?></h1>

    <?= $this->render( '_form', [
        'model' => $model,
    ] ) ?>

</div>
