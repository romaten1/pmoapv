<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use app\models\Teacher;
use app\models\Message;


/* @var $this yii\web\View */
?>

<div class="row">
    <div class="col-md-9">

        <h2 class="featurette-heading">Викладацький чат</h2>
        <?= $this->render( '_form', [
            'model' => $model,
        ] ) ?>

        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div >
                    <div class="panel-body">
                        <?= ListView::widget( [
                            'dataProvider' => $dataChatMessageProvider,
                            'itemOptions'  => [ 'class' => 'item' ],
                            'itemView'     => '_chatMessageItem',
                        ] ) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="panel-title">

                    <?= Teacher::getPrepod( Yii::$app->user->id ) ?>

                </h4>
            </div>

            <div class="panel-body">
                <p><?= $teacher->image ? Html::img( '@web/uploads/teacher/' . $teacher->image ) : '' ?></p>

                <p><?= 'Посада: ' . Html::encode( $teacher->job ) ?></p>

                <p><?= 'Науковий ступінь: ' . Html::encode( $teacher->science_status ) ?></p>

                <p><?= 'Організаційна посада: ' . Html::encode( $teacher->org_status ) ?></p>
            </div>

        </div>
    </div>
</div>

 