<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

/* @var $this \yii\web\View */
/* @var $content string */
$this->title = 'Контакти';
?>
<?php $form = ActiveForm::begin( [ 'id' => 'contact-form' ] ); ?>

		<div class="row">
			<div class="col-md-6">
				<?= $form->field($model, 'name') ?>
				<?= $form->field($model, 'email') ?>
				<?= $form->field($model, 'subject') ?>
			</div>
			<div class="col-md-6">
				<?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>

				<?= $form->field( $model, 'verifyCode' )->widget( Captcha::className(), [
					'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
				] ) ?>

			</div>
			<div class="clearfix"></div>
			<div class="col-lg-12 text-center">
				<div id="success"></div>
				<button type="submit" class="btn btn-xl" name="contact-button">Відправити</button>
			</div>

		</div>
<?php ActiveForm::end(); ?>



