<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\conference\models\Conference;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
/* @var $this yii\web\View */
/* @var $model app\modules\conference\models\Conference */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="conference-form">

    <?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

	<?= $form->field($model, 'description')->widget(CKEditor::className(), [
		'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'path' => 'Global'], ['preset' => 'full',
		                                                                                'inline' => false,
		                                                                                'height' => '250']
		),
	]); ?>

	<?= $form->field($model, 'active')->dropDownList(Conference::getStatusArray()) ?>

    <?= $form->field($model, 'conference_date')->textInput(['maxlength' => 256]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Створити' : 'Оновити', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
