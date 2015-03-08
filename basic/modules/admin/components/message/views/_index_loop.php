<?php
/**
 * Представление цикла последних постов.
 * @var yii\base\View $this Представление
 * @var $models
 */


use dektrium\user\models\User;
use yii\helpers\Html;

if ($models) {
    foreach ($models as $model) {
        ?>
        <div class="panel-heading text-right">
            <span class="pull-left"><strong
                    class="">Від <?= User::findOne( $model->author_id )->username ?></strong></span>
            <?= date( "H:i:s - d.m.y", $model->created_at ) ?>
        </div>
        <div class="panel-body">
            <div class="col-md-6"><?= $model->text ?></div>
            <div class="col-md-3">
                <?= ( $model->recieved_at > 1 ? "Переглянуто" : Html::a( "Відмітити як переглянуте",
                    [ 'recieve', 'id' => $model->id ] ) ) ?>
            </div>
            <div class="col-md-3">
                <?= Html::a( "Відповісти", [ 'user-message', 'receiver_id' => $model->author_id ] ) ?>
            </div>
        </div>
    <?php
    }
}