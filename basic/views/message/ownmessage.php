<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\admin\models\Message;
use dektrium\user\models\User;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\MessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Надіслані повідомлення';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Написати повідомлення', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Отримані повідомлення', ['index'], ['class' => 'btn btn-default']) ?>
    </p>
    <div class="row">        
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">Надіслані повідомлення</div>
                <div class="panel-body">
                    <?= ListView::widget([
                        'dataProvider' => $dataOwnProvider,
                        'itemOptions' => ['class' => 'item'],
                        'itemView' => function ($model, $key, $index, $widget) {
                            return 
                            '<div class="panel panel-default">
                            <div class="panel-heading text-right"><span class="pull-left"><strong class="">Для '.
                            User::findOne($model->receiver_id)->username.'</strong></span>'.
                            date("H:i:s - d.m.y", $model->created_at).'</div>
                                <div class="panel-body">'.$model->text.'</div>
                            </div>';
                        },
                    ]) ?>
                </div>
            </div> 
        </div>
    </div>  

</div>


