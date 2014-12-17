<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Teacher;
use app\models\Predmet;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\TeachPredmetSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Викладач-Предмет';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teach-predmet-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Вказати, хто веде предмет', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            [
                'attribute' => 'teach_id',
                'format' => 'html',
                'value' => function ($model) {
                    $teacher_name = Teacher::findOne($model->teach_id);
                    return $teacher_name->last_name.' '.$teacher_name->name.' '.$teacher_name->second_name;},
                 'filter' => ArrayHelper::map(Teacher::find()->all(), 'id', 'last_name'),
                //Настройка фильтра для вывода не только фамилии, а полностю ФИО
                /*'filter' => function ($model) {
                    $teacher = Teacher::find()->all();
                    foreach($teacher as $value){
                        $fullname[$value->id] = $value->last_name.' '.$value->name.' '.$value->second_name;
                    }
                    return $fullname;
                },*/

                
            ],
            
            [
                'attribute' => 'predmet_id',
                'format' => 'html',
                'value' => function ($model) {
                    $predmet = Predmet::findOne($model->predmet_id);
                    return $predmet->title;},
                'filter' => ArrayHelper::map(Predmet::find()->all(), 'id', 'title'),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

   
</div>
