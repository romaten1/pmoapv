<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\StaticPage */

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="static-page-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?= Html::a('Оновити', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Ви впевнені, що хочете видалити цей запис?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <p>
        <?= Html::decode($model->text) ?></h1>
    </p>
    
</div>
