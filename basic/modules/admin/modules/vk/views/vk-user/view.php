<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\modules\vk\models\VkUser */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vk Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vk-user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'first_name',
            'last_name',
            'sex',
            'bdate',
            'city_id',
            'city_title',
            'country',
            'photo_200_orig',
            'domain',
            'school_id',
            'school_city_id',
            'school_name',
            'school_year_to',
            'last_seen',
            'can_post',
            'can_write_private_message',
            'description:ntext',
            'active',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
