<?php 
namespace app\components\widgets\allteachers;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use app\models\Teacher;

class AllteacherWidget extends Widget
{
    
    

    public function init()
    {
        parent::init();
        
    }

    public function run()
    {
        
        $models = Teacher::find()->where(['active'=>Teacher::STATUS_ACTIVE])
            ->limit('6')->orderBy(['id' => SORT_ASC])->all();
        shuffle($models);
        return $this->render('teacher', [
            'models' => $models,
            'title' => $title,
        ]);
    }

    
}
 ?>