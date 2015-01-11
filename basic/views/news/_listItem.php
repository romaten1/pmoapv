<?php 
    use yii\helpers\Html;
 ?>


<div class="row">
    <div class="col-md-2">
        <?=$model->image ? Html::img('@web/uploads/news/thumbs/thumb_'.$model->image, ['class'=>'img-thumbnail']) : ''?>
    </div>
    <div class="col-md-10">
         <?= Html::a(Html::encode($model->title), ['view', 'id' => $model->id])?>
         <br />
         <?= date('H:i / d-m-Y', $model->updated_at)?>
         <br />
         <?= Html::encode($model->description)?>
    </div>
</div>
<br />
