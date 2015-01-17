<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Contacts;

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
            [
                'attribute' => 'subject',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::a($model->subject, ['/admin/contacts/view/', 'id'=>$model->id]);},                
            ],
            'name',
            'email:email',
            
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
                'format' => 'html',
                'value' => function ($model) {
                    if($model->reviewed_at == 0){
                        return "Не переглянуто";
                    }
                    else{
                        return date('H:i / d-m-Y',$model->reviewed_at);
                    }
                },
            ],            
            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view}{delete}',
            ],
        ],
    ]); ?>

</div>
