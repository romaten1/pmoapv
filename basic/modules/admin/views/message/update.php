<?php

use yii\helpers\Html;
use dektrium\user\models\User;

/* @var $this yii\web\View */
/* */
$author      = User::findOne( $model->author_id )->username;
$receiver    = User::findOne( $model->receiver_id )->username;
$this->title = "Повідомлення від " . $author . ' для ' . $receiver;


$this->params['breadcrumbs'][] = [ 'label' => 'Повідомлення користувачів', 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = [ 'label' => $this->title, 'url' => [ 'view', 'id' => $model->id ] ];
$this->params['breadcrumbs'][] = 'Оновити';

?>
<div class="metodychky-update">

    <h1><?= Html::encode( 'Оновити повідомлення користувачів: ' . $this->title ) ?></h1>

    <?= $this->render( '_form', [
        'model' => $model,
    ] ) ?>

</div>
