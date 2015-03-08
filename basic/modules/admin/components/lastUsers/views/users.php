<?php
use yii\helpers\Html;

?>

<div class="col-md-6">
    <div class="panel panel-warning" id="news-widget">
        <div class="panel-heading"><h3 class="panel-title"><?= Html::a( 'Останні зареєстровані користувачі',
                    [ '/user/admin/index' ] ) ?></h3></div>
        <div class="panel-body">
            <ul>
                <?= $this->render( '_index_loop', [
                    'models' => $models
                ] ) ?>
            </ul>
        </div>
    </div>
</div>
