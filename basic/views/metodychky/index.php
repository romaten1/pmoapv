<?php

use yii\helpers\Html;
use yii\widgets\ListView;


/* @var $this yii\web\View */
/* @var $searchModel app\models\MetodychkySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Навчально-методичне забезпечення кафедри';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="metodychky-index">

   <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= ''; //Html::a('Створити методичні вказівки', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return '<p>'.Html::a(Html::encode($model->title), ['view', 'id' => $model->id]).'</p>';
        },
    ]) ?>

</div>
