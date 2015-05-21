<?php

use app\models\Student;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Teacher */

$this->title                   = Student::getFullName($model->student_id);
$this->params['breadcrumbs'][] = [ 'label' => 'Кращі студенти', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="best-student-view">

    <h2><?= Html::encode( $this->title ) ?> </h2>

    <p><?= $model->student->image ? Html::img( '@web/uploads/student/' . $model->student->image ) : '' ?></p>

    <p><?= $model->description ?></p>

</div>
