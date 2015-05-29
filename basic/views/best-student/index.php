<?php

use app\assets\MasonryAsset;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\BestStudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Кращі студенти кафедри';
$this->params['breadcrumbs'][] = $this->title;

MasonryAsset::register( $this );
?>
<div class="best-student-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <br />
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        //'orderBy' => ['rating' => SORT_DESC],
        'options' => ['class' => 'masonry'],
        'layout' => '{items}',
        'itemView'     => '_listItem',
    ]) ?>
<?php echo LinkPager::widget([
    'pagination'=>$dataProvider->pagination,
]); ?>
</div>
