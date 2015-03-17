<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $model app\models\News */

$this->title                   = $model->title;
$this->params['breadcrumbs'][] = [ 'label' => 'Новини', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-view">

    <h2><?= Html::encode( $this->title ) ?></h2>

    <p><?= $model->image ? Html::img( '@web/uploads/news/' . $model->image ) : '' ?></p>

    <p><?= '<br />Опубліковано: ' . date( 'd.m.Y', $model->updated_at ); ?></p>

    <p><?= Html::decode( $model->description ) ?></p>

    <p><?= $model->text ?></p>

</div>
