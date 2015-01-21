<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dektrium\user\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Message */
/* @var $receiver_id */

$this->title = 'Відповісти на повідомлення користувачу';
$this->params['breadcrumbs'][] = ['label' => 'Повідомлення', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-create">

    <h1><?= Html::encode($this->title) ?></h1>

	<div class="message-form">

		<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'receiver_id')->dropDownList([Html::encode(User::findOne( $receiver_id )->username)]) ?>

		<?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

		<div class="form-group">
			<?= Html::submitButton('Створити', ['class' => 'btn btn-success']) ?>
		</div>

		<?php ActiveForm::end(); ?>

	</div>

</div>
