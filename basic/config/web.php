<?php

$params = require(__DIR__ . '/params.php');
$authClients = require(__DIR__ . '/auth/clients.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'uk',
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],  
        'user' => [
            'class' => 'dektrium\user\Module',
            'enableConfirmation' => false,
            'enableUnconfirmedLogin' => true,
            'confirmWithin' => 21600,
            'cost' => 12,
            'admins' => ['admin'],
            //'enableIntlExtension' => false,
            'components' => [
                'manager' => [
                    // Model that is used on registration
                    'registrationFormClass' => 'app\models\RegistrationForm',                    
                ],
            ],
            'controllerMap' => [
                'registration' => 'app\controllers\RegistrationController'
            ],
        ],      
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'iQRGjcWe952CXOgy9zc5zdB_Ght4o_K1',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'class' => 'auth\components\User',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'categories' => ['yii\*'],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info'],
                    'categories' => ['admin'],
                    'logFile' => '@runtime/logs/test.log',
                    'logVars' => [] 
                ],
            ],
        ],
        'authManager' => [
            'class' => '\yii\rbac\PhpManager',
            
        ],
        'db' => require(__DIR__ . '/db.php'),
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => null,
                    'basePath' => '@webroot',
                    'baseUrl' => '@web',
                    'css' => ['css/bootstrap.css'],
                ],                
                       
                
            ],

        ],
         'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => $authClients,
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views' => '@app/views/user'
                ],
            ],
        ],
        /*'formatter' => [
            'dateFormat' => 'd-m-Y',
            'timeFormat' => 'H:i:s',
            'datetimeFormat' => 'd/m/Y H:i:s',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
        ],  */    
    ],
    'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\PathController',
            'access' => ['@'],
            'root' => [
                'path' => 'files',
                'name' => 'Files'
            ],
            'watermark' => [
                        'source'         => __DIR__.'/logo.png', // Path to Water mark image
                         'marginRight'    => 5,          // Margin right pixel
                         'marginBottom'   => 5,          // Margin bottom pixel
                         'quality'        => 95,         // JPEG image save quality
                         'transparency'   => 70,         // Water mark image transparency ( other than PNG )
                         'targetType'     => IMG_GIF|IMG_JPG|IMG_PNG|IMG_WBMP, // Target image formats ( bit-field )
                         'targetMinPixel' => 200         // Target image minimum pixel size
            ]
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
