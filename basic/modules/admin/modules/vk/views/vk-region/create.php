<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\modules\vk\models\VkRegion */

$this->title = 'Create Vk Region';
$this->params['breadcrumbs'][] = ['label' => 'Vk Regions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vk-region-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
