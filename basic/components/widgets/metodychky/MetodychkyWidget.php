<?php 
namespace app\components\widgets\metodychky;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use app\models\Metodychky;

class MetodychkyWidget extends Widget
{
    
    public $title;

    public function init()
    {
        parent::init();
        if (!$this->title) {
            $this->title = 'Методичні вказівки';
        }
    }

    public function run()
    {
        
        $models = Metodychky::find()->limit(5)->orderBy(['id' => SORT_DESC])->all();
        return $this->render('metodychky', [
            'models' => $models,
            'title' => $title,
        ]);
    }

    
}
 ?>