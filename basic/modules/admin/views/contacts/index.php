<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\SearchContacts */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Контакти';
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

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view}{delete}',
            ],
        ],
    ]); ?>

</div>
