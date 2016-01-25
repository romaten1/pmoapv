<?php

use yii\helpers\Html;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $model app\models\Teacher */

$this->title                   = 'Додати розклад';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-create">

    <h1><?= Icon::show( 'th', [ ], Icon::BSG ) . Html::encode( $this->title ) ?></h1>

    <?= $this->render( '_form', [
        'model' => $model,
        'result' => $result
    ] ) ?>

</div>
