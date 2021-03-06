<?php 
namespace app\components\widgets\metodychky;

use Yii;
use yii\base\Widget;
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
        
        $models = Metodychky::find()->where(['active'=>Metodychky::STATUS_ACTIVE])->limit(5)->orderBy(['id' => SORT_DESC])->all();
        return $this->render('metodychky', [
            'models' => $models,
            'title' => $this->title,
        ]);
    }

    
}
 ?>