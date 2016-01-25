<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\modules\vk\models\VkUser */

$this->title = 'Create Vk User';
$this->params['breadcrumbs'][] = ['label' => 'Vk Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vk-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
