<?php

use app\assets\GammaGalleryAsset;
use app\assets\MasonryAsset;
use cnxfaeton\photobox\PhotoBox;
use cnxfaeton\photobox\PhotoBoxAsset;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\DiplomaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Грамоти та дипломи викладачів та студентів кафедри';
$this->params['breadcrumbs'][] = $this->title;

GammaGalleryAsset::register( $this );
?>
<div class="gamma-container gamma-loading" id="gamma-container">



    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        //'orderBy' => ['rating' => SORT_DESC],
        'options' => ['tag' => 'ul', 'class' => 'gamma-gallery'],
        'itemOptions' => ['tag' => 'li'],
        'layout' => '{items}',
        'itemView'     => '_listItem',
    ]) ?>

<div class="gamma-overlay"></div>

</div>
<?php echo LinkPager::widget([
    'pagination'=>$dataProvider->pagination,
]);

