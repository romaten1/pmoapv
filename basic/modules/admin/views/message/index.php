<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\admin\models\Message;
use dektrium\user\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\MessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Повідомлення';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Створити повідомлення', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],            
            [
                'attribute' => 'author_id',
                'format' => 'html',
                'value' => function ($model) {
                    return User::findOne($model->author_id)->username;},                
            ],
            [
                'attribute' => 'receiver_id',
                'format' => 'html',
                'value' => function ($model) {
                    return User::findOne($model->receiver_id)->username;},                
            ],            
            'text:ntext',
            [
                'attribute' => 'created_at',
                'format' => 'date',                
            ],
            [
                'attribute' => 'recieved_at',
                'format' => 'date',                
            ],
            [
                'attribute' => 'active',
                'format' => 'html',
                'value' => function ($model) {
                    return $model->getStatusLabel();},
                'filter' => Message::getStatusArray()
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
