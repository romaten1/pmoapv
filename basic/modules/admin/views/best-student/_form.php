<?php

use app\models\BestStudent;
use app\models\Student;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model app\models\BestStudent */
/* @var $form yii\widgets\ActiveForm */

$fullname[] = '';
$student    = Student::find()->all();
foreach ($student as $value) {
    $fullname[$value->id] = $value->second_name . ' ' . $value->first_name;
}
?>

<div class="best-student-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field( $model, 'student_id' )->dropDownList( Student::getStudentsArray(), ['prompt' => ''] ) ?>

    <?= $form->field( $model, 'description' )->widget( CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions( [ 'elfinder', 'path' => 'Global' ], [
                'preset' => 'full',
                'inline' => false,
                'height' => '250'
            ]
        ),
    ] ); ?>

    <?= $form->field( $model, 'active' )->dropDownList( BestStudent::getStatusArray() ) ?>

    <?= $form->field( $model, 'rating' )->dropDownList( [ 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5] ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
