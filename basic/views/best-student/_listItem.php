<?php
use app\models\Student;
use yii\helpers\Html;
use yii\helpers\StringHelper;
?>
<div class="item">
    <img src="/uploads/student/<?php echo $model->student->image ? $model->student->image : "default_user.png" ?>">
    <h4><?= Html::a( Student::getFullName($model->student_id), [ 'view', 'id' => $model->id ] ); ?>
    <br><span class="badge"><?= $model->student->group->title?></span></h4>
    <?= StringHelper::truncateWords($model->description, 20, ' ... ') ?>
</div>


