<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TeacherNews */

$this->title                   = 'Створити новину';
$this->params['breadcrumbs'][] = [ 'label' => 'Новини викладачів', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-news-create">

    <h1><?= Html::encode( $this->title ) ?></h1>

    <?= $this->render( '_form', [
        'model' => $model,
    ] ) ?>

</div>
