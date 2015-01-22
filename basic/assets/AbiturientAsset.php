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
	    '/abiturient/font-awesome/css/font-awesome.min.css',
	    'http://fonts.googleapis.com/css?family=Montserrat:400,700',
	    'http://fonts.googleapis.com/css?family=Kaushan+Script',
	    'http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic',
	    'http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700',
	    'http://fonts.googleapis.com/css?family=Marck+Script&subset=latin,cyrillic',
	    'http://fonts.googleapis.com/css?family=Roboto+Slab:400,700&subset=cyrillic-ext,latin'
	];
	public $js = [
		'abiturient/js/bootstrap.min.js',
		'http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js',
    	'abiturient/js/agency.js',
        'abiturient/js/cbpAnimatedHeader.js',
        'abiturient/js/cbpAnimatedHeader.min.js',
        'abiturient/js/classie.js',
        'abiturient/js/jqBootstrapValidation.js',
		'https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js',
		'https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
	    'yii\web\JqueryAsset',
    ];
}
