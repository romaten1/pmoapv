<?php

namespace app\modules\customer;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\customer\controllers';

    public $layout = 'main.php';

    public $defaultRoute = 'customer';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
