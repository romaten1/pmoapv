<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use dektrium\user\models\User;
use app\models\Message;
use app\models\Teacher;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Message */
$author = User::findOne($model->author_id)->username;
$receiver = Teacher::getPrepod($model->receiver_id);
$this->title = "Повідомлення від ".$author. ' для '.$receiver;
$this->params['breadcrumbs'][] = ['label' => 'Messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
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
