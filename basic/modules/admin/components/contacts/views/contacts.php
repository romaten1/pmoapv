<?php
use yii\helpers\Html;

?>

<div class="col-md-4">
    <div class="panel panel-success" id="news-widget">
        <div class="panel-heading"><h3 class="panel-title"><?= Html::a('Останні повідомлення користувачів',
                    ['/admin/contacts']) ?></h3></div>
        <div class="panel-body">
            <ol>
                <?= $this->render('_index_loop', [
                    'models' => $models
                ]) ?>
            </ol>
        </div>
    </div>
</div>
