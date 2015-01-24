<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NewsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
	<div class="col-md-12">
	    <?= $form->field($model, 'title') ?>

		<?= $form->field($model, 'description') ?>

	    <?= $form->field($model, 'text') ?>

		<div class="form-group">
			<?= Html::submitButton('Пошук', ['class' => 'btn btn-primary']) ?>
			<?= '';//Html::resetButton('Відмінити', ['class' => 'btn btn-default']) ?>
		</div>
	</div>
    <?php ActiveForm::end(); ?>

</div>
