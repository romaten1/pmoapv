<?php 
namespace app\components\widgets\allnews;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use app\models\News;

class AllnewsWidget extends Widget
{
    
    

    public function init()
    {
        parent::init();
        
    }

    public function run()
    {
        
        $models = News::find()->limit('6')->orderBy(['id' => SORT_DESC])->all();
        return $this->render('news', [
            'models' => $models,
        ]);
    }

    
}
 ?>