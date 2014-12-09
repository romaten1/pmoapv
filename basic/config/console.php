<?php

Yii::setAlias('@tests', dirname(__DIR__) . '/tests');

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

return [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'gii'],
    'controllerNamespace' => 'app\commands',
    'modules' => [
        'gii' => 'yii\gii\Module',
        'auth' => [
                'class' => 'auth\Module',
                'layout' => '/site/index', // Layout when not logged in yet
                'layoutLogged' => '//main', // Layout for logged in users
                'attemptsBeforeCaptcha' => 3, // Optional
                'supportEmail' => 'support@mydomain.com', // Email for notifications
                'passwordResetTokenExpire' => 3600, // Seconds for token expiration
                'superAdmins' => ['admin'], // SuperAdmin users
                'tableMap' => [ // Optional, but if defined, all must be declared
                    'User' => 'user',
                    'UserStatus' => 'user_status',
                    'ProfileFieldValue' => 'profile_field_value',
                    'ProfileField' => 'profile_field',
                    'ProfileFieldType' => 'profile_field_type',
                ],
            ],
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'authManager' => [
            'class' => '\yii\rbac\DbManager',
            'ruleTable' => 'AuthRule', // Optional
            'itemTable' => 'AuthItem',  // Optional
            'itemChildTable' => 'AuthItemChild',  // Optional
            'assignmentTable' => 'AuthAssignment',  // Optional
        ],
        'user' => [
            'class' => 'auth\components\User',
        ],
        'db' => $db,
    ],
    'params' => $params,
];
