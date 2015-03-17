<?php

use yii\helpers\Html;
use yii\grid\GridView;
use dektrium\user\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\LogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Log', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            [
                'attribute' => 'user',
                'format'    => 'html',
                'value'     => function ( $model ) {
                    $name = User::findOne( $model->user )->username;
                    return $name;
                },
            ],
            'request:ntext',
            'time:datetime',
            'ip',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
