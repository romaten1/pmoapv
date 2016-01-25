<?php

use app\models\Chat;
use app\models\Teacher;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ChatSearchMessage */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Chat Messages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chat-message-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Chat Message', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'chat_id',
                'value'     => function ( $model ) {
                    return $model->chat->title;
                },
            ],
            [
                'attribute' => 'user_id',
                'value'     => function ( $model ) {
                    $teacher_name = Teacher::getPrepod($model->user->id);
                    return $model->user->username . ' (' . $teacher_name . ')';
                },
            ],
            'message',
            [
                'attribute' => 'created_at',
                'format'    => 'date'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
