<?php

use yii\helpers\Html;
use yii\grid\GridView;
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
        <?= Html::a('Написати повідомлення викладачу', ['create'], ['class' => 'btn btn-success']) ?>
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
                        'itemView' => '_indexlistItem',                        
                    ]) ?>
                </div>
            </div> 
        </div>        
    </div>  

</div>


