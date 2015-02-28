<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\conference\models\Conference;

/* @var $this yii\web\View */
/* @var $model app\modules\conference\models\ConferenceArticleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="conference-article-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

	<?= $form->field($model, 'conference_id')->dropDownList(Conference::getConferenceArray(),['prompt'=>'Виберіть конференцію']) ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'author') ?>

    <div class="form-group">
        <?= Html::submitButton('Пошук', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Відміна', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
