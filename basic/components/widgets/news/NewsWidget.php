<?php 
namespace app\components\widgets\news;

use Yii;
use yii\base\Widget;
use app\models\News;

class NewsWidget extends Widget
{
    
    public $title;

    public function init()
    {
        parent::init();
        if (!$this->title) {
            $this->title = 'Новини кафедри';
        }
    }

    public function run()
    {
        
        $models = News::find()->where(['active'=>News::STATUS_ACTIVE])->limit(5)->orderBy(['updated_at' => SORT_DESC])->all();
        return $this->render('news', [
            'models' => $models,
            'title' => $this->title,
        ]);
    }

    
}
 ?>