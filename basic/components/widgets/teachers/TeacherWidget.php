<?php 
namespace app\components\widgets\teachers;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use app\models\Teacher;

class TeacherWidget extends Widget
{
    
    public $title;

    public function init()
    {
        parent::init();
        if (!$this->title) {
            $this->title = 'Викладачі кафедри';
        }
    }

    public function run()
    {
        
        $models = Teacher::find()->where(['active'=>Teacher::STATUS_ACTIVE])->limit(7)->orderBy(['id' => SORT_ASC])->all();
        return $this->render('teacher', [
            'models' => $models,
            'title' => $title,
        ]);
    }

    
}
 ?>