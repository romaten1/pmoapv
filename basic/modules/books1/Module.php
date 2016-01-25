<?php

namespace app\modules\books;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\books\controllers';

    public $layout = 'main.php';

    public function init()
    {
        parent::init();
    }
}
