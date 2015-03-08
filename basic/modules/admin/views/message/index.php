<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Message;
use app\models\Teacher;
use dektrium\user\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\MessageSearch */
/* @var $model app\models\Message */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Повідомлення';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-index">

    <h1><?= Html::encode( $this->title ) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a( 'Створити повідомлення', [ 'create' ], [ 'class' => 'btn btn-success' ] ) ?>
    </p>

    <?= GridView::widget( [
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            [ 'class' => 'yii\grid\SerialColumn' ],
            [
                'attribute' => 'author_id',
                'format'    => 'html',
                'value'     => function ( $model ) {
                    if (Teacher::getTeacherByUserId( $model->author_id )) {
                        $name = Teacher::getPrepod( $model->author_id );
                    } else {
                        $name = User::findOne( $model->author_id )->username;
                    }
                    return $name;
                },
            ],
            [
                'attribute' => 'receiver_id',
                'format'    => 'html',
                'value'     => function ( $model ) {
                    if (Teacher::getTeacherByUserId( $model->receiver_id )) {
                        $name = Teacher::getPrepod( $model->receiver_id );
                    } else {
                        $name = User::findOne( $model->receiver_id )->username;
                    }
                    return $name;
                },
                //'filter' => Teacher::getPrepodsArray()
            ],
            'text:ntext',
            [
                'attribute' => 'created_at',
                'format'    => 'date',
            ],
            [
                'attribute' => 'recieved_at',
                'format'    => 'html',
                'value'     => function ( $model ) {
                    if ($model->recieved_at == 1) {
                        return "Не отримано";
                    } else {
                        return date( 'H:i / d-m-Y', $model->recieved_at );
                    }
                },
            ],
            [
                'attribute' => 'active',
                'format'    => 'html',
                'value'     => function ( $model ) {
                    return $model->getStatusLabel();
                },
                'filter'    => Message::getStatusArray()
            ],
            [ 'class' => 'yii\grid\ActionColumn' ],
        ],
    ] ); ?>

</div>
