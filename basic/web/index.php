<?php
//ini_set('mysql.connect_timeout', 3000);
//ini_set('default_socket_timeout', 3000);
//ini_set( 'max_execution_time', 3000 );
//set_time_limit( 0 );

// comment out the following two lines when deployed to production
defined( 'YII_DEBUG' ) or define( 'YII_DEBUG', true );
defined( 'YII_ENV' ) or define( 'YII_ENV', 'dev' );

require( __DIR__ . '/../vendor/autoload.php' );
require( __DIR__ . '/../vendor/yiisoft/yii2/Yii.php' );

$config = require( __DIR__ . '/../config/web.php' );

( new yii\web\Application( $config ) )->run();
