<?php
namespace app\modules\admin\components\message;

use Yii;
use yii\base\Widget;
use app\models\Message;

class MessageWidget extends Widget
{

    public $title;

    public function init()
    {
        parent::init();

    }

    public function run()
    {

        $models = Message::find()->where( [ 'receiver_id' => Yii::$app->user->id ] )->limit( 10 )->orderBy( [ 'id' => SORT_DESC ] )->all();
        return $this->render( 'message', [
            'models' => $models,
        ] );
    }


}

?>