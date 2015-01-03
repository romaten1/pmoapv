<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\admin\models\Contacts;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\SearchContacts */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Звернення користувачів';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contacts-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'email:email',
            'subject',
            'body',
            [
                'attribute' => 'active',
                'format' => 'html',
                'value' => function ($model) {
                    return $model->getStatusLabel();},
                'filter' => Contacts::getStatusArray()
            ],
            /*[
                'attribute' => 'created_at',
                'format' => 'date',
                'filter' => DatePicker::widget(
                    [
                        'model' => $searchModel,
                        'attribute' => 'created_at',
                        'options' => [
                            'class' => 'form-control'
                        ],
                        
                    ]
                )
            ],*/
            [
                'attribute' => 'created_at',
                'format' => 'date',
                'filter' => [],
            ],
            [
                'attribute' => 'reviewed_at',
                'format' => 'date'
            ],            
            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view}{delete}',
            ],
        ],
    ]); ?>

</div>
