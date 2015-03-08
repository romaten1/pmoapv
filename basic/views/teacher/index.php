<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use nirvana\prettyphoto\PrettyPhoto;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TeacherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Викладачі';

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teacher-index">

    <h1><?= Html::encode( $this->title ) ?></h1>

    <?= ListView::widget( [
        'dataProvider' => $dataProvider,
        'itemOptions'  => [ 'class' => 'item' ],
        'itemView'     => '_listItem',
    ] ) ?>
    <?php
    PrettyPhoto::widget( [
        'target'        => "a[rel^='prettyPhoto']",
        'pluginOptions' => [
            'opacity'            => 0.60,
            'theme'              => PrettyPhoto::THEME_LIGHT_ROUNDED,
            'social_tools'       => false,
            'autoplay_slideshow' => false,
            'modal'              => true
        ],
    ] );
    ?>


</div>
