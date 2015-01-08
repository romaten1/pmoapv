<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TeacherNewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Новини викладачів';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-news-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Створити новину', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => '_listItem'
    ]) ?>

</div>
