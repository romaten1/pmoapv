<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use dektrium\user\models\User;
use app\models\Message;

/* @var $this yii\web\View */
/* @var $model app\models\Message */
$author = User::findOne($model->author_id)->username;
$receiver = User::findOne($model->receiver_id)->username;
$this->title = "Повідомлення від ".$author. ' для '.$receiver;
$this->params['breadcrumbs'][] = ['label' => 'Повідомлення', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-view">

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'author_id',
                'format' => 'html',
                'value' => $author,                
            ],
            [
                'attribute' => 'receiver_id',
                'format' => 'html',
                'value' => $receiver,                
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
                'value' => Message::getStatus($model->active),
            ],
        ],
    ]) ?>

</div>
