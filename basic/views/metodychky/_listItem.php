<?php
use yii\helpers\Html;
use app\helpers\FileHelper;
use app\models\Teacher;
use kartik\icons\Icon;

Icon::map( $this );
?>


<div class="row">
    <div class="col-md-8">
        <?= Html::a( Html::encode( $model->title ), [ 'view', 'id' => $model->id ] ); ?><br/>
        <?= 'Розмір: ' . FileHelper::Size2Str( $model->size ); ?>
        <?= 'Додано: ' . date( 'H:i / d-m-Y', $model->updated_at ); ?>
    </div>
    <div class="col-md-4">
        <?php
        echo 'Автори: <br />';
        foreach ($model->teachers as $teacher) {
            if ($teacher->active == Teacher::STATUS_ACTIVE) {
                echo
                    Icon::show( 'user' ) . Html::a( Html::encode( $teacher->last_name ) . ' ' . Html::encode( $teacher->name ),
                        [ '/teacher/view', 'id' => $teacher->id ] ) . ', <br />';
            }
        }
        ?>
    </div>
</div>
<br/>
