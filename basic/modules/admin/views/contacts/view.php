<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\admin\models\Contacts;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Contacts */

$this->title = $model->subject;
$this->params['breadcrumbs'][] = ['label' => 'Контакти', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contacts-view">

    <h3>Повідомлення від незареєстрованого користувача на тему: </h3> 
    <h1><?= Html::encode($this->title) ?></h1>   
    
    <div class="form-group">
        <?= Html::a($model->active === Contacts::STATUS_REVIEWED ? 
            'Вернути до перегляду' : 'Переглянути', 
            $model->active === Contacts::STATUS_REVIEWED ? ['unreview', 'id' => $model->id] : ['review', 'id' => $model->id],
            ['class' => 'btn btn-success']) ?>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'subject',
            'name',
            'email:email',            
            'body',
            [
                'attribute' => 'active',
                'value' => Contacts::getStatus($model->active),
            ],
            [
                'attribute' => 'created_at',
                'format' => 'date'
            ],
            [
                'attribute' => 'reviewed_at',
                'format' => 'date'
            ], 
        ],
    ]) ?>

</div>
