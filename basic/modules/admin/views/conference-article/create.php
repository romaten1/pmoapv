<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\conference\models\ConferenceArticle */

$this->title                   = 'Створити статтю конференції';
$this->params['breadcrumbs'][] = [ 'label' => 'Стаття конференції', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conference-article-create">

    <h1><?= Html::encode( $this->title ) ?></h1>

    <?= $this->render( '_form', [
        'model' => $model,
    ] ) ?>

</div>
