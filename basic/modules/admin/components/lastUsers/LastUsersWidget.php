<?php 
namespace app\modules\admin\components\lastUsers;

use Yii;
use yii\base\Widget;
use dektrium\user\models\User;

class LastUsersWidget extends Widget
{
    
    public $title;

    public function init()
    {
        parent::init();
        
    }

    public function run()
    {
        
        $models = User::find()->limit(10)->orderBy(['id' => SORT_DESC])->all();
        return $this->render('users', [
            'models' => $models,
        ]);
    }

    
}
 ?>