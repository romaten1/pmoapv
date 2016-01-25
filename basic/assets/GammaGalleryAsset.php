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
class GammaGalleryAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'GammaGallery/css/style.css',
	];
	public $js = [
        'GammaGallery/js/modernizr.custom.70736.js',
		'GammaGallery/js/jquery.masonry.min.js',
		'GammaGallery/js/jquery.history.js',
        'GammaGallery/js/js-url.min.js',
        'GammaGallery/js/jquerypp.custom.js',
        'GammaGallery/js/gamma.js',
        'GammaGallery/js/script_gamma.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
	    'yii\web\JqueryAsset',
    ];
}
