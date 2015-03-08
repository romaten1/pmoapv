<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\StaticPage */

$this->title                   = $model->title;
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="static-page-view">

    <h2><?= Html::encode( $this->title ) ?></h2>

    <p>
        <?= Html::decode( $model->text ) ?>
    </p>

</div>
