<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\modules\vk\models\search\VkUserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vk-user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'first_name') ?>

    <?= $form->field($model, 'last_name') ?>

    <?= $form->field($model, 'sex') ?>

    <?php // echo $form->field($model, 'bdate') ?>

    <?php // echo $form->field($model, 'city_id') ?>

    <?php // echo $form->field($model, 'city_title') ?>

    <?php // echo $form->field($model, 'country') ?>

    <?php // echo $form->field($model, 'photo_200_orig') ?>

    <?php // echo $form->field($model, 'domain') ?>

    <?php // echo $form->field($model, 'school_id') ?>

    <?php // echo $form->field($model, 'school_city_id') ?>

    <?php // echo $form->field($model, 'school_name') ?>

    <?php // echo $form->field($model, 'school_year_to') ?>

    <?php // echo $form->field($model, 'last_seen') ?>

    <?php // echo $form->field($model, 'can_post') ?>

    <?php // echo $form->field($model, 'can_write_private_message') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'active') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
