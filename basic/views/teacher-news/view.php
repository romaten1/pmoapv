<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Teacher;
use yii\helpers\StringHelper;

$teacher = Teacher::getTeacherByUserId($model->teacher_id);

$teacher_full_name = $teacher->last_name . ' ' . $teacher->name . ' '. $teacher->second_name;
$href = Url::to('@web/uploads/teacher/').$teacher->image;
$image = Url::to('@web/uploads/teacher/thumbs/thumb_').$teacher->image;
$image_code = '<a href="'.
              $href.
              '" rel="prettyPhoto" title="'.$teacher_full_name.'"><img src="'.
              $image.
              '" alt="" /></a>';
?>
<div class="row">
	<div class="col-md-7">
		<h3><?= $model->title;?></h3>
		<br />
		<?= date('H:i / d-m-Y', $model->updated_at);?>
		<br />
		<?= $model->text?>
	</div>
	<div class="col-md-1">
		<?= $teacher->image ? $image_code : '';?>
	</div>
	<div class="col-md-4">
		<?= Html::a(Html::encode($teacher_full_name), ['/teacher/view', 'id' => $teacher->id]);?>
		<br />
		<?=$teacher->job?>, <?=$teacher->science_status?>
	</div>

</div><br />

