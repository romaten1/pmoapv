<?php
namespace app\modules\admin\components\contacts;

use Yii;
use yii\base\Widget;
use app\models\Contacts;

class ContactsWidget extends Widget
{

    public $title;

    public function init()
    {
        parent::init();

    }

    public function run()
    {

        $models = Contacts::find()->limit( 10 )->orderBy( [ 'id' => SORT_DESC ] )->all();
        return $this->render( 'contacts', [
            'models' => $models,
            'title'  => $title,
        ] );
    }


}

?>