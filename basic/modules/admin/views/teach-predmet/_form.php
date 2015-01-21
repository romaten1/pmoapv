<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Teacher;
use app\models\Predmet;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\TeachPredmet */
/* @var $form yii\widgets\ActiveForm */
$fullname[] ='';
$teacher = Teacher::find()->all();
foreach($teacher as $value){
	$fullname[$value->id] = $value->last_name.' '.$value->name.' '.$value->second_name;
}

?>

<div class="teach-predmet-form">

    <?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'teach_id')->dropDownList($fullname)  ?>

    <?= $form->field($model, 'predmet_id')->dropDownList(ArrayHelper::map(Predmet::find()->all(), 'id', 'title'))  ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Створити' : 'Оновити', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
