<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Новини';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            $return = '
                        <div class="row">
                            <div class="col-md-2">';
            $return .= $model->image ? Html::img('@web/uploads/news/thumbs/thumb_'.$model->image, ['class'=>'img-thumbnail']) : '';
            $return .= '</div>
                            <div class="col-md-10">';
            $return .= Html::a(Html::encode($model->title), ['view', 'id' => $model->id]);
            $return .= '<br />';
            $return .= Html::encode($model->description);
            $return .= '</div>
                            </div><br />';
            return $return;
        },
    ]) ?>

    

</div>
