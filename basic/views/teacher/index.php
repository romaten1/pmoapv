<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use nirvana\prettyphoto\PrettyPhoto;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\TeacherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Викладачі';

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
        	$teacher_full_name = $model->last_name . ' ' . $model->name . ' '. $model->second_name;
            $href = Url::to('@web/uploads/teacher/').$model->image;
            $image = Url::to('@web/uploads/teacher/thumbs/thumb_').$model->image;
            $image_code = 
            $return = '<div class="row">
                            <div class="col-md-2">';
            $image_code = '<a href="'.
                $href.
                '" rel="prettyPhoto" title="'.$teacher_full_name.'"><img src="'.
                $image.
                '" alt="" /></a>';

            $return .= $model->image ? $image_code : '';
            $return .= '</div>
                            <div class="col-md-10">';
            $return .= Html::a(Html::encode($teacher_full_name), ['view', 'id' => $model->id]);
            $return .= '<br />';
            $return .= $model->job . ', ' . $model->science_status . '</p>';
            $return .= '</div>
                            </div><br />';
            return $return;
        },
    ]) ?>
    <?php 
        PrettyPhoto::widget([
            'target' => "a[rel^='prettyPhoto']",
            'pluginOptions' => [
                'opacity' => 0.60,
                'theme' => PrettyPhoto::THEME_LIGHT_ROUNDED,
                'social_tools' => false,
                'autoplay_slideshow' => false,
                'modal' => true
            ],
        ]);

        
     ?>
    
 
</div>
