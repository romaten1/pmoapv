<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Metodychky;
use app\models\Predmet;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\PredmetMetodychky */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="predmet-metodychky-form">

    <?php $form = ActiveForm::begin(); ?>
	
	<?= $form->field($model, 'metodychky_id')->dropDownList(ArrayHelper::map(Metodychky::find()->all(), 'id', 'title'))  ?>

    <?= $form->field($model, 'predmet_id')->dropDownList(ArrayHelper::map(Predmet::find()->all(), 'id', 'title'))?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Створити' : 'Оновити', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
