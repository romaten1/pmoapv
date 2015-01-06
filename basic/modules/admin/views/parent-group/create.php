<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\ParentGroup */

$this->title = 'Створити категорію';
$this->params['breadcrumbs'][] = ['label' => 'Категорії статичних сторінок', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="parent-group-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
