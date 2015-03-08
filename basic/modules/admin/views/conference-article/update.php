<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\conference\models\ConferenceArticle */

$this->title                   = 'Оновити статтю конференції: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = [ 'label' => 'Статті конференцій', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = [ 'label' => $model->title, 'url' => [ 'view', 'id' => $model->id ] ];
$this->params['breadcrumbs'][] = 'Оновити';
?>
<div class="conference-article-update">

    <h1><?= Html::encode( $this->title ) ?></h1>

    <?= $this->render( '_form', [
        'model' => $model,
    ] ) ?>

</div>
