<?php 
use yii\helpers\Html;
use yii\helpers\Url;
$teacher_full_name = $model->last_name . ' ' . $model->name . ' '. $model->second_name;
$href = Url::to('@web/uploads/teacher/').$model->image;
$image = Url::to('@web/uploads/teacher/thumbs/thumb_').$model->image;
$image_code = '<a href="'.
                $href.
                '" rel="prettyPhoto" title="'.$teacher_full_name.'"><img src="'.
                $image.
                '" alt="" /></a>';
 ?>     
<div class="row">
    <div class="col-md-2">
        <?= $model->image ? $image_code : '';?>
    </div>
    <div class="col-md-10">
        <?= Html::a(Html::encode($teacher_full_name), ['view', 'id' => $model->id]);?>
    <br />
        <?=$model->job?>
    </div>
</div><br />

