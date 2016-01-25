<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\customer\models\Customer */

$this->title = 'Создать покупателя';
$this->params['breadcrumbs'][] = ['label' => 'Покупатели', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
