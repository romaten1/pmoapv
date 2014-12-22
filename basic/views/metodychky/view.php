<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use app\models\TeachMetodychky;
use app\models\Teacher;
use app\modules\admin\models\Metodychky;

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
			: 'Файл на сайті відсутній';
            echo '<br />Запис створено: '. date('d.m.Y', $model->updated_at);;
        ?>
    </p>
     Автори методичних вказівок:<br />
        <?
            $metodychky_id = TeachMetodychky::findAll([
                'metodychky_id' => $model->id,
            ]); 
            foreach($metodychky_id as $metodychky ){
                $teacher_name = Teacher::findOne($metodychky->teach_id);
                echo 
                Html::a($teacher_name->last_name.' '
                    .$teacher_name->name.' '
                    .$teacher_name->second_name, 
                    ['/admin/teacher/view', 'id' => $teacher_name->id], ['class' => 'btn btn-default'])
                . '<br />'; 
            }
            

        ?>
    

</div>
