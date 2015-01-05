<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\admin\models\Message;
use dektrium\user\models\User;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\MessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Отримані повідомлення';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Написати повідомлення', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Надіслані повідомлення', ['ownmessage'], ['class' => 'btn btn-default']) ?>
    </p>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">Отримані повідомлення</div>
                <div class="panel-body">
                    <?= ListView::widget([
                        'dataProvider' => $dataReceivedProvider,
                        'itemOptions' => ['class' => 'item'],
                        'itemView' => function ($model, $key, $index, $widget) {
                            return 
                            '<div class="panel panel-default">
                            <div class="panel-heading text-right"><span class="pull-left"><strong class="">Від '.
                            User::findOne($model->author_id)->username.'</strong></span>'.
                            date("H:i:s - d.m.y", $model->created_at).'</div>
                                <div class="panel-body"><div class="col-md-9">'.$model->text.'</div><div class="col-md-3">'.
                                ($model->recieved_at > 1 ? "Переглянуто" : Html::a("Відмітити як переглянуте", ['recieve', 'id' => $model->id])).'</div></div>
                            </div>';
                        },
                    ]) ?>
                </div>
            </div> 
        </div>        
    </div>  

</div>


