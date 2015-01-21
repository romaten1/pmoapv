<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * 
 */
class AbiturientAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'abiturient/css/agency.css',
    ];
    public $js = [
    	'abiturient/js/agency.js',
        'abiturient/js/cbpAnimatedHeader.js',
        'abiturient/js/cbpAnimatedHeader.min.js',
        'abiturient/js/classie.js',
        'abiturient/js/jqBootstrapValidation.js',
    	
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
