<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $model app\models\Metodychky */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Методичні вказівки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="metodychky-view">
 
     <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Html::encode($model->description) ?></p>

    <p>
        <strong>Електронна версія:  </strong>
        <?php  
            echo $model->file ? 
            ' <a href=' . Url::to('/basic/web/uploads/metodychky/'. $model->file, true).' >' . $model->title.'</a>'
			: 'Файл на сайті відсутній'
        ?>
    </p>
    

</div>
