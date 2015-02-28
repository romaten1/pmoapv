<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\conference\models\ConferenceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Наукові заходи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conference-index">

    <h1><?= Html::encode($this->title) ?></h1>

	<?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item well'],
        'itemView' => '_listItem',
    ]) ?>

</div>
